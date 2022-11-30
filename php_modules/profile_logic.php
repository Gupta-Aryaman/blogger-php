<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = "blogger_db";

  $conn = mysqli_connect($servername, $username, $password, $db_name);

  if(!$conn){
      echo "connection failed";
  }
  //session_start();
  $user = $_SESSION['uname'];
  // $p = "select * from app_user where username = '$user'";
  // $p = mysqli_query($conn, $p);
  // while($x = mysqli_fetch_array($p)){
  // //$p = $p[0];
  //   $_id = $x["id"];}

  $query1  = "select f.id, f.following_id from follower f, app_user a where a.username = '$user' and f.id = a.id";
  $query2 = "select f.id, f.following_id from follower f, app_user a where a.username = '$user' and f.following_id = a.id";

  $following = mysqli_query($conn, $query1);
  $followers = mysqli_query($conn, $query2);

  $_SESSION['following'] = $following;
  $_SESSION['followers'] = $followers;

  $sql = "select * from post p, app_user a where p.ID = a.ID and a.username = '$user'";
  $myposts = mysqli_query($conn, $sql);
?>