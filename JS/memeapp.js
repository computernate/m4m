var memeApp = angular.module( "money4memes", [] );

memeApp.controller( "memectrl" ,  function($scope, $window, $http, $compile){


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
	var pagination=0;
	$scope.getMoreMemes=function(likedUser){
		var memestring="";
		var filter = "none";
		if( $scope.activeTags.length !== 0 ){
			for(var a=0;a<$scope.activeTags.length;a++){
				filter+="(?=.*"+$scope.activeTags[a]+")";
			}
		}
		$http.get("PHP/getMemes.php?pag="+pagination+"&sort="+$scope.sortMethod+"&filter="+filter+"&likes="+likedUser).then(function(data){
			if(data.data=="false"){
				memestring="<p>An error has occured. Please <a ng-click='getMoreMemes(\"\")'>click here</a> to try again</p>";
			}
			else{
				dataStrings = data.data.split(";");
				for(var a=0;a<dataStrings.length-1;a++){
					var memeData=dataStrings[a].split(":");

					if($scope.activeTagFilters.length>0){
						var blockedTag = false;
						var splitTags = memeData[7].split(",");
						for(var b=0;b<splitTags.length-1;b++){
							if($scope.activeTagFilters.indexOf(splitTags[b])==-1){
								blockedTag=true;
							}
						}
						if(blockedTag){
							memestring+="<div style='visibility:hidden;height:0px;'>";
						}
					}

					memestring+="<table class='meme' id='"+memeData[0]+"'";
					if(memeData[1]=="true"){
						//memestring+=" class='hasShirt' ";
					}
						memestring+=">";
						memestring+="<tr>";
						memestring+="<td colspan='2'><h2>"+memeData[2]+"</h2><h3 id='likes"+memeData[0]+"'>"+memeData[6]+"</h3></td>";
						memestring+="</tr><tr ng-mouseleave='closeMeme(\""+memeData[0]+"\")' ng-mouseenter='expandMeme(\""+memeData[0]+"\",\""+memeData[4]+"\")'>";
						memestring+="<td>";
						memestring+="<a href='memePage.php?meme="+memeData[0]+"' >";
						memestring+=	"<img src='memes/"+memeData[0]+"."+memeData[3]+"' alt='"+memeData[2]+"' />";
						memestring+="</a>";
						memestring+="</td><td class='memeDataWrapper' id='"+memeData[0]+"expandedwrapper'>";
							memestring+="<div class='memeData' id='"+memeData[0]+"expanded'>";
							memestring+="<p>"+memeData[5];
							memestring+="</p>";
							memestring+=	"<div id='userInfo"+memeData[0]+"'>";
							memestring+=	"</div>";
							if($scope.loggedIn){
								memestring+=	"<table class='memecontrols'>";
								memestring+=			"<td>";
								memestring+=				"<a href='' ng-click='addLike(\""+memeData[0]+"\")'>Like</a>";
								memestring+=			"</td>";
								memestring+=			"<td>";
								memestring+=				"<a href='PHP/report.php?id="+memeData[0]+"'>Report</a>";
								memestring+=			"</td>";
								memestring+=			"<td>";
								memestring+=				"<a href='PHP/reportCopy.php?id="+memeData[0]+"'>Copy</a>";
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
						if(blockedTag)
							memestring+="</div>";
				}
			}
			var compiledHtml = $compile(memestring)($scope);
			angular.element( document.querySelector( '#allMemes' ) ).append(compiledHtml);
			pagination++;
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

					finalString+="<a href='viewUser.php?id="+commentData[1]+"' >"+commentData[3]+"</a>";
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

});
