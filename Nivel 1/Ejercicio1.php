<?php

function divide($num1, $num2) {

    if ($num2 == 0) {
        throw new Exception("Division by zero is not possible.");
    } 

    return $num1 / $num2;

}

try {
    echo divide(8, 0);
} catch (Exception $exception) {
    echo "Error: " . $exception->getMessage();
}

?>