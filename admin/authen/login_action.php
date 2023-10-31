<?php 
session_start();
require_once("../../config/config.php");
if(!empty($_POST['UserName']) && !empty($_POST['UserPassword'])) {
    $UserName = $_POST['UserName'];
    $password = $_POST['UserPassword'];
    $sql = "SELECT * FROM user where UserName = '$UserName' and UserPassword = '$password'";
    $user = mysqli_query($connection,$sql) or die ($connection->error);
    if($user && mysqli_num_rows($user) == 1) {
        $userData = mysqli_fetch_assoc($user);
        $account_name_user = $userData['UserName'];
        $id_user = $userData['UserId'];
        $_SESSION['UserName'] = $account_name_user;
        echo $_SESSION['UserName'];
        $_SESSION['loggedin'] = true;//đăng nhập thành công
        $_SESSION['UserId'] = $id_user;
        $_SESSION["current_user"] = $userData;
        header('Location: ../home/index.php');
        exit();
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không chính xác";
    } 
} else { 
    echo "Vui lòng nhập tên người dùng và mật khẩu";
}
?>