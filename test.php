<?php
// Data Types
$a_bool    = TRUE;   	// a boolean
$a_integer = 123;   	// an integer
$a_float   = 12.345;   	// a float
$a_string  = "asdf";   	// a string
// an Array
$a_array   = array("one" => 1, "two" => 2, "three" => 3, 4 => array(1,2,3), "five" => array("one", "two", "three",4 => array(1,2,3)), "six" => 6, "seven" => 7);

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
echo "<br/>";

echo "<h3>var_dump and tidy_dump of array :</h3>";
var_dump($a_array);
echo "<br/>";
$obj->tidy_dump($a_array);

echo "<h3>tidy_dump of &#36;_SERVER :</h3>";
$obj->tidy_dump($_SERVER);
?>
