<?php
$page_title = " User Authentication - Homepage";
include_once 'partials/header.php';
include_once 'partials/footer.php';


?>


    <main role="main" class="container">

      <div class="flag">
        <h1>Dublin Car Rentals</h1>

      <?php if(!isset($_SESSION['username'])): ?>
          	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>


        <P class="lead">you are currently not signin <a href="login.php"> Login </a> Not a member yet..? <a href="signup.php">Signup</a></P>
        
<?php else: ?>
        <p class="lead">You are loged in as  <a href="logout.php">LogOut</a></p>

<?php endif ?>
      </div>

    </main>
        
        
        
        


    </body>
</html>