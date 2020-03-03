<?php


function exportXML($array,$arrayName){
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



// function exportXML($programsArray){
//     $dom = new DOMDocument();
//     $dom->encoding = 'utf-8';
//     $dom->xmlVersion = '1.0';
//     $dom->formatOutput = true;
//     $xml_file_name = 'export.xml';
//     for($i=0; $i<count($programsArray); $i++){
//         $programId   =  $programsArray[$i]['prog_id']; 
//         $programName   =  $programsArray[$i]['program']; 
//         $programRelease   =  $programsArray[$i]['program_release']; 
//         $programVersion   =  $programsArray[$i]['program_version']; 
// 		$root = $dom->createElement('Programs');
// 		$program_node = $dom->createElement('program');
//         // $attr_movie_id = new DOMAttr('movie_id', '5467');
//         $attr_movie_id = new DOMAttr('prog_id', $programId);

// 		$program_node->setAttributeNode($attr_movie_id);
// 	    $child_node_name = $dom->createElement('name', $programName);
// 		$program_node->appendChild($child_node_name);
// 		$child_node_release = $dom->createElement('release', $programRelease);
// 		$program_node->appendChild($child_node_release);
// 	    $child_node_version = $dom->createElement('version', $programVersion);
// 		$program_node->appendChild($child_node_version);
// 		$root->appendChild($program_node);
//         $dom->appendChild($root);
        
//         }
        
//         $dom->save($xml_file_name);
//         echo "$xml_file_name has been successfully created";

// }

       
	
?>
