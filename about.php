<?php
include 'connect.php';
include 'header.php';     
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>
  

  
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/1.jpg" alt="Chania">
    </div>

    <div class="item"> 
      <img src="img/3.jpg" alt="Chania">
    </div>

    <div class="item">
      <img src="img/2.jpg" alt="Flower">
    </div>

    <div class="item">
      <img src="img/4.jpg" alt="Flower">
    </div>
  </div>


  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
