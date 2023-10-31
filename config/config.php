<?php
// $host = "localhost"; // Tên máy chủ cơ sở dữ liệu
// $dbname = "shopdientu"; // Tên cơ sở dữ liệu
// $username = "root"; // Tên người dùng cơ sở dữ liệu
// $password = "MyNewPass"; // Mật khẩu cơ sở dữ liệu
// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Lỗi kết nối đến cơ sở dữ liệu: " . $e->getMessage());
// }
?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "MyNewPass";
    $dbname = "shopdientu";
    $connection =new mysqli($servername,$username,$password,$dbname);
    //hàm kiểm tra xem kết nối có đúng không:
    if ($connection->connect_error){
        die("Couldn't connect to the database".$connection->connect_error);
    } else {
        //echo "Kết nối thành công!";
    }
?>





