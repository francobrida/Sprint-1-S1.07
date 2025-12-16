<?php
require_once './CustomExceptions.php';

session_start();

try {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = $_POST; 
    } elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
        $data = $_GET;
    } else {
        throw new RequestException("Invalid request method.");
    }

    if (!isset($data["username"]) || !isset($data["number"])){
        throw new Exception("Form Incomplete.");
    } else {
        $data["username"] = trim($data["username"]);
        $data["number"] = trim($data["number"]);
    }
    
    if ($data["username"] == ""){
        throw new EmptyFieldException("Name is Empty.");
    }
    
    if ($data["number"] === null || $data["number"] === "") { 
        throw new EmptyFieldException("Number is Empty.");
    } 
    
    if (!is_numeric($data["number"])){
        throw new InvalidNumberException("Number is not numeric.");
    } 
    
    if (mb_strlen($data["username"]) < 3 || mb_strlen($data["username"]) > 15){ // A few magic numbers here, hope it's not a problem
        throw new InvalidNameException("Name must be between 3 and 15 characters.");
    }
    
    if ($data["number"] < 1 || $data["number"] > 9999){  // also here
        throw new InvalidNumberException("Number must be between 1 and 9999.");
    } 
    
    if (ctype_digit($data["username"])){
        throw new InvalidNameException("Name cannot be only numbers.");
    } 
    
    if (!ctype_digit($data["number"])){
        throw new InvalidNumberException("Number cannot be decimal or negative.");
    } else {
    
    
    $_SESSION["username"] = $data["username"];
    $_SESSION["number"] = $data["number"];
   
    echo $_SESSION["username"] . " " . $_SESSION["number"];
    } 

} catch (RequestException $exception){
    echo "Request Error" . $exception->getMessage();
} catch (EmptyFieldException $exception){
    echo "Empty Field Error: " . $exception->getMessage();
} catch (InvalidNameException $exception){  
    echo "Invalid Name Error: " . $exception->getMessage();
} catch (InvalidNumberException $exception){
    echo "Invalid Number Error: " . $exception->getMessage();
} catch (Exception $exception) {
    echo "Error: " . $exception->getMessage();
}

?>