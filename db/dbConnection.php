<?php   
  //connect to the database
  	$dbhost  = 'localhost'; 
	$dbname  = 'BugHound';   
	$dbuser  = 'root'; 
	$dbpass  = 'root'; 

  	$connection = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
  	if ($connection->connect_error) {
          die($connection->connect_error);
      }else{
         // echo "database is connected!<br/>";
      }
    
    /* display error */
    function display_db_error($error_message){
        global $app_path;
        echo $error_message;
        exit;
    }

    /**********  functions for Programs table ************/

    /* add a program */
    function addProgram($prog_name, $prog_release, $prog_version){
        global $connection; 
        echo "inside add program<br/>";
        echo $prog_name, $prog_release, $prog_version ."<br/>";
        
      //  $query= "INSERT INTO programs (program_name, program_release, program_version) VALUES ('$prog_name','$prog_release', '$prog_version')";

        $query='INSERT INTO programs
                (program, program_release, program_version) VALUES (?,?,?)';
        $statement = $connection->prepare($query);
        if($statement == false){
           // display_db_error($connection->error);
        }
        $statement->bind_param("sii",$prog_name, $prog_release,$prog_version);
        $success = $statement->execute();
        echo "success " .$success;
        
        if($success){
            $prog_id = $connection->insert_id;
            $statement->close();
            $message="<span style='color:green'>A new program was added.</span>";
            return $prog_id;
            
        }else{
            $message="<span style='color:red'>A new program failed to be added.</span>";
        }
        echo $message; 
    }
   /* update a program */
    function updateProgram($prog_id,$prog_name, $prog_release, $prog_version){
        global $connection;
        // $product_id_esc = $connection->escape_string($product_id);
        $query = "UPDATE programs
                    SET program = ?,
                        program_release = ?,
                        program_version = ?
                    WHERE prog_id =  ?" ;
        $statement = $connection->prepare($query);
        if($statement == false){
            display_db_error($connection->error);
        }
        $statement->bind_param("siii",$prog_name, $prog_release,$prog_version,$prog_id);
        $success = $statement->execute();
        if($success){
            // $product_id = $connection->insert_id;
            $row_count = $connection->affected_rows;
            $statement->close();
            return $row_count;
        
        } 
        else{
            display_db_error($connection->error);
        }
          

    }
    /* delete a program */
    function deleteProgram($prog_id){
        global $connection;
        echo 'prog id ' .$prog_id;
        $query = "DELETE FROM programs WHERE prog_id ='$prog_id' ";
        $statement= $connection->prepare($query);
         if($statement == false){
          display_db_error($connection->error);
        }
        $statement->bind_param("i",$prog_id);
        $success = $statement->execute(); 
       
      //  echo $success;
        if($success){
          $statement->close();
          echo "deleting....";
          return $success;
        }else {
          display_db_error($connection->error);
        }
      
      }
    
    /* get a program */
    function getProgram($prog_id){
        global $connection; 
        $query = "SELECT * FROM programs WHERE prog_id ='$prog_id'";
        $result = $connection->query($query); 
        if($result == false){
            display_db_error($connection->error);
        }
        $program =$result->fetch_assoc(); 
    
        $result ->free();
        return $program ;
    }

    /* list all programs */
    function getPrograms(){
        global $connection; 
        $query = 'SELECT * FROM programs ORDER BY prog_id';
        $result = $connection->query($query); 
        if($result == false){
            display_db_error($connection->error);
        }
        $programs = array(); 
        for($i=0; $i <$result->num_rows; $i++){
            $program = $result->fetch_assoc();
            $programs[] = $program; 
        }
        $result->free();
        return $programs;
    }

    /**********  functions for Employees table ************/



    /**********  functions for Areas table ************/
	// search and list areas with particular prog_id
	function getAreas($prog_id) {
		global $connection;
		$query = "SELECT * FROM areas WHERE prog_id = '$prog_id' ORDER BY area_id";
		$result = $connection->query($query);
		if($result == false){
            display_db_error($connection->error);
        }
		$areas = array();
		for ($i = 0; $i < $result->num_rows; $i++) {
			$areas[$i] = $result->fetch_assoc();
		}
		$result->free();
		return $areas;
	}
	
	// add a new area
	function addArea($prog_id, $area) {
		global $connection;
		$query = "INSERT INTO areas (area_id, prog_id, area) VALUES (null, '$prog_id', '$area')";
		$addStatement = $connection->prepare($query);
        if($addStatement == false){
           display_db_error($connection->error);
        }
		$exe = $addStatement->execute();
		
		return $exe;
	}
	
	// delete an area
   function deleteArea($area_id) {
		global $connection;
		$query = "DELETE FROM areas WHERE area_id = '$area_id'";
		$deleteStatement = $connection->prepare($query);
		if($deleteStatement == false){
			display_db_error($connection->error);
		}
		$exe = $deleteStatement->execute();
		
		return $exe;
   }
   
   // update an area
   function updateArea($area_id, $area) {
		global $connection;
		$query = "UPDATE areas SET area = '$area' WHERE area_id = '$area_id'";
		$updateStatement = $connection->prepare($query);
		if($updateStatement == false){
			display_db_error($connection->error);
		}
		$exe = $updateStatement->execute();
		
		return $exe;
   }
?>
