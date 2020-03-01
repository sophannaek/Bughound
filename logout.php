<?php 
 include './homepage.php';
  require_once './db/dbConnection.php';

  if (isset($_SESSION['username']))
  {
    destroySession();
    header("location: ./index.php");
  }
  else echo "<div class='main'><br>" .
            "You cannot log out because you are not logged in";
?>

<br><br></div>

    
  </body>
</html>