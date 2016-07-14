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
			case 'integer' 	:
			case 'double'  	:
			case 'string'  	:
				$this->PrettySimpleDataTypes($mixVar);
				break;
			case 'array'   	:
				$this->PrettyArrayDataTypes($mixVar);
				break;
			case 'object'  	:
				$this->PrettyObjectDataTypes($mixVar);
				break;
			default 	   	:
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
				break;
		}

		$style 				= $this->getStyleSheet($varType);

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
	 * Displays beautified var_dump of arrays data type.
	 * This is achieved by looping the array and converting key value pair of array into HTML table.
	 * Simple arrays will have a green color header and multidimensional array will have a blue color header.
	 * @param array $mixVar
	 * @return  string created HTML table 
	 */
	private function PrettyArrayDataTypes($mixVar)
	{
		$result 		 = "";

		$result 		.= $this->GetTableHeader($mixVar);

		foreach($mixVar as $key => $value)
		{
			$result 	.= $this->LoopArray($key, $value);
		}

		$result 		.= $this->GetTableFooter();
		$result 		.= $this->getStyleSheet(gettype($mixVar));

		echo $result;
	}

	/**
	 * Displays beautified var_dump of object data type.
	 * @param mixed $mixVar
	 * @return  string created HTML table
	 */
	private function PrettyObjectDataTypes($mixVar)
	{
		$result = "";
		$result .= $this->PrettyArrayDataTypes($mixVar);

		echo $result;
	}

	/**
	 * Converts Key value pair of parent array to HTML table
	 * @param string $key      key value of the parent array
	 * @param mixed  $mixValue value of the parent array
	 * @return  string Converted HTML table
	 */
	private function LoopArray($key, $mixValue)
	{	
		$result = "";

		$result .= $this->CheckAndAppendLoopValues($key, $mixValue);

		return $result;
	}

	/**
	 * Creates an HTML table row
	 * @param string $key      key part of array
	 * @param mixed  $mixValue value part of array
	 * @return  string created HTML row
	 */
	private function CheckAndAppendLoopValues($key, $mixValue)
	{
		$result 			= "";
		$result 			.= "<tr>";
		$result 			.= "<td>$key</td>";
		$result 			.= "<td>";

			
			if(!is_array($mixValue) && !is_object($mixValue))
			{	
				$result 	.= $mixValue;
			}
			else
			{	$result 	.= $this->GetTableHeader($mixValue);
				$result 	.= $this->LoopInnerArray($mixValue);
				$result 	.= $this->GetTableFooter();
				
			}
			$result 		.= "</td>";
			/* Commented showing Data type since its not relevant  
			$result 		.= "<td>".strtoupper(gettype($mixValue))."</td>"; */

		$result 			.= "</tr>";
				
		return $result;
	}

	/**
	 * Converts Key value pair of child array to HTML table
	 * @param array $mixVar child array
	 * @return sting created HTML child table
	 */
	private function LoopInnerArray($mixVar)
	{	
		$result 	= "";

		foreach($mixVar as $key => $value)
		{	
			$result .=  $this->CheckAndAppendLoopValues($key, $value);
		}

		return $result;
	}

	/**
	 * Gets HTML table header part to beautify array
	 * @param   array   $mixVar array to be beautify
	 * @return  string  converted HTML table header part
	 */
	private function GetTableHeader($mixVar)
	{
		$result 		= "";
		$type 			= gettype($mixVar);
		$size 			= "";

		if($type == 'object')
		{
			$mixVarDime = 'object';
		}
		else
		{	
			$mixVarDime = $this->GetDimension($mixVar);
			$size 		.= "(".sizeof($mixVar).")";
		}			

		$result 		.= "<table>";
		$result 		.= "<thead>";
		$result 		.= "<tr>";
		$result 		.= "<th colspan='2' class='array-".$mixVarDime."-th'>".strtoupper($type)."".$size."</th>";
		$result 		.= "</tr>";
		$result 		.= "</thead>";
		$result 		.= "<tbody>";
		$result 		.= "<tr>";
		$result 		.= "<th>Key</th>";
		$result 		.= "<th>Value</th>";
		/* Commented showing Data type since its not relevant
		$result .= "<th>Data Type</th>"; */
		$result 		.= "</tr>";

		return $result;
	}

	/**
	 * Gets html table footer part to beautify array
	 * @return  string HTML table footer part 
	 */
	private function GetTableFooter()
	{
		$result 	= "";
		$result 	.= "</tbody>";
		$result 	.= "</table>";

		return $result;
	}

	/**
	 * To get the style sheet for the pretty_dump
	 * @param  string $type variable type of the dumping variable
	 * @return string returning style sheets as a string
	 */
	private function getStyleSheet($type="")
	{
		$style 				= "<style>
								table {
								    border-collapse: collapse;
								}";
		
		

		if($type == 'array' || $type == 'object')
		{
			$style			.= "table, td, th {
								    border: 1px solid black;
								}";
			$style			.= "th {
								    text-align: center;
								}";
			$style			.= "td {
								    text-align: left;
								    padding:5px 5px 5px 5px;
								}";
		}
		else
		{
			$style			.= "table, td, th {
								    border: 1px solid black;
								    text-align: center;
								}";
		}


		switch($type)
		{
			case 'boolean'	:
				$style 		.= ".boolean-th{ background-color: #BF00FF; color: white; };";
				break;
			case 'integer'	:
				$style 		.= ".integer-th{ background-color: #00BFFF; color: white; };";
				break;
			case 'double'	:
				$style 		.= ".double-th{ background-color: #F57900; color: white; };";
				break;
			case 'string'	:
				$style 		.= ".string-th{ background-color: #CC0000; color: white; };";
				break;
			case 'array'	:
			case 'object'	:
				$style 		.= ".array-multi-th{ background-color: #0000FF; color: white; }";
				$style 		.= ".array-single-th{ background-color: #4E9A06; color: white; }";
				$style 		.= ".array-object-th{ background-color: #BFBFBF; color: white; };";
				break;
			default 		:
				break;
		}

		$style				.="</style>";

		return $style;
	}
	/**
	 * Gets the dimension of an array
	 * @param  array  $mixVar
	 * @return string dimension of the array
	 */
	private function GetDimension($mixVar)
	{	
		$dimension 				= "";
		$normCount 				= sizeof($mixVar);
		$recurCount 			= count($mixVar,1);

		if($normCount == $recurCount)
		{	
			$isSingle 			= 1;
			$dimension 			= "single";

			foreach($mixVar as $key=>$value)
			{
				$type 			= gettype($value);

				if($type == 'array' || $type == 'object')
					$isSingle 	= 0;
			}

			if(!$isSingle)
				$dimension 		= "multi";        
		}
		else
		{
			$dimension 			= "multi";          
		}

		return $dimension;
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
