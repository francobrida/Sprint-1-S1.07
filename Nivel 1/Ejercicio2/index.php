<?php

session_start();

try {
    
    if (!isset($_POST["username"]) || !isset($_POST["number"])){
        throw new Exception("Form Incomplete.");
    } else if ($_POST["username"] == ""){
        throw new Exception("Name is Empty.");
    } else if ($_POST["number"] === null || $_POST["number"] === "") { 
        throw new Exception("Number is Empty.");
    } else if (!is_numeric($_POST["number"])){
        throw new Exception("Number is not numeric.");
    } else {
    
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["number"] = $_POST["number"];
   
    echo $_SESSION["username"] . " " . $_SESSION["number"];
    } 

} catch (Exception $exception) {
    echo "Error: " . $exception->getMessage();
}

?>