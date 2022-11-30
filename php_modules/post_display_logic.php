<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = "blogger_db";

  $conn = mysqli_connect($servername, $username, $password, $db_name);

  if(!$conn){
      echo "connection failed";
  }
  session_start();
  $user = $_SESSION['uname'];
  $sql = "select f.following_ID, p.post_id, p.image_path, p.description from post p, app_user a, follower f where p.ID = f.following_ID and a.username = '$user' and a.ID = f.ID";
  $posts_to_be_seen = mysqli_query($conn, $sql);
  //$_SESSION['posts'] = $query;

  ?>