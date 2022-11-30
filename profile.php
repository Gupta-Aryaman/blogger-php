<?php

    include("./php_modules/post_display_logic.php");
    include("./php_modules/profile_logic.php");

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "blogger_db";

    $conn = mysqli_connect($servername, $username, $password, $db_name);

    if(!$conn){
        echo "connection failed";
    }

    $user = $_SESSION['uname'];
    $query = "select * from app_user where username!='$user'";

    if(isset($_REQUEST["deleted"])){
      $p_id = $_GET['deleted'];
      echo $p_id;
      $q = "DELETE FROM `post` WHERE post_id='$p_id'";
      mysqli_query($conn, $q);
      header("location: profile.php");
  }

    $x = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <Title>
            Posts
        </Title>
        <style>
          .box-shadow{
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
          }
          
            .image-cropper {
                width: 100px;
                height: 100px;
                position: relative;
                border: 2px solid white;
                -webkit-border-radius: 50px;
                -moz-border-radius: 50px;
                border-radius: 50px;
                overflow:hidden;
            }
            .my-picture {
                display: block;
                margin: 0 auto;
                height: auto;
                width: 100%;
            }
            .maintain-padding{
                /* padding-top: 30px; */
            }
            .myimg{
                width:250px;
                height:250px;
                object-fit:cover;
                border-radius:50%;
                }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
      </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
              <!-- <a class="navbar-brand" href="#"> -->
                <!-- <p style="">Welcome 
                
                </p> -->
              <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> -->
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" style='font-size:25px;'><i>Welcome, 
                    <?php echo $_SESSION['uname']; ?></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" style='font-size:25px;'></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" style='font-size:25px;'></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./post_display.php" style='font-size:25px;'>Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./profile.php" style='font-size:25px;'>Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./login.php" style='color:red; font-size:25px;'>Logout</a>
                  </li>
                </ul>
                <form class="d-flex" role="search" action="others_profile.php" method="post" name="profile_request">
                  <!-- <input class="form-control me-2" list="datalistOptions" id="exampleDataList" placeholder="search an user" name="profile_uname"> -->
                  
                  <select class="form-select me-2" aria-label="Default select example" name="uname_req">
                    <option selected>Search</option>
                    <?php while($results = mysqli_fetch_array($x)){?>
                    <option value="<?php echo $results['username']?>"> <?php echo $results['username']?> </option> <?php }?>
                  </select>
                  <button class="btn btn-outline-success" type="submit">Search</button>
                      
                </form>
              </div>
            </div>
        </nav>  

          

              <div style="padding: 10px; display: flex; align-items: center;">
                <div style="padding-left:400px;">
                <img  class="myimg" src=".\images\meerkat-suricata-suricatta-suricate-is-small-mongoose-found-southern-africa_208861-941.webp" />
                </div>
                <div style="padding-left: 100px;">
                <div style="display: flex; align-items: center;">
                  <p style="padding-right:30px" class="fs-1" ><?php echo "<i>@".$_SESSION['uname']."</i>"; ?></p> <p><form action="add_post.php" method="get"> <button class="btn btn-primary" type="submit">Add Post</button></p></div>
                  <p class="fs-3 text-center" ><?php echo "<b>".mysqli_num_rows($_SESSION['followers'])."</b>"; ?> followers &nbsp;&nbsp;&nbsp; <?php echo "<b>".mysqli_num_rows($_SESSION['following'])."</b>"; ?> following</p>
                  <p class="fs-3 text-center" ></p>
                </div>
              </div>
                
            
                <hr style="width: 99%; margin-right: auto; margin-left: auto; ">


                <div class="container">
                  <div class="row">
                  <?php while($results = mysqli_fetch_array($myposts)){ ?>
                  <div class="col-sm-4 py-3">
                    <div class="card box-shadow">
                      <img src="<?php echo $results['image_path'] ?>" class="card-img-top" height="50%" width="50%">
                      <div class="card-body">
                        <!-- <h5 class="card-title">Card title</h5> -->
                        <p class="card-text"><?php echo ($results['description']);?></p>
                        <a href="profile.php?deleted=<?php echo $results['post_id'] ?>" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                  </div>
                  <?php }?>
                  </div>
                </div>
                
            
        
    </body>
</html>