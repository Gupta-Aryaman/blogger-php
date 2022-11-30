<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "blogger_db";

    $conn = mysqli_connect($servername, $username, $password, $db_name);

    if(!$conn){
        echo "connection failed";
    }
    $query1 = "use blogger_db";
    mysqli_query($conn, $query1);
    
    $arr = $_POST;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $un = $_POST['user_name'];
    $pws = $_POST['pwd']; 
    

    if(isset($_POST)){
        $query = "insert into app_user (first_name, last_name, password, username) values ('$fname', '$lname', '$pws', '$un')";
        // foreach ($arr as $key => $value) {
        //     print("key = ". $key . "value = ". $value);
        //     print("<br>");
        // }
    
        if(!mysqli_query($conn, $query)){
            die("error".mysqli_error($conn));
        }
        else{
            header("Location: http://localhost/bloggingWebsite/public/login.php?success");
            
        }
    }

    // $query = "insert into app_user values()";
    // print($_POST);


?>