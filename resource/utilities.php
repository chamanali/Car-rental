<?php

/**
 * @param $required_fields_array, n array containing the list of all required fields
 * @returnn array, contains all errors
 */
 
 function check_empty_fields($required_fields_array){
//initialise an array to store error messages

    $form_errors = array();
    
    
//loop through the required fields array and popular the form error array

    foreach($required_fields_array as $name_of_field){
        if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
            $form_errors[] = $name_of_field. " is a required fields ";
        }
    }
    
        return $form_errors;
        
 }
 
 
/**
 * @param $required_fields_array, n array containing the list of all required fields
 * for which we want to check minimum required length e.g array('username'=> 4, 'email' => 12)
 * @returnn array, contains all errors
 */
 
 function check_min_length($fields_to_check_length){
     
//initializing an array to store error message

        $form_errors = array();
        
        
        foreach($fields_to_check_length as $name_of_field => $minimum_length_required){
            if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required){
                $form_errors[] = $name_of_field . " is too short, must be {$minimum_length_required} character long ";
                }
        }
        
        return $form_errors;
 }
 
 /**
  * @param $data, store a key/value pair array where key is the name of the form control
  * In this case 'email' and the value is the input the user entered
  * @return array, containing email errors
  */
  
  function check_email($data){
      
//initialize the array to store error messages

        $form_errors = array();
        $key = 'email';
        
//check if the key email exist in the data array

        if(array_key_exists($key, $data)){
            
//check if the email field has a value
        
        if($_POST[$key] != null){
            
//remove all illegal character from email field

        $key = filter_var($key, FILTER_SANITIZE_EMAIL);
        
//Check if input is valid email address

        if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false){
            $form_errors[] = $key . " is not a valid email address ";
         }
      }
    }
    
    return $form_errors;
}

/**
 * @param $form_error_array, the array holding all
 * errors which we want to loop through
 * @return string, list containing all error messages
 */
 
        function show_errors($form_errors_array){
            $errors = "<p><ul style='color:red;'>";
            
//loop through error array and show all items in the list

        foreach($form_errors_array as $the_error){
            $errors .= "<li> {$the_error} </li>";
        }
        
            $errors .= "</ul></p>";
            return $errors;
    }
    
    function flashMessage($message, $passOrFail = "Fail"){
        if($passOrFail === "Pass"){
            $data = "<p style='paddding:20px;  border: 1px solid gray; color:blue;'> {$message} </p>"; 
        }else{
            $data = "<p style='paddding:20px;  border: 1px solid gray; color:green;'>{$message} </p>";

        }
        return $data;
    }
        
        
        function redirectTo($page){
            header("Location: {$page}.php");
        }
       /* function checkDuplicateEntries($table, $column_name, $value, $db){
            try{
                $sqlQuery = "SELECT * FROM" .$table. "WHERE" .$column_name." =:$column_name";
                $statement =$db->prepare($sqlQuery);
                $statement->execute(array(':$column_name' => $value));
                
            if($row = $statement->fetch()){
                return true;
            }
                return false;
                
        }catch (PDOException $ex){
//handle exception
            }
        }
        */
        function checkDuplicateEntries($table, $column_name, $value, $db){
            
            try{
                $sqlQuery = "SELECT username FROM users  WHERE email=:email ";
                $statement = $db->prepare($sqlQuery);
                $statement->execute(array(':email' => $value));
                
            if($row = $statement->fetch()){
                return true;
            }
                return false;
            
           }catch (PDOException $ex){
               //handle exception
           }
    }
        
        