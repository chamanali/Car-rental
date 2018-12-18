<?php

    include_once 'resource/session.php';
    include_once 'resource/Database.php';
    include_once 'resource/utilities.php';
    
    
    if(isset($_POST['loginBtn'])){
        
        //array to load errors
    
    $form_errors = array();
    
//validate

    $required_fields = array('username', 'password');
    
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    
    if(empty($form_errors)){
        
//collect form data of user

    $user     =$_POST['username'];
    
    $password =$_POST['password'];
        
//check if the user exists in the database

    $sqlQuery ="SELECT * FROM users WHERE username = :username";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':username' => $user));
    
    
    while($row = $statement->fetch()){
        
        $id              = $row['id'];
        $hashed_password = $row['password'];
        $username        = $$row['username'];
        
        
        if(password_verify($password, $hashed_password)){
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
//if login is successful then we are redirecting user to index page
            redirectTo('index');
           // header("location: index.php");
            
        }else{
            $result = flashMessage("UserName or password is Invalid");
        }
    }

    
    }else{
        if(count($form_errors) == 1){
            $result = flashMessage("There was one error in the form");
            
        }else{
            $result = flashMessage("There were " .count($form_errors). " error in the form </p>");
        }
    }
    
}


?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Loginpage</title>
        
    </head>
    
    <body>


<?php
$page_title = " User Authentication - Loginpage";
include_once 'partials/header.php';
include_once 'partials/footer.php';


?>

        
        <h2>Login Form</h2>

        
    <div class = "container">
        <section class="col col-lg-?">
            
    <?php
        if(isset($result)) echo $result;
?>

<?php
        if(!empty($form_errors)) echo show_errors($form_errors);
?>



        

        <form action="" method="post">
  <div class="form-group">
    <label for="usernameField">UserName</label>
    <input type="text" class="form-control" name ="username"id="UsernamesernameField" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="passwordField">Password</label>
    <input type="password" name = "password" class="form-control" id="passwordField" placeholder="Password">
  </div>
 
  <div class="checkbox">
    <label>
      <input name ="remember"type="checkbox"> Remember Me
    </label>
  </div>
  <a href="forgot_password.php">Forgot Password</a>
  <button type="submit" name ="loginBtn" class="btn btn-primary pull-right">Sign in</button>
</form>
            
        </section>
<p><a href="index.php">Back</a></p>

        
    </div>        


    </body>
</html>