<?php

    include("./php_modules/post_display_logic.php");

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
        <style>.box-shadow{
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.05);
          }</style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

          
            
            
            <div class="container">
                  <div class="row">
                    <?php $len = 0;  while($results = mysqli_fetch_array($posts_to_be_seen)){ ?>
                    <div class="col-sm-4 py-3">
                      <div class="card box-shadow">
                        <img src="<?php $len +=1; echo $results['image_path'] ?>" class="card-img-top" height="50%" width="50%">
                        <div class="card-body">
                          <h5 class="card-title"><?php $x = $results['following_ID']; 
                                                        $q = "select * from app_user where id= '$x'"; 
                                                        $y = mysqli_fetch_array(mysqli_query($conn, $q));
                                                        echo $y['username']?></h5>
                          <p class="card-text"><?php echo ($results['description']);?></p>
                        </div>
                      </div>
                    </div>
                    <?php }?>
                  </div>
            </div>
            <?php if(!$len) {?>
              <p class="fs-3 text-center" style="padding-top:100px">There were no posts in your feed. <br> Connect with other users to see what they are posting.</p>
            <?php }?>
        
    </body>
</html>