
<?php

$username = 'root';
$dsn      = 'mysql:host=localhost; dbname=register';
$password = '';




try{
    $db= new PDO($dsn, $username, $password, $phone);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "connected to the database";
}catch(PDOException $ex){
    echo "connection failed".$ex->getMessage();
}
