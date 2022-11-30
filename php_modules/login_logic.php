<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = "blogger_db";

  $conn = mysqli_connect($servername, $username, $password, $db_name);

  if(!$conn){
      echo "connection failed";
  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // ob_start();
   // username and password sent from form 
     $myusername=mysqli_real_escape_string($conn,$_POST['uname']); 
     $mypassword=mysqli_real_escape_string($conn,$_POST['pwd']); 
 
     $query="SELECT * FROM app_user WHERE username='$myusername' and password='$mypassword'";
     $result = mysqli_query($conn,$query);
    //  echo "$result";
     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
     //$active=$row['active'];
 
     $count=mysqli_num_rows($result);
 
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1)
    {
      session_start();
      $_SESSION['uname'] = $_POST['uname'];
      header("location: http://localhost/bloggingWebsite/public/post_display.php");
 
    //  header("location: welcome.php");
    }
    else 
    {
      header("location: http://localhost/bloggingWebsite/public/login.php?invalid");
    }
  }
?>