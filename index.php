<html>
<head>
	<meta charset="utf-8">
	<title>Working with Excel Reports</title>
</head>
<style>
	* {
		margin: 0;
		padding: 0;
	}

	.container {
		border: 1px solid blue;
		margin: 20px auto;
	}
	table, td {
		border: 1px solid #666;
		background-color: #ccc;
/*		height: 400px;
		width: 800px;*/
	}

	td {
		padding: 5px;
		text-align: left;
		word-wrap: nowrap;


	}
</style>
<body>
	<?php

		echo '<div class="container"><table border=1>';
		$fileName = 'module_2_orders.csv';

		$row = 1;
		// $col = 0;
		$titles = array();
		if (($handle = fopen($fileName, "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

		  	if ($row == 1){
		  		$titles = $data;
		  		// print_r($titles[0]);//THIS JUST EQUALS 'ORDER ID'
		  		$num= count($data);
		  		$row++;
		  		// for ($c=0; $c < $num; $c++) {

		  		// 	// print_r($data[$c]);
		  		// 	$new = array($data[$c]);
		  		// 	echo'<pre>';
		  		// 	print_r($new);
		  		// 	// $stuff = $data[$c];
		  		// 	return $new;
		  		// }
		  	} else {

			  	$num = count($data);
			    echo "<p> $num fields/arrays in line $row: <br /></p>\n";
			    $row++;
			    // echo '<pre>';
		    	// print_r($data);

			    for($c=0; $c < $num; $c++) {
				    $new[$titles[$c]] = $data[$c];				    	
				    echo '<pre>';
				    print_r($new['Name']);

		    	}
		  	}
	      }
		}

		// echo '<pre>';
		// print_r($titles);


		// DAY 4 OF DRUDGING THROUGH THIS:

//FIRST ATTEMPT		
		// function importCsvToArray($fileName) {
		// 	$row = 0;
		// 	$col = 0;

		// 	if(($handle = fopen($fileName, "r")) !== FALSE) {
		// 		while(($row = fgetcsv($handle)) !== FALSE) {
		// 			echo "new row";
		// 			// echo $row;
		// 			echo '<pre>';
		// 			print_r($row);
		// 			echo '</pre>';
		// 			// if(empty($fields)) {
		// 			// 	$fields = $row;
		// 			// 	continue;
		// 			// }
		// 			// foreach($row as $k => $value) {
		// 			// 	$results[$col][$fields[$k]] = $value; 
		// 			// }
		// 			// $col++;
		// 			// unset($row);
		// 		}
		// 		// if(!feof($handle)){
		// 		// 	echo "Error: unexpected fgets() failing.";
		// 		// }
		// 		fclose($handle);
		// 	}
		// 	// return $results;
		// // }

		// foreach ($csv_file as $row => $value) {
		// 	echo $row[$col];

		// }


////////////////


		// THIS SPLITS THE NAMES INTO FIRST AND LAST
			// $array_names = explode(" ", $rows[1], 2);
			// $firstName = $array_names[0];
			// $lastName = $array_names[1];

		// TRYING TO ADD AN EMPTY CELL TO ROWS WITH EMPTY LAST NAME.  RIGHT NOW, AN EMAIL IS FILLING IN THAT SPOT/INDEX.
			// if($rows[1] != "Name") {
			// 	$rows[1] = $firstName;
			// 	array_splice($rows, 2, 0, $lastName);
			// } else {
			// 	$rows[1] = "First Name";
			// 	array_splice($rows, 2, 0, "Last Name");
			// } 

//FIRST ATTEMPT AT SORTING
			// function sortByLastName($arr, $col, $dir=SORT_ASC) {
			// 	$sort_last = array();
			// 	foreach ($$arr as $key => $row) {
			// 		$sort_last[$key] = $row[$col];
					
			// 	}
			// 	array_multisort($sort_last, $dir, $arr);
			// }
			// sortByLastName($rows);

// SECOND ATTEMPT AT SORTING
			// function sortIt($outerArr, $innerArr, $direction) {
			// 	$rowsB = array();
			// 	foreach($outerArr as $innerArr => $stuff) {
			// 		// print_r($innerArr);//ANSWER: 0123456
			// 		// echo $stuff;//ANSWER: ORDER IDFIRST NAMELAST NAME....
			// 		// foreach($innerArr as $inmostArr => $stuff) {
			// 		// 	print_r($inmostArr);
			// 		// }

			// 		// print_r($rowsB);
			// 		}
			// 		// array_multisort($rowsB);
			// }
			// sortIt($rows, SORT_ASC);






		// THIS WAS WORKING!!!!!!!!!!!!!!!!
		// for($i = 0; $i < count($data_array); $i++) {
		// 	echo '<tr>';
		// 	$rows = array();
		// 	$rows = explode(',', $data_array[$i]);// use the cell/row delimiter what u need!
		// 	print_r($rows);//THIS GIVES ME AN ARRAY WITH ARRAYS INSIDE EACH THAT HAVE ARRAYS INSIDE EACH WITH ONE WORD??


			// THIS FOR LOOP CREATES THE TABLE
			// for($cell = 0; $cell < count($rows); $cell++) {

			// 	$bgcolor='#ccc';
			// 	if ($rows[0] != 0) {
					// THIS IF/ELSE STATEMENT CREATES RED ROWS FOR THOSE THAT HAVE A BALANCE 
			// 		if ($rows[7] != "$0.00") {
			// 			$bgcolor='red';
			// 			echo '<td style="background-color:' . $bgcolor . '">' . $rows[$cell] . '</th\d>';
			// 		} else {
			// 			$bgcolor='#ccc';
			// 			echo '<td style="background-color:' . $bgcolor . '">' . $rows[$cell] . '</td>';
			// 		}
			// 	} else {
			// 		echo '<th style="background-color:' . $bgcolor . '">' . $rows[$cell] . '</th>';
			// 	}
			// }
			// echo '</tr>';	
		// }
		echo '</table></div>';

	?>

</body>
</html>