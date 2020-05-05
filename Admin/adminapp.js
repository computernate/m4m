var adminApp = angular.module( "money4memes", [] );

adminApp.controller( "adminapp" ,  function($scope, $window, $http, $compile){

  $scope.submitOrder = function(){
    console.log("Runnings");
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

    $scope.getOrders = function(){
  		$http.get("getOrders.php").then(function(data){
        if(data.data=="false"){
          alert("No orders currently");
        }
        else{
          var finalString="";
          console.log(data.data);
          var allData=data.data.split(";");
          for(var a=0;a<allData.length;a++){
            var totalSpace=0;
            var currentData = allData[a].split(":");
            if(currentData[1]=="1"){
              finalString+="<image class='large' src='../Memes/"+currentData[0]+".png' ng-click='fulfillOrder(\""+currentData[0]+"\","+currentData[2]+")' />";
            }
            if(currentData[1]=="2"){
              finalString+="<image class='medium' src='../Memes/"+currentData[0]+".png' ng-click='fulfillOrder(\""+currentData[0]+"\","+currentData[2]+")' />";
            }
            if(currentData[1]=="3"){
              finalString+="<image class='small' src='../Memes/"+currentData[0]+".png' ng-click='fulfillOrder(\""+currentData[0]+"\","+currentData[2]+")' />";
            }
          }
    			var compiledHtml = $compile(finalString)($scope);
    			angular.element( document.querySelector( '#orders' ) ).append(compiledHtml);
        }
      });
    }
});
