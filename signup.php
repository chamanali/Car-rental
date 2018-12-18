<?php
    include_once 'resource/Database.php';
    include_once 'resource/utilities.php';
    
//process the form
     if(isset($_POST['signupBtn'])){

//initialising an array to store the error message from form

        $form_errors = array();
        
        
//form validation
    
        $required_fields = array('email', 'username', 'password');
        
//call the function to check empty field and merge the return data into form_error array
        
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
        
//filed that require checking for minimum length

        $fields_to_check_length = array('username' => 6, 'password' => 10);
        
//call the function to check minimum required length and merge the returned data into  for_error array

        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
        
//email validation / merge the return data into form_error array

        $form_errors = array_merge($form_errors, check_email($_POST));
        
/*
        
// loop through the required field array

        foreach($required_fields as $name_of_field){
            if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
                $form_errors[] = $name_of_field;
            }
        }*/



//collecting data from form

          $email   =$_POST['email'];
          $username=$_POST['username'];
          $password=$_POST['password'];
          
          if(checkDuplicateEntries("users", "email", $email, $db)){
              $result = flashMessage("Email is already taken, please try another one");
          }
          else if(checkDuplicateEntries("users", "username", $username, $db)){
              $result = flashMessage("username already taken");
          }
          
        /*if(checkDuplicateEntries("users", "email", $email, $db)){
            $result = flashMessage("Email already taken, Please try an otherone");
        }
        
         else if(checkDuplicateEntries("users", "username", $username, $db)){
            $result = flashMessage("Username already taken");
        }*/


//checking if array is empty

      else if(empty($form_errors)){

          
//hashing the password
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    try{
//creating sql insert statement
          $sqlInsert = "INSERT INTO users(username, email, password, join_date)
                        VALUES (:username, :email, :password, now())";
//PDO Prepared to sanitize data    
            $statement = $db->prepare($sqlInsert);
            $statement->execute(array(':username'=>$username, ':email'=>$email, ':password'=>$hashed_password));
            
            if($statement->rowCount() == 1){
            $result = flashMessage("Registration Successful", "PASS");
             }
  
        }catch(PDOException $ex){
            $result = flashMessage("An error occured: " .$ex->getMessage());

        }
            
    }
    
    else{
            if(count($form_errors) == 1){
                $result = flashMessage("There was one error in the form <br>");
                
            }else{
                $result = flashMessage("There were " .count($form_errors). " errors in the form <br>");

            }
    }
}
                 //$result .= "<ul style = 'color:red;'>";
                 
//loop through error array and show all items
                
                 //foreach($form_errors as $error){
                     
                    //$result .= "<li> {$error} </li>";
                
            //}
            
                    /*$result .= "</ul></p>"; 
                    
        }else{
            
            $result = "<p style='color:red;'> There were" .count($form_errors). "errors in the form <br>";
            
             $result .= "<ul style = 'color: red;'>"; 
             
//loop through error array and show all items
                 foreach($form_errors as $error){
                    $result .= "<li> {$error} </li>";
                }
                    $result .= "</ul></p>"; 
        }
    }
      
}
      

?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>SignUp page</title>
        
    </head>
    
    <body>
        <h2>User authentication system</h2>
        <h3>Register Form</h3>
        
<?php
        if(isset($result)) echo $result;
?>
<?php
        if(!empty($form_errors)) echo show_errors($form_errors);
?>*/

?>
        
<?php
$page_title = " User Authentication - Loginpage";
include_once 'partials/header.php';
include_once 'partials/footer.php';


?>

        
        <h2>Register Page</h2>

        
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
    <label for="emailField">Email</label>
    <input type="text" class="form-control" name ="email"id="emailField" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="usernameField">UserName</label>
    <input type="text" class="form-control" name ="username"id="UsernamesernameField" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="passwordField">Password</label>
    <input type="password" name = "password" class="form-control" id="passwordField" placeholder="Password">
  </div>
 
 
  <button type="submit" name ="signupBtn" class="btn btn-primary pull-right">SignUp</button>
</form>
            
        </section>
<p><a href="index.php">Back</a></p>

        
    </div> 
        
    </body>
</html>