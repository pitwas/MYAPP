<?php
include'connect.php';
include'header.php';
 ?>
 
 <div data-ng-app="">
  <p>Name : <input type="text" ng-model="firstName"></p>
  <h1>Hello {{firstName}}</h1>
  <div data-ng-init="firstName='John'">

<p>The name is <span data-ng-bind="firstName"></span></p>
</div>


