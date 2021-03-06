var adminApp = angular.module( "merchies", [] );

adminApp.controller( "adminapp" ,  function($scope, $window, $http, $compile){

  $scope.submitOrder = function(){
    console.log("Runnings");
    for(var a=0;a<$scope.numberOfSubmissions;a++){
		$http.get("submitOrder.php?picid="+$scope.orderid+"&size="+$scope.size+"&private="+$scope.isPrivate).then(function(data){
			if( data.data == "true" ){
				console.log("Order added");
        $scope.orderid="";
        $scope.size="";
        $scope.isPrivate="";
			}
			else{
				console.log("Order failed" + data.data);
			}
		});
    }
    $scope.numberOfSubmissions=1;
	}

    $scope.getOrders = function(){
  		$http.get("getOrders.php").then(function(data){
        if(data.data=="false"){
          alert("No orders currently");
        }
        else{
          var allData=data.data.split(";");

          var allDataSplit=[];
          for(var a=0;a<allData.length;a++){
            allDataSplit.push(allData[a].split(":"));
          }

          //Solution from jahroy on stackoverflow
          allDataSplit.sort(function(a, b) {
            if (a[1] === b[1]) {
                return 0;
            }
            else {
                return (a[1] < b[1]) ? -1 : 1;
              }
          });

          for(var a=0;a<allData.length;a++){
            var isFlipped=false;
            var currentData = allDataSplit[a];

            var img = new Image();
            img.src='../userCookies/'+currentData[0]+'.png';
            img.mcsize = currentData[1];
            img.mcid = currentData[3];
            img.mcname = currentData[0];
            img.mcoid = currentData[2];
            img.onload=function(){
              var isFlipped = false;
              if(this.width<this.height){//If it is portrait
                isFlipped=!isFlipped;//Flip it
              }
                var finalString = "";
                console.log(this.mcsize);
                console.log(this.mcid);
                if(this.mcsize=="1"){
                  if(!isFlipped){
                    finalString+="<div class='largeContainer container' id='order"+this.mcid+"' ><image class='large rotated' src='../userCookies/"+this.mcname+".png' ng-click='fulfillOrder(\""+this.mcname+"\","+this.mcoid+", 1, "+this.mcid+")' /></div>";
                  }
                  else{
                    finalString+="<div class='largeContainer container' id='order"+this.mcid+"' ><image class='large' src='../userCookies/"+this.mcname+".png' ng-click='fulfillOrder(\""+this.mcname+"\","+this.mcoid+", 1, "+this.mcid+")' /></div>";
                  }
                }
                if(this.mcsize=="2"){
                  isFlipped=!isFlipped;
                  if(!isFlipped){
                    finalString+="<div class='mediumContainer container' id='order"+this.mcid+"' ><image class='medium rotated' src='../userCookies/"+this.mcname+".png' ng-click='fulfillOrder(\""+this.mcname+"\","+this.mcoid+", 2, "+this.mcid+" )' /></div>";
                  }
                  else{
                      finalString+="<div class='mediumContainer container' id='order"+this.mcid+"' ><image class='medium' src='../userCookies/"+this.mcname+".png' ng-click='fulfillOrder(\""+this.mcname+"\","+this.mcoid+", 2, "+this.mcid+" )' /></div>";
                  }
                }
                if(this.mcsize=="3"){
                  if(!isFlipped){
                    finalString+="<div class='smallContainer container' id='order"+this.mcid+"'><image class='small rotated' src='../userCookies/"+this.mcname+".png' ng-click='fulfillOrder(\""+this.mcname+"\","+this.mcoid+", 3, "+this.mcid+" )' /></div>";
                  }
                  else{
                    finalString+="<div class='smallContainer container' id='order"+this.mcid+"'><image class='small' src='../userCookies/"+this.mcname+".png' ng-click='fulfillOrder(\""+this.mcname+"\","+this.mcoid+", 3, "+this.mcid+" )' /></div>";
                  }
                }
              console.log(finalString);
              var compiledHtml = $compile(finalString)($scope);
              angular.element( document.querySelector( '#orders' ) ).append(compiledHtml);
              }
            }

        }
      });
    }

    $scope.fulfillOrder=function(cookieid, isPrivate, size, orderid){
      $http.get('completeOrder.php?cookie='+cookieid+'&isPrivate='+isPrivate+'&size='+size+'&orderid='+orderid).then(function(data){
        if(data.data=="true"){
          document.getElementById("order"+orderid).remove();
          console.log(data.data);
        }
        else{
          console.log(data.data);
        }
      });

    }
});
