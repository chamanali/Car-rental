<?php 
include_once 'resource/session.php';
?>


<!DOCTYPE html>
<html>
    <head lang="en">
        <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title><?php if(isset($page_title)) echo $page_title; ?></title>
        
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/custom.css" />

    </head>
    
    <body>
        
    
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Dublin Car Rentals <span class="sr-only">(current)</span></a>
          </li>
          
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
            </li>
  <?php if(isset($_SESSION['username'])): ?>
      
         <li class="nav-item active">
            <a class="nav-link" href="index.php">My Profile</a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="logout.php">LogOut</a>
         </li>
          

	<?php else: ?>
      
      
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="login.php">Login</a>
            <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Contact</a>
          </li>
          </li>
          
<?php endif ?>      
      
        </ul>
      </div>
    </nav>

    

    </body>
</html>