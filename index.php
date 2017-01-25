<html>
<head>
	<meta charset="utf-8">
	<title>Working with Excel Reports</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php

		echo '<div class="container"><table border=1>';
		$fileName = 'Module_2_Orders.csv';

		$handle = fopen($fileName, 'r');
		$data_in = fread($handle, filesize($fileName));
		// echo $data_in;
		fclose($handle);

		$data_array = array();
		$data_array = preg_split("/\r\n|\n|\r/", $data_in);

		// $data_array = preg_replace('~\r\n?~', '\n', $data_in);
		// $data_array = explode("\n", $data_in);  // IMPORTANT the delimiter here just the "new line" \r\n, use what u need instead of..

////////////
		// if ($i == 0) {
		// 	echo "I'm awesome";
		// 	echo '<tr>';
		// 	$table_header = array();
		// 	echo $data_array[$i];
			//COMMENTED OUT WITHIN FUNCTION
			// echo $table_header;

			// $table_header = explode(',', $data_array[$i]);
			// if ($cell = 0) {
			// 	echo '<th>' . $table_header[$cell] . '</th'>;
			// }
			// echo '</tr>';
			////WITHIN THIS BLOCK
		// } else {
		// 	echo "You don't know what you are doing.";
		// }
/////////////////
		for($i = 1; $i < count($data_array); $i++) {
			echo '<tr>';
			$rows = array();
			$rows = explode(',', $data_array[$i]);// use the cell/row delimiter what u need!


// THIS IS TARGETING THE FIRST COLUMN, I NEED TO TARGET FIRST ROW FOR TH.
			for($cell = 0; $cell < count($rows); $cell++) {
				if ($cell != 0) {
					echo '<td>' . $rows[$cell] . '</td>';
				} else {
					echo '<th>' . $rows[$cell] . '</th>';
				}
			}

			echo '</tr>';
			
		}

		echo '</table></div>';


	?>

</body>
</html>