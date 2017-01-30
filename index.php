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



// THIS FUNCTION COPIED/PASTED FROM HEATHER, BUT NOT WORKING IN EITHER, I REALIZED
		function orderByLastName($data) {
			if (!data){
				return 0;
			}
			//CREATE NEW ARRAY FOR ALTERED ARRAY 	
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


		function orderByCategory($data) {
			if(!$data) {
				return 0;
			}
		
			//CREATE NEW ARRAY FOR ALTERED ARRAY
			$orderCategoryArray = array();

			if(array($data)) {

				foreach ($data as $orderId => $element) {


					// $orderCategoryArray[$element]['Product Category']['total'] = 
					// ksort($data[$orderId]['Product Category']);
					echo '<pre>';

					$new = array($data[$orderId]['Product Category']);	
					print_r($new);		
					$new['Categories'] = $new[0];
					unset($new[0]);
					
				

				}


			}

		}



		function displayLastNameReport($array)  {
			$returnString = " ";

			if($array) {

				// .= CONCATENATION ASSIGNMENT WHICH APPENDS WHAT IS ON THE RIGHT TO WHAT IS ON THE LEFT
				$returnString .= '<table class="table last-name">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Product Category</th>
							<th>Product</th>
							<th>Price</th>
							<th>Balance Due</th>
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
	        		if ($single_contact['Balance Due'] != "$0.00") {
						$bgcolor='red';				
       					$returnString .= '<tr'.$error_class.'>
				          <td style="background-color:' . $bgcolor .'">'.$single_contact['Name'].'</td>
				          <td style="background-color:' . $bgcolor .'">'.$single_contact['Email'].'</td>
				          <td style="background-color:' . $bgcolor .'">'.$single_contact['Product'].'</td>
				          <td style="background-color:' . $bgcolor .'">'.$single_contact['Product Category'].'</td>
				          <td style="background-color:' . $bgcolor .'">'.$single_contact['Price'].'</td>
				          <td style="background-color:' . $bgcolor .'">'.$single_contact['Balance Due'].'</td>
				        </tr>';
				    } else {
				    	$bgcolor='#ccc';				
				        $returnString .= '<tr >
				          <td>'.$single_contact['Name'].'</td>
				          <td>'.$single_contact['Email'].'</td>
				          <td>'.$single_contact['Product'].'</td>
				          <td>'.$single_contact['Product Category'].'</td>
				          <td>'.$single_contact['Price'].'</td>
				          <td>'.$single_contact['Balance Due'].'</td>
				        </tr>';
				    }
			      }
			    }
			    $returnString .= '</tbody></table>';
			  }

			return $returnString;
			}


		function displayByCategory($array) {
			$returnString = " ";

			if($array) {
				$returnString .= '<table class="table last-name">
					<thead>
						<tr>
							<th>Category</th>
							<th>Total</th>
							<th>No. of Orders</th>
							<th>Average Cost</th>
						</tr>
					<thead>
					<tbody>';
				$returnString .='</tbody></table>';

			}
			return $returnString;	
		}


// CALLING THE FUNCTIONS
		$initialData = openFile($fileName);  //OPENING FILE
		$dataByLastName = orderByLastName($initialData); //TAKING CSV FILE AND SORTING IT BY LAST NAME
		$dataByCategory = orderByCategory($initialData); //TAKING CSV FILE AND SORTING IT BY CATEGORY
		echo '<h2>Report by Last Name</h2>';
		echo displayLastNameReport($dataByLastName);
		echo '<h2>Report by Category</h2>';
		echo displayByCategory($dataByCategory);  //NEED TO ECHO RESULTS OF 		  		
		echo '</div>';

	?>

</body>
</html>