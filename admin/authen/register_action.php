<?php 
    session_start();
    include ('../../config/config.php');
        $name =  $_POST['UserName'];
        $email =  $_POST['UserEmail'];
        $password =  $_POST['password'];
        $confirm_password =  $_POST['cpassword'];
        if ($password == $confirm_password){
            $sql = "SELECT UserName from user where UserName ='$name'";
            $result = mysqli_query($connection,$sql) or die ($connection->error);
            if (mysqli_num_rows($result) > 0){
                $_SESSION['message'] = "Tên hoặc Email đã tồn tại";
                header("Location: register.php");
            } else {
                $user_query = "INSERT INTO user (UserName, UserEmail, UserPassword) values('$name', '$email', '$password')";
                $user_query_run = mysqli_query($connection,$user_query);
                if ($user_query_run)
                {
                    $_SESSION['message'] = "Đăng ký thành công";
                    header("Location: login.php");
                } else {
                    $_SESSION['message'] = "Đã xảy ra sự cố";
                    header("Location: register.php");
                }
            }
        } else {
            header("Location: register.php");
        }
        $connection->close();
?>

