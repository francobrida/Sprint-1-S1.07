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

    if (!isset($data["username"]) || !isset($data["number"])  || !isset($data["email"]) || !isset($data["phone"])) {

        throw new Exception("Formulario Incompleto.");

    } else {
        $data["username"] = trim($data["username"]);
        $data["number"] = trim($data["number"]);
        $data["email"] = trim($data["email"]);
        $data["phone"] = trim($data["phone"]);
    }
    
    // Email filtered with filter

    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email is not valid.");
    }

    // Phone Number filtered with regular expression

    if (!preg_match('/^[0-9]{7,15}$/', $data["phone"])) {
        throw new Exception("Phone Number is not valid.");
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
    $_SESSION["email"] = $data["email"];
    $_SESSION["phone"] = $data["phone"];
   
    echo $_SESSION["username"] . "<br>" .
     $_SESSION["number"] . "<br>" .
     $_SESSION["email"] . "<br>" . 
     $_SESSION["phone"];
    } 

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>