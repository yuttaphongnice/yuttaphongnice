<?php
session_start();

if (isset($_POST['username'], $_POST['password'])) {
    // สมมติว่าคุณทำการตรวจสอบข้อมูลล็อกอินแล้ว
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ดึงข้อมูลลูกค้าจากฐานข้อมูล
    $con = mysqli_connect("localhost", "root", "1234", "mystore");

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $sql = "SELECT Customer_Name, Customer_Lastname FROM costomer WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // ตั้งค่าเซสชัน
        $_SESSION['username'] = $username;
        $_SESSION['Customer_Name'] = $row['Customer_Name'];
        $_SESSION['Customer_Lastname'] = $row['Customer_Lastname'];

        // เปลี่ยนเส้นทางไปที่หน้า show_customer.php
        header("Location: show_customer.php");
        exit();
    } else {
        echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 93%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container input[type="submit"],
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .login-container button {
            background-color: #f44336;
        }

        .login-container input[type="submit"]:hover,
        .login-container button:hover {
            background-color: #45a049;
        }

        .login-container button:hover {
            background-color: #e60000;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>เข้าสู่ระบบ</h2>
        <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

        <form action="login.php" method="post">
            <input type="text" id="username" name="username" placeholder="ชื่อผู้ใช้" required><br>

            <input type="password" id="password" name="password" placeholder="รหัสผ่าน" required><br>

            <input type="submit" name="login" value="เข้าสู่ระบบ">
            <!-- ปุ่ม Cancel -->
            <button type="button" onclick="window.location.href='logout.php'">ยกเลิก</button>
        </form>
    </div>
</body>
</html>
