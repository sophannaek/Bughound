<?php
	function exportXML($data = null, $tablen) {
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
		
                //echo $tablen;
                echo '&lt;'.'database name="bughound"'.'&gt;';
                    echo '<br>';
                
                foreach ($data as $row) {
                    echo '&lt;'.'table name="'.$tablen.'"'.'&gt;';
                    echo '<br>';
                    for ($i=0; $i<$column_num; $i++) {                      
                        echo '&lt;'.'column name="'.$keys[$i].'"'.'&gt;'.$row[$keys[$i]];
                        echo '&lt;'.'\column'.'&gt;';
                        echo '<br>';
                        
                    }
                    echo '&lt;'.'\table'.'&gt;';
                    echo '<br>';
                }
                echo '&lt;'.'\database'.'&gt;';
                    echo '<br>';
	}
?>


