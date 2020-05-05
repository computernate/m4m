<?php

include "../PHP/connect.php";
include "checkIsAdmin.php";

if(!$isAdmin){
  die("You do not have access for this");
}
?>

<html ng-app="money4memes">
<head>
  <script src="../JS/angular.js"> </script>
  <script src="adminapp.js"> </script>

<style>
@media print{
  body{
    margin:0px;
    padding:5px;
  }
  .hideOnPrint, table, td, tr{
    display:none;
    height:0px;
  }
}
  .large{
    width:48%;
    float:left;
    margin:1%;
    margin-top:0px;
  }
  .medium{
    -webkit-transform:rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
    height:48%;
    float:left;
    margin:2%;
  }
  .small{
    width:23%;
    float:left;
    margin:2%;
    margin-top:0px;
  }
</style>

</head>
<body ng-controller="adminapp">
  <table class="hideOnPrint">
    <tr>
      <td>ID:</td>
      <td><input type="text" id="orderid" ng-model = "orderid" /></td>
    </tr>
    <tr>
      <td>Size</td>
      <td><input type="text" id="size" ng-model = "size" /></td>
    </tr>
    <tr>
      <td>Private:</td>
      <td><input type="text" id="private" ng-model = "isPrivate" /></td>
    </tr>
    <tr>
      <td colspan="2"><input type="button" ng-click = "submitOrder()" value="submitOrder" /></td>
    </tr>
  </table>

  <input type="button" ng-click="getOrders()" value="getOrders"  class="hideOnPrint" />
  <div id="orders">

  </div>

  </body>
</html>
