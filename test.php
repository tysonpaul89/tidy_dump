<?php
// Data Types
$a_bool    = TRUE;   	// a boolean
$a_integer = 123;   	// an integer
$a_float   = 12.345;   	// a float
$a_string  = "asdf";   	// a string
// an Array
$a_array   = array("one" => 1, "two" => 2, "three" => 3, 4 => array(1,2,3), "five" => array("one", "two", "three",4 => array(1,2,3)), "six" => 6, "seven" => 7);

// a JSON object
$a_json    = 	'{	
					"request_identifier":"188445503020",
					"resource_data_cache":
											[
												{ 
													"pin_thumbnail_urls":[  
															                  "https://test_url_0_0.hmtl",
															                  "https://test_url_0_1.hmtl",
															                  "https://test_url_0_2.hmtl",
															                  "https://test_url_0_3.hmtl",
															                  "https://test_url_0_4.hmtl"
															               ]
												},
												{ 
													"thumbnail_urls":
																		[
																			{
																				"link0":"https://test_url_1_0.hmtl", 
																				"link1":"https://test_url_1_1.hmtl", 
																				"link2":"https://test_url_1_2.hmtl"
																			}
																		]
												}
											]
				}';

// Imports tidydump code
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

echo "<h3>var_dump and tidy_dump of complex JSON object :</h3>";
$d_json = json_decode($a_json);
echo "<pre>";
print_r($d_json);
echo "</pre>";

$obj->tidy_dump($d_json);
?>
