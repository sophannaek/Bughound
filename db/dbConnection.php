<?php   
  //connect to the database
  	$dbhost  = 'localhost'; 
	$dbname  = 'BugHound';   
	$dbuser  = 'root'; 
	$dbpass  = ''; 

  	$connection = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
  	if ($connection->connect_error) {
          die($connection->connect_error);
    }
    
    
    /* display error */
    function display_db_error($error_message){
        global $app_path;
        echo $error_message;
        exit;
    }

    /** function for login  */
    function isValidUser($user,$pass){
        global $connection;
        $query = "SELECT * FROM employees WHERE username ='$user' and password = '$pass' ";
        $result = $connection->query($query); 

        if($result == false){
            display_db_error($connection->error);
        }
        return $result ;

    }
    function getUserLevel($user){
        global $connection;
        $query = "SELECT userlevel FROM employees WHERE username ='$user' ";
        $result = $connection->query($query); 

        if($result == false){
            display_db_error($connection->error);
        }
        $userlevel = $result->fetch_assoc(); 
        $result->free();
        return $userlevel;
    }

    function destroySession(){
        $_SESSION=array();

        if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');
            session_destroy();
    }
    

    /**********  functions for Programs table ************/

    /* add a program */
    function addProgram($prog_name, $prog_release, $prog_version){
        global $connection; 
        //echo "inside add program<br/>";
        //echo $prog_name, $prog_release, $prog_version ."<br/>";
        
      //  $query= "INSERT INTO programs (program_name, program_release, program_version) VALUES ('$prog_name','$prog_release', '$prog_version')";

        $query='INSERT INTO programs
                (program, program_release, program_version) VALUES (?,?,?)';
        $statement = $connection->prepare($query);
        if($statement == false){
           // display_db_error($connection->error);
        }
        $statement->bind_param("sii",$prog_name, $prog_release,$prog_version);
        $success = $statement->execute();
        //echo "success " .$success;
        
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
        //echo 'prog id ' .$prog_id;
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
    
    
    function addEmployee($user_id, $user_name,$user_password,$user_level){
        global $connection; 
        //echo "inside add employee<br/>";
        //echo $user_id, $user_name,$user_password,$user_level ."<br/>";
        
      //  $query= "INSERT INTO programs (program_name, program_release, program_version) VALUES ('$prog_name','$prog_release', '$prog_version')";

        $query='INSERT INTO employees
                (name, username, password, userlevel) VALUES (?,?,?,?)';
        $statement = $connection->prepare($query);
        if($statement == false){
           // display_db_error($connection->error);
        }
        $statement->bind_param("sssi",$user_id, $user_name,$user_password,$user_level);
        $success = $statement->execute();
        //echo "success " .$success;
     //?   
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
    function updateEmployee($emp_id, $user_id, $user_name, $user_password, $user_level){
        global $connection;
        // $product_id_esc = $connection->escape_string($product_id);
        $query = "UPDATE employees
                    SET name = ?,
                        username = ?,
                        password = ?,
                        userlevel = ?
                    WHERE emp_id =  ?" ;
        $statement = $connection->prepare($query);
        if($statement == false){
            display_db_error($connection->error);
        }
        $statement->bind_param("sssii",$user_id, $user_name, $user_password, $user_level,$emp_id);
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
    
      function deleteEmployee($emp_id){
        global $connection;
        //echo 'emp id ' .$emp_id;
        $query = "DELETE FROM employees WHERE emp_id ='$emp_id' ";
        $statement= $connection->prepare($query);
         if($statement == false){
          display_db_error($connection->error);
        }
        //$statement->bind_param("i",$emp_id);
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
    function getEmployee($emp_id){
        global $connection; 
        $query = "SELECT * FROM employees WHERE emp_id ='$emp_id'";
        $result = $connection->query($query); 
        if($result == false){
            display_db_error($connection->error);
        }
        $employee =$result->fetch_assoc(); 
    
        $result ->free();
        return $employee ;
    }
    
    
    /* list all employees */
    function getEmployees(){
        global $connection; 
        $query = 'SELECT * FROM employees ORDER BY emp_id';
        $result = $connection->query($query); 
        if($result == false){
            display_db_error($connection->error);
        }
        $employees = array(); 
        for($i=0; $i <$result->num_rows; $i++){
            $employee = $result->fetch_assoc();
            $employees[] = $employee; 
        }
        $result->free();
        return $employees;
    }



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

	// search and list all areas
	function getAllAreas() {
		global $connection;
		$query = "SELECT * FROM areas ORDER BY area_id";
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
 
   /******************* Functions for Bugs ************************/


   /* adding new bug */
   //21 parameters
   function addBug($reportType ,$severity, $problem_summary,$reproducible,$problem, $suggestedFix,$reportedBy,
   $reportedByDate, $functionalArea, $assignedTo, $comments, $status, $priority, $resolution, $resolutionVersion,
   $resolvedBy, $resolvedByDate, $testedBy, $testedByDate, $deferred,$prog_id ){
        global $connection; 
        //echo "adding bugs......";
        
//   echo 'prog id: '.$prog_id.'<br/>';
//   echo 'report type: '.$reportType.'<br/>';
//   echo 'serverity: '.$severity.'<br/>';
//   echo "problem summary..".$problem_summary.'<br/>';
//   echo 'reproducilbe: '.$reproducible.'<br/>';
//   echo 'reportedBy: '.$reportedBy.'<br/>';
//   echo 'reportedByDate: '.$reportedByDate.'<br/>';
//   echo 'functional area: '.$functionalArea.'<br/>';
//   echo 'assignTo: '.$assignedTo.'<br/>';
//   echo 'comment: '.$comments.'<br/>';
//   echo 'status: '.$status.'<br/>';
//   echo 'priority: '.$priority.'<br/>';
//   echo 'resolution: '.$resolution.'<br/>';
//   echo 'resolutionversion: '.$resolutionVersion.'<br/>';
//   echo 'resolvedBy: '.$resolvedBy.'<br/>';
//   echo 'resolvedByDate: '.$resolvedByDate.'<br/>';
//   echo 'testedBy: '.$testedBy.'<br/>';
  

        $query="INSERT INTO bugs
        (reportType, severity, problemSummary,reproducible,problem,suggestedFix, reportedBy,
        reportedByDate,functionalArea, assignedTo,comments,bugStatus,priority, resolution,resolutionVersion,
        resolvedBy,resolvedByDate,testedBy,testedByDate, treatAsDeferred,emp_id,prog_id) VALUES ('$reportType','$severity','$problem_summary','$reproducible','$problem',
        '$suggestedFix','$reportedBy',date('$reportedByDate') ,'$functionalArea','$assignedTo','$comments', '$status', '$priority', '$resolution', '$resolutionVersion',
        '$resolvedBy',".($resolvedByDate==NULL ? "NULL": "date('$resolvedByDate')").",'$testedBy',".($testedByDate ==NULL ? "NULL": "date('$testedByDate')").",'$deferred','$reportedBy',$prog_id )";
        
        $statement = $connection->prepare($query);
        if($statement == false){

           echo "statement is false";
        }
        $success = $statement->execute();

            if($success){
                $bug_id = $connection->insert_id;
                echo "<span style='color:green'>A new bug was added.</span>";
                $statement->close();
                
                return $bug_id;
                
            }else{
                $message="<span style='color:red'>A new bug failed to be added.</span>";
                
                echo $connection->error;
            }
            echo $message;
         
   }

   /* list all bugs */
    function getBugs(){
        global $connection; 
        $query = 'SELECT bugs.*, programs.program, programs.program_release, programs.program_version, report.name as reportName FROM bugs'. 
					' LEFT JOIN programs ON bugs.prog_id = programs.prog_id'.
					' LEFT JOIN employees report ON bugs.reportedBy = report.emp_id ORDER BY bug_id';
        $result = $connection->query($query); 
        if($result == false){
            display_db_error($connection->error);
        }
        $bugs = array(); 
        for($i=0; $i <$result->num_rows; $i++){
            $bug = $result->fetch_assoc();
            $bugs[$i] = $bug; 
        }
        $result->free();
        return $bugs;
    }

    function getBug($bug_id){
        global $connection; 
        $query = "SELECT bugs.*, programs.program, programs.program_release, programs.program_version, report.name as reportName, assign.name as assignName, resolve.name as resolveName, test.Name as testName, areas.area FROM bugs". 
					" LEFT JOIN programs ON bugs.prog_id = programs.prog_id".
					" LEFT JOIN employees report ON bugs.reportedBy = report.emp_id".
					" LEFT JOIN employees assign ON bugs.assignedTo = assign.emp_id".
					" LEFT JOIN employees resolve ON bugs.resolvedBy = resolve.emp_id".
					" LEFT JOIN employees test ON bugs.testedBy = test.emp_id".
					" LEFT JOIN areas ON bugs.functionalArea = areas.area_id WHERE bug_id ='$bug_id'";
        $result = $connection->query($query); 
        if($result == false){
            display_db_error($connection->error);
        }
        $bug =$result->fetch_assoc(); 
    
        $result ->free();
        return $bug ;
    }


    function updateBug($bug_id,$reportType ,$severity, $problem_summary,$reproducible,$problem, $suggestedFix,$reportedBy,
        $reportedByDate, $functionalArea, $assignedTo, $comments, $status, $priority, $resolution, $resolutionVersion,
        $resolvedBy, $resolvedByDate, $testedBy, $testedByDate, $deferred,$prog_id){            
            
        global $connection;
        
        $query = "UPDATE bugs 
                    SET reportType = '$reportType' ,
                        severity = '$severity' ,
                        problemSummary = '$problem_summary' ,
                        reproducible = '$reproducible' ,
                        problem = '$problem' ,
                        suggestedFix = '$suggestedFix' ,
                        reportedBy = '$reportedBy' ,
                        reportedByDate = date('$reportedByDate'),
                        functionalArea = '$functionalArea' ,
                        assignedTo = '$assignedTo' ,
                        comments = '$comments' ,
                        bugStatus = '$status' ,
                        priority = '$priority' ,
                        resolution = '$resolution' ,
                        resolutionVersion = '$resolutionVersion' ,
                        resolvedBy = '$resolvedBy' ,";		
        if ($resolvedByDate!=null) $query = $query . "resolvedByDate = '$resolvedByDate' ,";
		$query = $query . "testedBy = '$testedBy' ,";
        if ($testedByDate!=null) $query = $query . "testedByDate = '$testedByDate' ,";
        $query = $query . "treatAsDeferred = '$deferred' ,
                        prog_id = '$prog_id' 
                    WHERE bug_id = '$bug_id'";
		
        $Statement = $connection->prepare($query);
        
        if($Statement == false){
            display_db_error($connection->error);
        }
		
        $success = $Statement->execute();
        
        return $success;
        
    }


	// Search bugs
	function getSearchResult($SQL) {
		global $connection;
		$result = $connection->query($SQL);
		if($result == false){
            display_db_error($connection->error);
        }
		$bugs = array(); 
        for($i=0; $i <$result->num_rows; $i++){
            $bugs[$i] = $result->fetch_assoc();
        }
        $result->free();
        return $bugs;
	}
?>
