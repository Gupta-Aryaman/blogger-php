<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    $d = "select id from app_user where username='$user'";
    $id = mysqli_query($conn, $d);
    $id = mysqli_fetch_array($id)[0];
    $files = $_FILES['file'];
    
    $descr = $_POST['desc'];

    $filename = $files['name'];
    $fileerror = $files['error'];
    $filetmp = $files['tmp_name'];

    $fileext = explode('.', $filename);
    $filecheck = strtolower(end($fileext));

    $fileextstored = array('png', 'jpg', 'jpeg');

    if(in_array($filecheck, $fileextstored)){
        $destinationfile = "uploaded_pics/".$filename;
        move_uploaded_file($filetmp, $destinationfile);
    }



    $query = "insert into post (ID, image_path, description) values ('$id', '$destinationfile', '$descr')";
    mysqli_query($conn, $query);
    header("Location: profile.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        #heading{
            padding-bottom: 5%;
        }
        #btn-primary{
            display: flex;
        }
        body {
        align-items: center;
        background-color: #f5f5f5;
      }
    </style>
    </head>
    <body>
    <div class="col-lg-8 m-auto d-block">
    <form name="post_add" action=" " method="POST" enctype="multipart/form-data">
        <h1 align=center id="heading">New Post</h1>
          <div class="form-group">
            <label for="formFile" class="form-label">Choose picture</label>
            <input class="form-control" type="file" id="formFile" name="file">
          </div> <br>
          <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
          </div>
        
        <br>
        <button class="btn btn-primary" type="submit">Submit form</button>
      </form>
    </div>
      
    </body>
</html>