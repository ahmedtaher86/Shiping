<?php
session_start();
?>

<?php if (isset($_SESSION['login-type']) && ($_SESSION['login-type'])=='admin') {?> 
 
 
  <!-- Nav Bar admin -->
  <div class="container-fluid">
    
    <nav class="navbar navbar-expand-lg navbar-dark ">
      <a class="navbar-brand" href="index.php"><img style="height: 130px;" src="images/index_Logo.jpg" alt="jimyshipping"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="admin_panel.php?crud=ADMINS">ADMINS<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_panel.php?crud=COURIERS">COURIERS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_panel.php?crud=CLIENTS">CLIENTS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_panel.php?filter=SHIPMENTS">SHIPMENTS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout from admin panel</a>
      </li>
        </ul>
        
      </div>
    </nav>

</div>
  <?php } 

  else { ?>


  <!-- Nav Bar user -->
<div class="container-fluid">
    
    <nav class="navbar navbar-expand-lg navbar-dark ">
      <a class="navbar-brand" href="index.php"><img style="height: 130px;" src="images/index_Logo.jpg" alt="jimyshipping"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about-us.php">ABOUT US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pricing.php">PRICING</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Work With Us
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #ceb98c;">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ABOUT US
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #ceb98c;">
              <a class="dropdown-item" href="about-us.php?show=history">History</a>
              <a class="dropdown-item" href="about-us.php?show=our-staff">Our Staff</a>
              
              <a class="dropdown-item" href="about-us.php?show=our-partners">Our Partners</a>
            </div>
          </li>
          
         
          <li class="nav-item">
            <a class="nav-link" href="index.php?show=Contact US">Contact US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order_shipment.php">Order a Shipment</a>
          </li>
          <?php if(empty($_SESSION['logged-in']))
      { ?>
          <li class="nav-item">
            <a class="nav-link" href="Log-in.php">Login</a>
          </li>
          <?php }
      else 
      { ?>
       <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
          <?php }
          ?>
          
        </ul>
        
      </div>
    </nav>

</div>

<?php } ?> 


