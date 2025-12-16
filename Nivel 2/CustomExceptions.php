<?php
// Wasn't shure if these were supposed to go each on a different PHP file. 
// From what I've read, they could also be placed at the start of index.php, but tried to optimize.

class RequestException extends Exception {}
class EmptyFieldException extends Exception {}
class InvalidNameException extends Exception {}
class InvalidNumberException extends Exception {}

?>