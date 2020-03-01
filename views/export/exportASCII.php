<?php
	function exportASCII($data = null) {
		if ($data == null) return;
		
		// Get keys and column number
		$keys = array_keys($data[0]);
		$column_num = sizeof($keys);
		
		// Get the max lenght of each column
		$lenghts = array();
		for ($i=0; $i<$column_num; $i++) $lenghts[$i] = strlen($keys[$i]);
		foreach ($data as $row) {
			for ($i=0; $i<$column_num; $i++) $lenghts[$i] = max($lenghts[$i], strlen($row[$keys[$i]]));
		}
		
		// Set row frame
		$rowFrame = '+';
		for ($i=0; $i<$column_num; $i++) {
			for ($j=0; $j<$lenghts[$i]+2; $j++) $rowFrame = $rowFrame . '-';
			$rowFrame = $rowFrame . '+';
		}
		$rowFrame = $rowFrame . '<br>';
		
		echo '<tt>';
		
		echo $rowFrame;
		
		// print keys
		for ($i=0; $i<$column_num; $i++) echo '| ' . str_replace('`', '&nbsp;', str_pad($keys[$i], $lenghts[$i], '`')) . ' ';
		echo '|<br>';
		
		echo $rowFrame;
		
		// print data
		foreach ($data as $row) {
			for ($i=0; $i<$column_num; $i++) echo '| ' . str_replace('`', '&nbsp;', str_pad($row[$keys[$i]], $lenghts[$i], '`')) . ' ';
			echo '|<br>';
			
			echo $rowFrame;
		}
		
		echo '</tt>';
	}
?>