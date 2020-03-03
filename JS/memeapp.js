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
		if( $scope.activeTags.length !== 0 ){
			filter+="&filter=";
			for(var a=0;a<$scope.activeTags.length;a++){
				filter+=$scope.activeTags[a]+" ";
			}
		}
		$http.get("PHP/getMemes.php?pag="+$scope.pagination+"&sort="+$scope.sortMethod+filter+filters).then(function(data){
			if(data.data=="false"){
				memestring="<p>An error has occured. Please <a ng-click='getMoreMemes(\"\")'>click here</a> to try again</p>";
			}
			else{
				dataStrings = data.data.split(";");
				for(var a=0;a<dataStrings.length-1;a++){
					console.log(dataStrings[a]);
					var memeData=dataStrings[a].split(":");
					memestring+="<table class='meme' id='"+memeData[0]+"'";
						memestring+=">";
						memestring+="<tr>";
						memestring+="<td colspan='2'><h2>"+memeData[1]+"</h2><h3 id='likes"+memeData[0]+"'>"+memeData[4]+"</h3></td>";
						memestring+="</tr><tr ng-mouseleave='closeMeme(\""+memeData[0]+"\")' ng-mouseenter='expandMeme(\""+memeData[0]+"\",\""+memeData[2]+"\")'>";
						memestring+="<td>";
						memestring+="<a href='memePage.php?meme="+memeData[0]+"' >";
						memestring+=	"<img src='Memes/"+memeData[0]+".png' alt='"+memeData[1]+"' />";
						memestring+="</a>";
						memestring+="</td><td class='memeDataWrapper' id='"+memeData[0]+"expandedwrapper'>";
							memestring+="<div class='memeData' id='"+memeData[0]+"expanded'>";
							memestring+="<p>"+memeData[3];
							memestring+="</p>";
							memestring+=	"<div id='userInfo"+memeData[0]+"'>";
							memestring+=	"</div>";
							memestring+=	"<p>";
							var tags = memeData[5].split(",");
							if(tags.length>0){
								for(var b=0;b<tags.length-2;b++){
									memestring+="<span class='memeTag'>"+tags[b]+", </span>";
								}
								memestring+="<span class='memeTag'>"+tags[tags.length-2]+"</span>";
							}
							memestring+="</p>";
							if($scope.loggedIn){
								memestring+=	"<table class='memecontrols'>";
								memestring+=			"<td>";
								memestring+=				"<a href='' ng-click='addLike(\""+memeData[0]+"\")'>Like</a>";
								memestring+=			"</td>";
								memestring+=			"<td>";
								memestring+=				"<a href='PHP/getCookie.php?id="+memeData[0]+"'>Buy!</a>";
								memestring+=			"</td>";
								memestring+=			"<td>";
								memestring+=				"<a href='reportCopy.php?copyid="+memeData[0]+"'>Copy</a>";
								memestring+=			"</td>";
								memestring+=		"</tr>";
								memestring+=	"</table>";
								memestring+=	"<div id='nameFor"+memeData[0]+"'>";
								memestring+=	"</div>";
								memestring+=	"<textarea class='comment' id='comment"+memeData[0]+"'>";
								memestring+=	"</textarea>";
								memestring+=	"<input type='button' ng-click='submitComment(\""+memeData[0]+"\")' value= 'Submit Comment' id='subbut"+memeData[0]+"' />";
							}
							memestring+=		"<div class='break'></div>";
							memestring+=	"<div id='commentsFor"+memeData[0]+"'>";
							memestring+=	"</div>";
							memestring+="</div>";
						memestring+="</td></tr>";
					memestring+="</table>";
				}
			}
			console.log(memestring);
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
		pagination = 0;
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
			$scope.activeTagFilters=$scope.tags.slice();
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
		console.log(tag);
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

});
