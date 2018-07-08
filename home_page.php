<!DOCTYPE html>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="home.css">
<link href="https://fonts.googleapis.com/css?family=Acme|Allura|Amatic+SC|Berkshire+Swash|Julius+Sans+One|Kaushan+Script|Merienda|Norican" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cinzel|Cookie|Dancing+Script|Lato|Patrick+Hand+SC|Rancho|Rock+Salt" rel="stylesheet">

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <ul class="nav navbar-nav">
              <li class="active"><button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#">Home</button></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#logModal"><span class="glyphicon glyphicon-log-in"></span>  Login</button></li>
            </ul>
        </nav>
      </div>
    </div>

    <div id="logModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Log In</h4>
          </div>
          <div class="modal-body">
            <form name="login_form" action="login.php" method="POST">
              Username:  <input type="text" name="username"><br><br>
              Password: <input type="password" name="password"><br><br>
              <button class="button btn-info btn-default btn-lg">Log In</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-lg" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="logo_name row">
      <br><br>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        <img src="logo.png" class="img-reponsive" id="logo"/>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
      <p id="name">Amity Institute of Engineering and Technology</p>
      </div>
    </div>

    <hr>
   
    <div class="row upper">
      <div id="myCarousel" class="carousel slide col-lg-7  col-md-7 col-sm-7 col-xs-7" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="3.jpg" alt="Silver Jubilee Tower">
            <div class="carousel-caption">
              <h2 class="caption">We build Futures.</h2>
              <p>Let us build yours.</p>
            </div>
          </div>

          <div class="item">
            <img src="1.jpg" alt="Chicago">
            <div class="carousel-caption">
              <h2 class="caption">Ample resources available.</h2>
              <p>Join us and get ready for a path of learning.</p>
            </div>
          </div>

          <div class="item">
            <img src="2.jpg" alt="New York">
            <div class="carousel-caption">
              <h2 class="caption">Awesome Placements.</h2>
              <p>Wanna get a job?</p>
            </div>
          </div>
        </div>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
      <div class="col-lg-5  col-md-5 col-sm-5 col-xs-5" id="outerdiv">
      <iframe src="bulletin.html" id="inneriframe" width="455" height="350"></iframe>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="jumbotron col-lg-12  col-md-12 col-sm-12 col-xs-12">
        <h1 class="abouthead">About our Institute</h1>
        <p class="about">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </div>
    </div>

    <div class="contact">
      <h1 class="text-center contactus"><u>CONTACT US</u></h1><br>
      <div id="map"></div>
        <script>
          function myMap() {
          var mapOptions = {
              center: new google.maps.LatLng(25.4591, 78.6404),
              zoom: 10,
              mapTypeId: google.maps.MapTypeId.HYBRID
          }
          var map = new google.maps.Map(document.getElementById("map"), mapOptions);
          }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyDmqxc36YeLCa_euehFkricIcdQhbr1Ggo&callback=myMap"></script>
      <br><br><br><br><br>
      <div class="contactinfo">
        <p class="text-center">Email ID: abcd@example.com<br>
        Phone Number: 9458712361<br>
        Address: 123, Abcd Block, Xyz Nagar, Ijk, UP, India</p>
      </div>
      <br><br><br><br><br><br><br><br><br><br>
    </div>

  </div>
</body>