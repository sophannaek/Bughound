<?php

function exportXMLFile($data = null, $tablen){
    if ($data == null) return;
    $dom = new DOMDocument();
    $dom->encoding = 'utf-8';
    $dom->xmlVersion = '1.0';
    $dom->formatOutput = true;
	$xml_file_name = "export.xml";
	if (strcmp($tablen, 'employees') == 0)
		$xml_file_name = "employees.xml";
	if (strcmp($tablen, 'programs') == 0)
		$xml_file_name = "programs.xml";
	if (strcmp($tablen, 'areas') == 0)
		$xml_file_name = "areas.xml";
    
    // Get keys and column number
    $keys = array_keys($data[0]);
    $column_num = sizeof($keys);
    foreach($data as $row){
        $root= $dom->createElement($tablen);
        for($i=0; $i<$column_num; $i++){
            //  echo  $keys[$i].' '.$row[$keys[$i]].'<br/>';               
            $node=$dom->createElement($keys[$i],$row[$keys[$i]]);
            $root->appendChild($node);              
        }           
        $dom->appendChild($root);
    }
    $dom->save($xml_file_name);
	
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment; filename= " . $xml_file_name);
	readfile($xml_file_name);
	
	exit;
}
       
	
	function displayXML($data = null, $tablen) {
		if ($data == null) return;
		
		// Get keys and column number
		$keys = array_keys($data[0]);
		$column_num = sizeof($keys);
		
		// Get the max lenght of each column
		echo "<table align='center'><tr><td><pre>";
		$lenghts = array();
		for ($i=0; $i<$column_num; $i++) $lenghts[$i] = strlen($keys[$i]);
		foreach ($data as $row) {
			for ($i=0; $i<$column_num; $i++) $lenghts[$i] = max($lenghts[$i], strlen($row[$keys[$i]]));
		}
		
                //echo $tablen;
                echo '&lt;'.'database name="bughound"'.'&gt;';
                    echo '<br>';
                
                foreach ($data as $row) {
                    // echo '&lt;'.'table name="'.$tablen.'"'.'&gt;';
                    echo "\t&lt;".'table name="'.$tablen.'"'.'&gt;';
                    echo '<br>';
                    for ($i=0; $i<$column_num; $i++) {                      
                        // echo '&lt;'.'column name="'.$keys[$i].'"'.'&gt;'.$row[$keys[$i]];
                        echo "\t\t&lt;".$keys[$i].'&gt;'.$row[$keys[$i]];
                        echo '&lt;/'.$keys[$i].'&gt;';
                        echo '<br>';
                        
                    }
                    echo "\t&lt;".'/table'.'&gt;';
                    echo '<br>';
                }
                echo '&lt;'.'/database'.'&gt;';
		echo '<br>';
		echo "</pre></tr></td></table>";
	}
?>

