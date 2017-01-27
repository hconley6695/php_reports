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

		echo '<div class="container">';
		$fileName = 'module_2_orders.csv';
		

		function openFile($fileName) {
			$row = 1;
			$titles = array();
			$newArray = array();

			//OPEN FILE BASED ON PARAMETER PASSED
			if (($handle = fopen($fileName, "r")) !== FALSE) {
				//LOOPING THROUGH ALL ROWS IN THE FILES
			  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				//IF IT'S THE FIRST ROW, MAKE IT INTO A TITLES ARRAY
			  	if ($row == 1){
			  		$num= count($data); //GET A TOTAL NUMBER OF COLUMNS
			  		$titles = $data;
			  		$row++;
			  	} else {
				  	$num = count($data);//ESTABLISHING TOTAL NUMBER OF COLUMNS AGAIN
			    	// THIS FOR LOOP PUTS THE FIRST ROW AS KEYS FOR THE REMAINING ROWS OR CAN MANIPULATE THEM TO PUT THEM AS COLUMN HEADERS
				    for($c=0; $c < $num; $c++) {
				    	//THIS IS CREATING KEYS WITH THE FIRST ROW IN THE CSV
					    $newArray[$data[0]][$titles[$c]] = $data[$c];	
					}
					$row++;	
			  	}
			  		
	      	  } 
	      	  fclose($handle);
			}
			// echo '<pre>';
			// print_r($newArray);
			return $newArray;
		}




		function orderByLastName($data) {
			if (!data){
				return 0;
			}

			$orderLastNameArray = array();
			//CHECK IF DATA IS PULL THROUGH THIS ARRAY
			if(array($data)) {
				foreach ($data as $orderId => $element) {
					// echo '<pre>';
					// print_r($data[0]['Name']);
						// THIS SPLITS UP THE NAME KEY INTO FIRST AND LAST
						$array_names = explode(" ", $element['Name']);
						// echo '<pre>';
						// print_r($array_names);

						// $firstName = $array_names[0];
						// $lastName = $array_names[1];
						$orderLastNameArray[$array_names[count($last_name)-1]][] = $element;
						// $orderLastNameArray['First Name'] = $firstName;
						// $orderLastNameArray['Last Name'] = $lastName;
						// $orderLastNameArray	
					}
				}
					// THIS DELETES THE FULL NAME COLUMN
			  		// unset($orderLastNameArray['Name']);
			ksort($orderLastNameArray);					
			return $orderLastNameArray;
		}



		function displayLastNameReport($array)  {
			$returnString = " ";

			if($array) {

				// .= CONCATENATION ASSIGNMENT WHICH APPENDS WHAT IS ON THE RIGHT TO WHAT IS ON THE LEFT
				$returnString .= '<table class="table last-name">
					<thead>
						<tr>
							<th>Order Number</th>
							<th>Name</th>
							<th>Email</th>
							<th>Product Category</th>
							<th>Product</th>
							<th>Price</th>
							<th>Ballance Due</th>
						</tr>
					<thead>
					<tbody>';

			    // Loop through main array
			    foreach ( $array as $last_name_array ){
			      // Loop through last name array
			      foreach ( $last_name_array as $single_contact ){
			        $error_class = '';
			        // Check to see if there is a balance due and apply appropriate styles
			        // if ( dollar_to_float( $single_contact['Balance Due'] ) > 0 ){
			        //   $error_class = ' style="background-color: #b36666"';
			        // }
			        $returnString .= '<tr'.$error_class.'>
			          <td>'.$single_contact['Name'].'</td>
			          <td>'.$single_contact['Email'].'</td>
			          <td>'.$single_contact['Product'].'</td>
			          <td>'.$single_contact['Product Category'].'</td>
			          <td>'.$single_contact['Price'].'</td>
			          <td>'.$single_contact['Balance Due'].'</td>
			        </tr>';
			      }
			    }
			    $returnString .= '</tbody></table>';
			  }

			return $returnString;
			}


// CALLING THE FIRST FUNCTION
		$initialData = openFile($fileName);  //OPENING FILE
		$dataByLastName = orderByLastName($initialData); //TAKING CSV FILE AND SORTING IT BY LAST NAME
		echo '<h2>Report by Last Name</h2>';
		echo displayLastNameReport($dataByLastName);  //NEED TO ECHO RESULTS OF 

		  		// echo '<pre>';
		  		// print_r($newArray);








		  		//THIS IS WHERE DATA SHOULD BE SORTED, BUT I CAN'T FIGURE IT OUT--ON TO MAKING BALANCES RED FOR NOW 1:00PM 1/27
		  		// ksort($newArray);//THIS SORTS EACH ARRAY INDIVIDUALLY BY KEY
		  		
		  // 		usort($Newarray, function ($a, $b) {
   	// 				return $a['optionNumber'] <=> $b['optionNumber'];
				// });

//PRINT OUT NEWARRAY RIGHT HERE!  NOT SORTED BUT EVERYTHING IS WORKING
		  // 		echo '<pre>';  
				// print_r($newArray);
				// var_dump($newArray);

			// THIS WAS WORKING!!!!!!!!!!!!!!!!
				// for($i = 0; $i < count($newArray); $i++) {

				// echo '<tr>';
				// $rows = array();
				// $rows = explode(',', $data_array[$i]);// use the cell/row delimiter what u need!
				// echo '<pre>';
				// print_r($newArray);//THIS GIVES ME AN ARRAY WITH ARRAYS INSIDE EACH THAT HAVE ARRAYS INSIDE EACH WITH ONE WORD??


					// THIS FOR LOOP CREATES THE TABLE
					// for($cell = 0; $cell < count($newArray); $cell++) {
						// echo '<pre>';
						// print_r($newArray);
						// $bgcolor='#ccc';
						// if ($newArray[0] != 0) {
						// 	// THIS IF/ELSE STATEMENT CREATES RED ROWS FOR THOSE THAT HAVE A BALANCE 
						// 	if ($newArray['Balance Due'] != "$0.00") {
						// 		$bgcolor='red';
						// 		echo '<td style="background-color:' . $bgcolor . '">' . $newArray[$cell] . '</th>';
						// 	} else {
						// 		$bgcolor='#ccc';
						// 		echo '<td style="background-color:' . $bgcolor . '">' . $newArray[$cell] . '</td>';
						// 	}
						// } else {
						// 	echo '<th style="background-color:' . $bgcolor . '">' . $newArray[$cell] . '</th>';
						// }
					// }

				// echo '</tr>';	
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

		// echo '</table>
		echo '</div>';

	?>

</body>
</html>