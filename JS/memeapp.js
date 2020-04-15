var memeApp = angular.module( "money4memes", [] );

memeApp.controller( "memectrl" ,  function($scope, $window, $http, $compile){

	$scope.logValue = function(){
		console.log($scope.imageBlob);
	}

	//Make the head go up when scrolled update, and take care of hasScrolled variable
	//It is not very elegant, but I could not figure out angular scrolling so I had to use vanilla

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
		/**

		Something to do: Fix the scrolling!!!!

		**/

		var offset=document.body.scrollTop+700;
		var height = document.getElementById('wrapper').offsetHeight ;

		if(offset >= height){
			$scope.getMoreMemes('');
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
	Get More Memes
	Calls PHP/getMemes.php and uses the data to create a string of html that
	appends to the end of #allMemes displaying the memes.
	Data returned by getMemes should be in the format id, hasShirt, title, fileType, pointerID, description, likes, tags
	**/
	$scope.pagination=0;
	$scope.getMoreMemes=function(filters){
		var memestring="";
		var filter = "";
		if( $scope.activeTagFilters.length !== 0 ){
			filter+="&filter=";
			for(var a=0;a<$scope.activeTagFilters.length;a++){
				filter+=$scope.activeTagFilters[a]+"|";
			}
			filter=filter.substring(0,filter.length-1);
		}
		$http.get("PHP/getMemes.php?pag="+$scope.pagination+"&sort="+$scope.sortMethod+filter+filters).then(function(data){
			if(data.data=="false"){
				memestring="<p>An error has occured. Please <a ng-click='getMoreMemes(\"\")'>click here</a> to try again</p>";
			}
			else{
				dataStrings = data.data.split(";");
				for(var a=0;a<dataStrings.length-1;a++){
					var memeData=dataStrings[a].split(":");
					memestring+="<table class='meme genericBlock' id='"+memeData[0]+"'>";
						memestring+="<tr>";
						memestring+="<td><h2>"+memeData[1]+"</h2><h3 class='likes' id='likes"+memeData[0]+"'>Cookies sold: "+memeData[4]+"</h3></td>";
						memestring+="</tr><tr>";
						memestring+="<td>";
						memestring+="<a href='cookie.php?meme="+memeData[0]+"' >";
						memestring+=	"<img src='Memes/"+memeData[0]+".png' alt='"+memeData[1]+"' />";
						memestring+="</a>";
						memestring+="</td></tr>";
						memestring+="<tr><td><p>";
						memestring+="	<a class='memeDetails' href = 'cookie.php?meme="+memeData[0]+"'>More Info</a>";
						memestring+='		<a href="" class="memeDetails buy" ng-click="buyMeme(\''+memeData[0]+'\')" class="buy" >COOKIE</a>';
						memestring+="</span>";
						memestring+="	<a href='reportCopy.php?copyid=<?php echo $id; ?>'>Report</a>";
						memestring+="</p></td></tr>";
					memestring+="</table>";
					memestring+="	<form class='buyForm' action='https://the-memery-cookies.myshopify.com/cart/add' target='_blank' method='post' id='form"+memeData[0]+"''>";
					memestring+="		<input type='hidden' name='id' value='32528941777028' />";
					memestring+='		<input type="hidden" name="quantity" value="1" />';
					memestring+='		<input type="hidden" name="properties[cookieid]" value="'+memeData[0]+'" />';
					memestring+="	</form>";
				}
			}
			var compiledHtml = $compile(memestring)($scope);
			angular.element( document.querySelector( '#allMemes' ) ).append(compiledHtml);
			$scope.pagination++;
		});
	}



/**
Refreshes index, called when asked for new tags
**/
	$scope.refreshPage=function(){
		//angular.element( document.querySelector( '#allMemes' ) ).innerHTML="";
		document.getElementById("allMemes").innerHTML = "";
		$scope.pagination = 0;
		$scope.getMoreMemes('');
	}



	/**
	expandMeme
	takes in an element ID, and appends to it a box of info such as the creaor, Tshirt link if applicable, likes, comments, etc.
	*/
	$scope.expandMeme = function(id,user){
		document.getElementById(id).classList.add("memeOut");
		document.getElementById(id+"expanded").classList.add("memeOut");
		document.getElementById(id+"expandedwrapper").classList.add("memeOut");


		if(!document.getElementById(id).classList.contains("hasBeenOpened")){
			$http.get("PHP/getUserData.php?reason=memeUser&id="+user).then(function(data){
				//var userData=data.data.split(",");

				var userString = data.data;
				angular.element( document.querySelector( '#userInfo' + id ) ).append(userString);
				document.getElementById(id).classList.add("hasBeenOpened");

			});
		}

		$scope.getComments(id);

	}



	/**
	Closes a meme after it is unhovered
	**/
	$scope.closeMeme = function(id){
		document.getElementById(id).classList.remove("memeOut");
		document.getElementById(id+"expanded").classList.remove("memeOut");
	}


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

	$scope.addLike=function(id){
		$http.get("PHP/like.php?id="+id).then(function(data){
			document.getElementById("likes"+id).innerHTML=data.data;
		});
	}

	$scope.activeTags=[];
	$scope.tags=[];
	$scope.getTags=function(){
		$http.get('PHP/getTags.php').then(function(data){
			$scope.tags=data.data.split(",");
			$scope.tags.pop();
			$scope.tags.pop();
		});
	}

	$scope.addTag=function(){
		if($scope.activeTags.indexOf($scope.actingTag)==-1)
			$scope.activeTags.push($scope.actingTag);
	}

	$scope.deleteTag=function(tag){
		$scope.activeTags.splice($scope.activeTags.indexOf(tag));
	}

	$scope.stringify=function(array){
		var returnValue="";
		for(var a=0;a<array.length;a++){
			returnValue+=array[a]+",";
		}
		return returnValue;
	}


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

	$scope.singleMeme=function(id){

	}

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
		//document.getElementById( "key" ).value=$scope.getUniqueKey( );
	}

	$scope.copyurl="";
//I can probably just remove this once the image editor works, this is only temporary
	$scope.getCopyMeme=function(){
		$scope.copyurl="Memes/"+$scope.copyMeme;
	}

	$scope.submitMeme=function(){
		var src = canvas.toDataURL("image/png",1);
		document.getElementById("uploadingMeme").value=src;
	}

	$scope.buyMeme=function(memeid){
		console.log(memeid);
		console.log(document.getElementById("form"+memeid));
		document.getElementById("form"+memeid).submit();
	}

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

memeApp.directive("validatePayment",function(){
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
