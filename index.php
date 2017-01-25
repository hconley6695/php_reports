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
		$fileName = 'Module_2_Orders.csv';

		$handle = fopen($fileName, 'r');
		$data_in = fread($handle, filesize($fileName));
		// echo $data_in;
		fclose($handle);

		$data_array = array();
		$data_array = preg_split("/\r\n|\n|\r/", $data_in);//USE THE CELL/ROW DELIMITER; THIS TARGETS END OF LINE

		for($i = 0; $i < count($data_array); $i++) {
			echo '<tr>';
			$rows = array();
			$rows = explode(',', $data_array[$i]);// use the cell/row delimiter what u need!

		// THIS SPLITS THE NAMES INTO FIRST AND LAST
			$array_names = explode(" ", $rows[1]);
			$firstName = $array_names[0];
			$lastName = $array_names[1];

			if($rows[1] != "Name") {
				$rows[1] = $firstName;
				array_splice($rows, 2, 0, $lastName);


			} else {
				$rows[1] = "First Name";
				array_splice($rows, 2, 0, "Last Name");

			}

			// THIS FOR LOOP CREATES THE TABLE
			for($cell = 0; $cell < count($rows); $cell++) {


				$bgcolor='#ccc';
				if ($rows[0] != 0) {
					// THIS IF/ELSE STATEMENT CREATES RED ROWS FOR THOSE THAT AREN'T 
					if ($rows[7] != "$0.00") {
						$bgcolor='red';
						echo '<td style="background-color:' . $bgcolor . '">' . $rows[$cell] . '</th\d>';
					} else {
						$bgcolor='#ccc';
						echo '<td style="background-color:' . $bgcolor . '">' . $rows[$cell] . '</td>';
					}
				} else {

					echo '<th style="background-color:' . $bgcolor . '">' . $rows[$cell] . '</th>';
				}
			}

			echo '</tr>';	
		}

		echo '</table></div>';




	?>

</body>
</html>