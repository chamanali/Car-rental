<?php
//add the database connection script
include_once 'resource/Database.php';
include_once 'resource/utilities.php';


//process the form if the password reset button is clicked

    if(isset($_POST['passwordResetBtn'])){
//initialize an array to store any error message from the form

    $form_errors = array();
    
    
//form validation
    $required_fields = array('email', 'new_password', 'confirm_password');
    
//call the function to check if the field is empty and merge the return data ito form error araay

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    
//check for minimum length

    $fields_to_check_length = array('new_password' => 8, 'confirm_password' => 8);
    
//call the function to check the minimum length and merge the return data ito form error araay

     $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
     
//email validation

     $form_errors = array_merge($form_errors, check_email($_POST));
     
//check if array is empty

    if(empty($form_errors)){
        
          $email   =$_POST['email'];
          $password1=$_POST['new_password'];
          $password2=$_POST['confirm_password'];
          
//check if the new and confirm password match

    if($password1 != $password2){
        $result = "<p style='paddding:20px; border: 1px solid gray; color:red;'>Password does not match</p>";
        
    }
    else{
        try{
//creattin gsql select statement to verify if email address input exists in the database

        $sqlQuery = "SELECT email FROM users WHERE email =:email";
        
//PDO Statement for sanitizie

         $statement = $db->prepare($sqlQuery);
         
//excecute the query

         $statement->execute(array(':email'=>$email));
         
//check if record exist

        if($statement->rowCount() == 1){
            
//hash the password
        
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
        
/*sql statement to update the password

        $sqlUpdate = "UPDATE users SET password =:password WHERE email =:email";
        
        $statement = $db->prepare($sqlUpdate);
        
        $statement->execute(array(':password' => $hashed_password,':email'=>$email));
        
        
        $result = "<p style='paddding:20px; border: 1px solid gray; color:green;'>Password reset successful</p>";

        }
    else{
        $result = "<p style='paddding:20px; border: 1px solid gray; color:red;'>The email provided does not exist in the database, please try again</p>";
        
        } 
    }catch (PDOException $ex){
            $result = "<p style='paddding:20px;  border: 1px solid gray; color:red;'>An Error occured:" .$ex->getMessage()."</p>";

            }
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = "<p style = 'color:red;'> There was one error in the form <br>";
        }else{
            $result = "<p style='color:red;'> There were " .count($form_errors). " errors in the form <br>";

        }
        
    }
    
}

?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Password reset page</title>
        
    </head>
    
    <body>
        <h2>User authentication system</h2>
        <h3>Password reset Form</h3>
        
<?php
        if(isset($result)) echo $result;
?>
<?php
        if(!empty($form_errors)) echo show_errors($form_errors);
?>

<form method="post" action="">
            <table>
                <tr>
                    <td>Email:</td> <td><input type="text"value="" name="email"></td>
                </tr>
                <tr>
                    <td>New Password:</td> <td><input type="password"value=""  name="new_password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td> <td><input type="password"value=""  name="confirm_password"></td>
                </tr>
                <tr>
                    <td></td> <td><input style="float:right" type="submit" name="passwordResetBtn" value="Reset Password"></td>
                </tr>
            </table>
        </form>
        <p><a href="index.php">Back</a></p>*/
        
        
//sql statement to update the password

        $sqlUpdate = "UPDATE users SET password =:password WHERE email =:email";
        
        $statement = $db->prepare($sqlUpdate);
        
        $statement->execute(array(':password' => $hashed_password,':email'=>$email));
        
        
        $result = "<p style='paddding:20px; border: 1px solid gray; color:green;'>Password reset successful</p>";

        }
    else{
        $result = "<p style='paddding:20px; border: 1px solid gray; color:red;'>The email provided does not exist in the database, please try again</p>";
        
        } 
    }catch (PDOException $ex){
            $result = "<p style='paddding:20px;  border: 1px solid gray; color:red;'>An Error occured:" .$ex->getMessage()."</p>";

            }
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = "<p style = 'color:red;'> There was one error in the form <br>";
        }else{
            $result = "<p style='color:red;'> There were " .count($form_errors). " errors in the form <br>";

        }
        
    }
    
}

?>
        
<?php
$page_title = " User Authentication - Password reset page";
include_once 'partials/header.php';
include_once 'partials/footer.php';


?>

        
        <h2>Password Reset</h2>

        
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
    <label for="passwordField"> New Password</label>
    <input type="password" name = "new_password" class="form-control" id="passwordField" placeholder="New Password">
  </div>
  
  <div class="form-group">
    <label for="passwordField">Confirm Password</label>
    <input type="password" name = "confirm_password" class="form-control" id="passwordField" placeholder="Confirm Password">
  </div>
 
 
  <button type="submit" name ="passwordResetBtn" class="btn btn-primary pull-right">Reset Password</button>
</form>
            
        </section>
<p><a href="index.php">Back</a></p>

        
    </div> 
    
    </body>
</html>