<?php
// Data Types
$a_bool    = TRUE;   	// a boolean
$a_integer = 123;   	// an integer
$a_float   = 12.345;   	// a float
$a_string  = "asdf";   	// a string

require_once "tidydump.php";

$obj = new tidydump();

echo "<h3>Normal var_dump :</h3>";
var_dump($a_bool);
var_dump($a_integer);
var_dump($a_float);
var_dump($a_string);

echo "<h3>tidy_dump:</h3>";
echo "<br/>";
$obj->tidy_dump($a_bool);
echo "<br/>";
$obj->tidy_dump($a_integer);
echo "<br/>";
$obj->tidy_dump($a_float);
echo "<br/>";
$obj->tidy_dump($a_string);
?>
