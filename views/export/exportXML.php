<?php


function exportXMLFile($array,$arrayName){
    $dom = new DOMDocument();
    $dom->encoding = 'utf-8';
    $dom->xmlVersion = '1.0';
    $dom->formatOutput = true;
    $xml_file_name = 'export.xml';

    switch($arrayName){
        case 0://employees
            break;
        case 1: //programs
            for($i=0; $i<count($array); $i++){
                $programId   =  $array[$i]['prog_id']; 
                $programName   =  $array[$i]['program']; 
                $programRelease   =  $array[$i]['program_release']; 
                $programVersion   =  $array[$i]['program_version']; 
                $root = $dom->createElement('Programs');
                $program_node = $dom->createElement('program');
                // $attr_movie_id = new DOMAttr('movie_id', '5467');
                $attr_movie_id = new DOMAttr('prog_id', $programId);
        
                $program_node->setAttributeNode($attr_movie_id);
                $child_node_name = $dom->createElement('name', $programName);
                $program_node->appendChild($child_node_name);
                $child_node_release = $dom->createElement('release', $programRelease);
                $program_node->appendChild($child_node_release);
                $child_node_version = $dom->createElement('version', $programVersion);
                $program_node->appendChild($child_node_version);
                $root->appendChild($program_node);
                $dom->appendChild($root);
                
            }
            break;
        case 2: //area
            break;
    }
    
        
    $dom->save($xml_file_name);
    echo "$xml_file_name has been successfully created";

}

       
	
	function exportXML($data = null, $tablen) {
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

