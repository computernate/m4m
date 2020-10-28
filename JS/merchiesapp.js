var merchiesApp = angular.module( "merchies", [] );

merchiesApp.controller( "merchiesctrl" ,  function($scope, $window, $http, $compile){

	//Make the head go up when scrolled update, and take care of hasScrolled variable
	//It is not very elegant, but Angular doesn't reset its page measurements after I add things.
	var lastPagey=0;
	$scope.hasScrolled=false;
	$scope.scrolledUp=false;
	$window.onscroll=function(){

		var topdis=document.body.scrollTop;

		if(!$scope.hasScrolled){
			if(lastPagey<topdis){
				$scope.hasScrolled=true;
				$scope.scrolledUp=true;
				if($scope.activatedFullNav){
					$scope.activatedFullNav=false;
				}
				$scope.$apply();
			}
		}

		else if(lastPagey>topdis){
			$scope.hasScrolled=false;
			$scope.scrolledUp=false;
			$scope.$apply();
		}
		lastPagey=topdis;

		if(window.location.href.indexOf("index") <= -1){
			return;
		}

		var offset=document.body.scrollTop+700;
		var height = document.getElementById('wrapper').offsetHeight ;

		if(offset >= height){
			$scope.getMoreCookies('');
		}

	}


	//Log the user in
	$scope.logIn = function( username , pass ){
		$http.get( "PHP/logIn.php?name=" + username  + "&password=" + pass + "" ).then( function( data ){
			if( data.data == "true" ){
				window.location.assign("index.php");
			}
			else{
				$scope.loginError = true;
			}
		});
	}



	/**
	Logs the user out
	**/
	$scope.logOut = function(){
		$http.get("PHP/logOut.php").then(function(data){
			if( data.data == "true" ){
				window.location.assign("index.php");
			}
			else{
				$scope.loginError = true;
			}
		});
	}



	/**
	Get More Cookies
	Calls PHP/getCookies.php and uses the data to create a string of html that
	appends to the end of #allCookies displaying the images.
	Data returned by getCookies should be in the format id, hasShirt, title, fileType, pointerID, description, likes, tags
	**/
	$scope.pagination=0;
	$scope.getMoreCookies=function(filters){
		var cookieString="";
		var filter = "";
		if( $scope.activeTagFilters.length !== 0 ){
			filter+="&filter=";
			for(var a=0;a<$scope.activeTagFilters.length;a++){
				filter+=$scope.activeTagFilters[a]+"|";
			}
			filter=filter.substring(0,filter.length-1);
		}
		$http.get("PHP/getImages.php?pag="+$scope.pagination+"&sort="+$scope.sortMethod+filter+filters).then(function(data){
			console.log(data.data);
			if(data.data=="false"){
				cookieString="<p>An error has occured, or there are no more cookies. Please <a ng-click='getMoreCookies(\"\")'>click here</a> to try again</p>";
			}
			else{
				dataStrings = data.data.split(";");
				for(var a=0;a<dataStrings.length-1;a++){
					var imageData=dataStrings[a].split(":");
					cookieString+="<table class='cookie genericBlock' id='"+imageData[0]+"'>";
						cookieString+="<tr>";
							cookieString+="<td><h2>"+imageData[1]+"</h2><h3>Cookies sold: "+imageData[4]+"</h3></td>";
						cookieString+="</tr><tr>";
							cookieString+="<td>";
							cookieString+="<a href='cookie.php?cookie="+imageData[0]+"' >";
							cookieString+=	"<img src='userCookies/"+imageData[0]+".png' alt='"+imageData[1]+"' />";
							cookieString+="</a>";
						cookieString+="</td></tr>";
						cookieString+="<tr><td><div class='buyWrapper'>";
							cookieString+='<p class="buy" ng-click=\'buyCookie("'+imageData[0]+'",'+$scope.HugePin+')\'>HUGE ('+$scope.HugePrice+')</p>';
							cookieString+='<p class="buy" ng-click=\'buyCookie("'+imageData[0]+'",'+$scope.MediumPin+')\'>NORMAL ('+$scope.MediumPrice+')</p>';
							cookieString+='<p class="buy" ng-click=\'buyCookie("'+imageData[0]+'",'+$scope.MediumPin+')\'>PARTY ('+$scope.SmallPrice+')</p>';
						cookieString+='</div></td></tr></table>';

				}
			}
			var compiledHtml = $compile(cookieString)($scope);
			angular.element( document.querySelector( '#allCookies' ) ).append(compiledHtml);
			$scope.pagination++;
		});
	}



/**
Refreshes index, called when asked for new tags
**/
	$scope.refreshPage=function(){
		document.getElementById("allCookies").innerHTML = "";
		$scope.pagination = 0;
		$scope.getMoreCookies('');
	}



	/**
		Takes a user comment and links it to the image
	**/
	$scope.submitComment=function(id){

		var content=document.getElementById("comment"+id).value;

		$http.get("PHP/submitComment.php?id="+id+"&content="+content).then(function(data){

			if(data.data!="true"){
				document.getElementById("subbut"+id).value=data.data;
			}

			else{
				var content=document.getElementById("comment"+id).value="";
				$scope.getComments(id);
			}
		});
	}

	/**
		Gets all the commments for an image by ID.
		Comes in the form comment:userid:userimg;
	**/
	$scope.getComments=function(id){
		$http.get("PHP/getComments.php?id="+id).then(function(data){
			var finalString="";
			if(data.data=="false"){
				finalString="";
			}
			else{
				var dataStrings = data.data.split(";");
				for(var a=0;a<dataStrings.length-1;a++){
					var commentData=dataStrings[a].split(":");

					finalString+="<a href='userPage.php?id="+commentData[1]+"' >"+commentData[3]+"</a>";
					finalString+="<p>"+commentData[0]+"</p>";
					finalString+="<div class='break'></div>";

				}
			}
			document.getElementById('commentsFor' + id).innerHTML=finalString;
		});
	}




	$scope.activeTags=[];
	$scope.tags=[];

	/**
		Gets a list of all tags
	**/
	$scope.getTags=function(){
		$http.get('PHP/getTags.php').then(function(data){
			$scope.tags=data.data.split(",");
			$scope.tags.pop();
			$scope.tags.pop();
		});
	}

	/**
		Adds a tag to active tags
	**/
	$scope.addTag=function(){
		if($scope.activeTags.indexOf($scope.actingTag)==-1)
			$scope.activeTags.push($scope.actingTag);
	}

	/**
		Deletes a tag from activeTags
	**/
	$scope.deleteTag=function(tag){
		$scope.activeTags.splice($scope.activeTags.indexOf(tag));
	}

	/**
		Stringify an array and separate by comma
	**/
	$scope.stringify=function(array){
		var returnValue="";
		for(var a=0;a<array.length;a++){
			returnValue+=array[a]+",";
		}
		return returnValue;
	}






	/**
		Toggles a tag for searching
	**/
	$scope.activeTagFilters=[];
	$scope.toggleTag=function(tag){

		var tagElement = angular.element(document.querySelector("#"+tag));

		if($scope.activeTagFilters.indexOf(tag)==-1){
			//tagElement.("inactiveTag");
			$scope.activeTagFilters.push(tag);
		}

		else{
			//tagElement.addClass("inactiveTag");
			$scope.activeTagFilters.splice($scope.activeTagFilters.indexOf(tag),1);
		}
	}




	/**
		Check that a name is not taken for sign up
	**/
	$scope.checkName = function( ){
		var statement =  $scope.signupName ;

		$http.get( "PHP/checkName.php?sql=" + statement
		).then( function( data ){

			if( data.data == "false" ){
				$scope.nameExists = true;
				$scope.signUp.name.$setValidity( "unique" , true );
			}

			else{
				$scope.nameExists = false;
				$scope.signUp.name.$setValidity( "unique" , false );
			}

		});
	}





	/**
		Submit an image for the newCookie page
	**/
	$scope.submitImage=function(){
		var src = canvas.toDataURL("image/png",1);
		document.getElementById("uploadingImage").value=src;
	}





	/**
		Take a cookieid, and a sizeid (provided by spotify) and
		submit them to the cart
	**/
	$scope.buyCookie=function(cookieid, size){

		var newWindow = window.open("https://merchies-shop.com/pages/metasubmit?id="+size+"&quantity=1&cookieid="+cookieid,'_blank', "toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=" + (screen.width*2) + ", top=10000, width=10, height=10, visible=none", '');
		window.focus();
		newWindow.blur();

		setTimeout(function(){
			newWindow.close()
		},3000);

		angular.element(document.querySelector( 'body' )).prepend('<div id="topMessage"><h2>ADDED TO CART <a href="https://merchies-shop.com/cart">See here</a></h2></div>');

	}



	/**
		Buy cookies for the submit page. Uploads the cookie to the database before invoking buy.
	**/
	$scope.buyCookiesQuick=function(cookie, size){
		console.log("Buying");
		var cookieID = (Math.random().toString(36)+'00000000000000000').slice(2, 14);
		document.getElementById("imageTitle").value = cookieID;
		var canvas = document.getElementById(cookie);
		var src = canvas.toDataURL("image/png",1);
		document.getElementById("uploadingImage").value=src;

		$.post("PHP/submitCookie.php",$("#makeCookie").serialize()).done(function(data){
			console.log(data);
		});
		console.log("submitted");

		$scope.buyCookie(cookieID, size)
	}



	/**
		This function takes an uploaded image, and displays it with options to buy
		Credit to georgeawg from stackowverflow for the image displaying
	**/
	var quickImages=[];
	var canvascounter = 0;
	addToQuick=function(img){

			var canvasElement = document.createElement("Canvas");

			canvasElement.setAttribute("id","quickcookiecanvas"+canvascounter);
				canvasElement.setAttribute("width","300");
				canvasElement.setAttribute("height","450");
			if(window.innerWidth<=750){
				canvasElement.setAttribute("width","300");
				canvasElement.setAttribute("height","450");
			}

			document.getElementById("addQuickCookies").appendChild(canvasElement);

			var canvas = new fabric.Canvas("quickcookiecanvas"+canvascounter, {preserveObjectStacking:true});

			var background = new fabric.Rect({
				fill:'white',
				top:-1,
				left:-1,
				width:649,
				height:649,
				selectable:false
			});

			canvas.add(background);

			if (img.files && img.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					fabric.Image.fromURL(reader.result, function(oImg) {
						oImg.scaleToHeight(canvas.getHeight());
						canvas.add(oImg);
						canvas.centerObject(oImg);
					});
				};
				reader.readAsDataURL(img.files[0]);
			}

			var buyString = '<div class="buyWrapper">';
			buyString+='<p class="buy" ng-click="buyCookiesQuick(\'quickcookiecanvas'+canvascounter+'\',\''+$scope.HugePin+'\')">HUGE ('+$scope.HugePrice+')</p>';
			buyString+='<p class="buy" ng-click="buyCookiesQuick(\'quickcookiecanvas'+canvascounter+'\',\''+$scope.MediumPin+'\')">NORMAL ('+$scope.MediumPrice+')</p>';
			buyString+='<p class="buy" ng-click="buyCookiesQuick(\'quickcookiecanvas'+canvascounter+'\',\''+$scope.MediumPin+'\')">PARTY ('+$scope.SmallPrice+')</p></div>';

			var compiledHtml = $compile(buyString)($scope);
			angular.element( document.querySelector( '#addQuickCookies' ) ).append(compiledHtml);

			canvascounter++;
	}



	/**
		Validates earnings method
	**/
	$scope.earningsSelected=false;
	$scope.earningsMethodText="Select an earnings method";

	$scope.changeEarningsText = function(newText){

		$scope.earningsSelected=true;

		switch(newText){
			case "paypal":
				$scope.earningsMethodText="Please enter your email address, phone number, or name associated with your paypal account.";
			break;

			case "venmo":
				$scope.earningsMethodText="Please enter your venmo, followed by a space, then the last 4 digits of your cell phone number";
			break;

			case "googlePay":
				$scope.earningsMethodText="Please enter the email address associated with the account.";
			break;

		}
		$scope.earningsID="";
	}

});






/**
	Validate earnings page
**/
merchiesApp.directive("validatePayment",function(){
	return{
		require:'ngModel',
		link:function(scope, element, attr, mCtrl) {
      function myValidation(value) {
				var radios = document.getElementsByName('earningsMethod');
				var radioValue="";
				for (var i = 0, length = radios.length; i < length; i++) {
				  if (radios[i].checked) {
						radioValue=radios[i].value;
					}
				}
				console.log(radioValue);
				switch(radioValue){
					case "paypal":
						mCtrl.$setValidity("earnings",true);
						return value;
					case "venmo":
						var wholevenmo=value.split(" ");
						if(wholevenmo.length!=2){
							mCtrl.$setValidity("earnings",false);
							return value;
						}
						var venmonum=wholevenmo[1];
						if(venmonum.length==4&&!isNaN(venmonum)){
								mCtrl.$setValidity("earnings",true);
								return value;
						}
						else{
							mCtrl.$setValidity("earnings",false);
							return value;
						}
					case "googlePay":
						var re = /\S+@\S+\.\S+/;
						mCtrl.$setValidity("earnings", re.test(value));
						return value;
				}
      }
			mCtrl.$parsers.push(myValidation);
		}
	};
});
