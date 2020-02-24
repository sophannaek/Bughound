<?php 


    function addProgram($prog_name, $prog_release, $prog_version){
        global $connection; 
        $query= "INSERT INTO program (program_name, program_release, program_version) VALUES ('$prog_name','$prog_release', '$prog_version')";
        $statement = $connection->prepare($query);
        $insert_result = $statemnt->execute();
        if($insert_result){
            $prog_id = $connection->insert_id;
            $result_result->close();
            $message="A new program was added.";
           
        }else{
            $message="A new program failed to be added.";
        }
        echo $message; 
        return $prog_id;
    }

    function eidtProgram($prog_id,$prog_name, $prog_release, $prog_version){

    }
    
    function deleteProgram($prog_id){
        
    }

    

    $db->close();


?>
