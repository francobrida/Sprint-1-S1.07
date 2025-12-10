<?php

session_start();

try {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = $_POST;
    } elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
        $data = $_GET;
    } else {
        throw new Exception("Invalid request method.");
    }

    if (!isset($data["username"]) || !isset($data["number"])){
        throw new Exception("Formulario Incompleto.");
    } else {
        $data["username"] = trim($data["username"]);
        $data["number"] = trim($data["number"]);
    }
    
    if ($data["username"] == ""){
        throw new Exception("Name is Empty.");
    }
    
    if ($data["number"] === null || $data["number"] === "") { 
        throw new Exception("Number is Empty.");
    } 
    
    if (!is_numeric($data["number"])){
        throw new Exception("Number is not numeric.");
    } 
    
    if (mb_strlen($data["username"]) < 3 || mb_strlen($data["username"]) > 15){
        throw new Exception("Name must be between 3 and 15 characters.");
    }
    
    if ($data["number"] < 1 || $data["number"] > 9999){
        throw new Exception("Number must be between 1 and 9999.");
    } 
    
    if (ctype_digit($data["username"])){
        throw new Exception("Name cannot be only numbers.");
    } 
    
    if (!ctype_digit($data["number"])){
        throw new Exception("Number cannot be decimal or negative.");
    } else {
    
    
    $_SESSION["username"] = $data["username"];
    $_SESSION["number"] = $data["number"];
   
    echo $_SESSION["username"] . " " . $_SESSION["number"];
    } 

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>