<?php

include "../PHP/connect.php";
include "checkIsAdmin.php";

if(!$isAdmin){
  die("You do not have access for this");
}
?>

<html ng-app="merchies">
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
  .largeContainer, .largeContainer img, .mediumContainer, .mediumContainer img, .smallContainer, .smallContainer img{
    border:0px !important;
  }
}
  .container{
    float:left;
    margin-left:10px;
    margin-bottom:10px;
  }
  .rotated{
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    border:1px solid black;
  }
  .largeContainer{
    width:347px;
    height:450px;
    border:1px solid red;
  }
  .large{
    width:327px;
    margin:1%;
    margin-top:5px;
  }
  .large.rotated{
    height:327px;
    width:420px;
    -webkit-transform-origin: 38% 52%;
    -moz-transform-origin: 38% 52%;
    -ms-transform-origin: 38% 52%;
    -o-transform-origin:  38% 52%;
  }
  .mediumContainer{
    width:310px;
    height:225px;
    border:1px solid yellow;
  }
  .medium{
    width:280px;
    margin:2%;
  }
  .medium.rotated{
    height:280px;
    width:214px;
    -webkit-transform-origin: 65% 50%;
    -moz-transform-origin:65% 50%;
    -ms-transform-origin:65% 50%;
    -o-transform-origin: 65% 50%;
  }
  .smallContainer{
    padding:5px;
    width:164px;
    height:200px;
    border:1px solid blue;
  }
  .small{
    width:154px;
  }
  .small.rotated{
    -webkit-transform-origin: 40% 50%;
    -moz-transform-origin:40% 50%;
    -ms-transform-origin:40% 50%;
    -o-transform-origin: 40% 50%;
    height:154px;
    width:200px;
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
      <td>Number:</td>
      <td><input type="text" id="private" ng-model = "numberOfSubmissions" value="1" /></td>
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
