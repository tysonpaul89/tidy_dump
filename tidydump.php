<?php 
class tidydump
{	
	/**
	 * @param  mixed $mixVar variable to be beautified
	 * @return string  html table formated var_dump
	 */
	public function tidy_dump($mixVar)
	{	
		$type = gettype($mixVar);

		switch($type)
		{
			case 'boolean'	:
			case 'integer'	:
			case 'double' 	:
			case 'string' 	:
				$this->PrettySimpleDataTypes($mixVar);
				break;
			case 'array' 	:
				$this->PrettyArrayDataTypes($mixVar);
				break;
			default 		:
				$this->PrettyVarDump($mixVar);
				break;
		}
	}

	/**
	 * Displays beautified var_dump of variable types boolean, integer, double and string.
	 * @param   mixed  $mixVar 
	 * 
	 */
	private function PrettySimpleDataTypes($mixVar)
	{	
		$class 				= "";

		$varType 			= gettype($mixVar);
		$value 				= $mixVar;
		$type  				= strtoupper($varType);

		switch ($varType)
		{
			case 'boolean'	:
			//{{
				if($mixVar)
					$value 	= "true";
				else
					$value 	= "false";

				$class 		= "boolean-th";
				break;
			//}}
			case 'integer'	:
			//{{
				$class 		= "integer-th";
				break;
			//}}
			case 'double'	:
			//{{
				$class 		= "double-th";
				$type 		= "FLOAT";
				break;
			//}}
			case 'string'	:
			//{{
				$class 		= "string-th";
				break;
			//}}
			default 		:
			//{{
				
			//}}
					break;
		}

		$style = $this->getStyleSheet($varType);

		echo $style;

		echo("<table>
				<thead>
					<tr>
						<th class='$class'>
							$type
						</th>
					</tr>
				</tead>
				<tbody>
					<tr>
						<td>
							$value
						</td>
					</tr>
				</tbody>
			</table>");
	}
	/**
	 * Displays beautified var_dump of sequential, multidimensional and associative arrays.
	 * @param array $mixVar
	 */
	private function PrettyArrayDataTypes($mixVar)
	{

	}

	/**
	 * To get the style sheet for the pretty_dump
	 * @param  string $type variable type of the dumping variable
	 * @return string       returning style sheets as a string
	 */
	private function getStyleSheet($type)
	{
		$style 				= "<style>
								table {
								    border-collapse: collapse;
								}

								table, td, th {
								    border: 1px solid black;
								    text-align: center;
								}";


		switch($type)
		{
			case 'boolean'	:
				$style 		.= ".boolean-th{ background-color: #75507B; color: white; }";
				break;
			case 'integer'	:
				$style 		.= ".integer-th{ background-color: #4E9A06; color: white; }";
				break;
			case 'double'	:
				$style 		.= ".double-th{ background-color: #F57900; color: white; }";
				break;
			case 'string'	:
				$style 		.= ".string-th{ background-color: #CC0000; color: white; }";
				break;
			default 		:
				break;
		}

		$style				.="</style>";

		return $style;
	}

	/**
	 * Displays var_dump with pre tag
	 * @param   mixed  $mixVar variable types boolean, integer, double, string
	 */
	private function PrettyVarDump($mixVar)
	{
		echo "<pre>";
		print_r($mixVar);
		echo "</pre>";
	}

}
?>
