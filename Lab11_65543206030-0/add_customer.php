<?php 
$con = mysqli_connect("localhost", "root", "1234", "mystore");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
    exit();
}

if (isset($_POST["SM"])) {
    // รับค่าจากฟอร์ม
    $now = getdate();
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"]; 
    $Age = ($now['year'] + 543) - $year;
    // สร้างอาร์เรย์ของชื่อเดือนภาษาไทย
    $months = [
        1 => 'มกราคม',
        2 => 'กุมภาพันธ์',
        3 => 'มีนาคม',
        4 => 'เมษายน',
        5 => 'พฤษภาคม',
        6 => 'มิถุนายน',
        7 => 'กรกฎาคม',
        8 => 'สิงหาคม',
        9 => 'กันยายน',
        10 => 'ตุลาคม',
        11 => 'พฤศจิกายน',
        12 => 'ธันวาคม'
    ];

    // ตรวจสอบว่าเดือนที่กรอกถูกต้อง
    $monthName = isset($months[$month]) ? $months[$month] : "Unknown month";
    $birthdate = sprintf("%d-%d-%d", $day, $month, $year);
    $info = mysqli_real_escape_string($con, $_POST["info"]);

    // ตรวจสอบวันเกิดและจัดรูปแบบ
    $birthdate = sprintf("%d-%d-%d", $day, $month, $year);
    $info = mysqli_real_escape_string($con, $_POST["info"]);

    // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
    $sqladd = "INSERT INTO costomer (Customer_Name, Customer_Lastname, Gender, Age, Birthdate, Address, Province, Zipcode, Telephone, Customer_Description, username, password) 
    VALUES (
        '".$_POST["Fname"]."',
        '".$_POST["lname"]."',
        '".$_POST["gender"]."',
        '$Age',
        '$birthdate',
        '".$_POST["add"]."',
        '".$_POST["province"]."',
        '".$_POST["pnum"]."',
        '".$_POST["phone"]."',
        '$info',
        '".$_POST["username"]."',
        '".$_POST["pwd"]."'
    )";

    // ทำการเพิ่มข้อมูลลงในฐานข้อมูล
    if (mysqli_query($con, $sqladd)) {
        echo "<script>alert('เพิ่มข้อมูลลูกค้าสำเร็จ!'); window.location.href='show_customer.php';</script>";
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลลูกค้า</title>
    <script>
        function validatePassword() {
            var password = document.getElementById("pwd").value;
            var confirmPassword = document.getElementById("Cpwd").value;
            
            if (password != confirmPassword) {
                alert("รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน");
                return false; // ป้องกันการส่งฟอร์ม
            }
            return true; // อนุญาตให้ส่งฟอร์ม
        }

        function validateForm() {
            var fields = ["fname", "lname", "day", "month", "year", "username", "pwd", "Cpwd"];
            var isComplete = true;

            for (var i = 0; i < fields.length; i++) {
                var field = document.getElementById(fields[i]);
                if (!field.value) {
                    isComplete = false;
                    break;
                }
            }

            if (!isComplete) {
                // Displaying the alert like in the image
                alert("กรุณากรอกข้อมูลให้ครบ!!");
                return false; // Prevent form submission
            }

            return validatePassword(); // Proceed with password validation
        }
    </script>
</head>
<body>
    <form method="post" action="" onsubmit="return validateForm()">
    <fieldset>
    <legend>ข้อมูลลูกค้า</legend>
        <label for="fname">ชื่อ:</label>
            <input type="text" id="fname" name="Fname" placeholder="ใส่ชื่อจริง"><br><br>

        <label for="lname">นามสกุล:</label>
            <input type="text" id="lname" name="lname" placeholder="ใส่นามสกุล"><br><br>

        <label for="gn">เพศ:</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">ชาย</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">หญิง</label><br><br>

        <label for="birthdate">วันเกิด:</label>

        <label for="day">วัน:</label>
        <select id="day" name="day">
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        <select id="month" name="month">
            <?php
            $months = [
                1 => 'มกราคม',
                2 => 'กุมภาพันธ์',
                3 => 'มีนาคม',
                4 => 'เมษายน',
                5 => 'พฤษภาคม',
                6 => 'มิถุนายน',
                7 => 'กรกฎาคม',
                8 => 'สิงหาคม',
                9 => 'กันยายน',
                10 => 'ตุลาคม',
                11 => 'พฤศจิกายน',
                12 => 'ธันวาคม'
            ];

            foreach ($months as $key => $month) {
                echo "<option value='$key'>$month</option>";
            }
            ?>
        </select>

        <label for="year">ปี:</label>
        <select id="year" name="year">
            <?php
            $currentYear = date("Y") + 543;
            for ($i = $currentYear; $i >= $currentYear - 100; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br><br>

        <label for="Add">ที่อยู่:</label>
        <input type="text" id="add" name="add" placeholder="ใส่ที่อยู่ปัจจุบัน"><br><br>

        <label for="province">จังหวัด:</label>
        <select id="province" name="province">
            <option value="" disabled selected>เลือกจังหวัด</option>
            <option value="เชียงใหม่">เชียงใหม่</option>
            <option value="ลำปาง">ลำปาง</option>
            <option value="แพร่">แพร่</option>
            <option value="น่าน">น่าน</option>
            <option value="พะเยา">พะเยา</option>
            <option value="เชียงราย">เชียงราย</option>
            <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
        </select><br><br>

        <label for="pnum">รหัสไปรษณีย์:</label>
        <input type="text" id="pnum" name="pnum" placeholder="53100"><br><br>

        <label for="phone">โทรศัพท์:</label>
        <input type="text" id="phone" name="phone" placeholder="ใส่เบอร์โทรศัพท์ของคุณ"><br><br>

        <label for="info">รายละเอียดอื่นๆ:</label>
        <textarea id="info" name="info" rows="5" cols="50" placeholder="โปรดใส่รายละเอียดเพิ่มเติมเกี่ยวกับตัวคุณ"></textarea><br><br>

        <fieldset>
            <legend>Account ของ ข้อมูลลูกค้า</legend>
            <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>

            <label for="pwd">Password:</label>
                <input type="password" id="pwd" name="pwd" required><br><br>     
                
            <label for="Cpwd">Confirm Password:</label>
                <input type="password" id="Cpwd" name="Cpwd" required><br><br>   
        </fieldset>
    </fieldset>      
    <input type="submit" name="SM" value="เพิ่มข้อมูลลูกค้า">
    <button type="button" onclick="cancel()"><a href='show_customer.php'>ยกเลิก</a></button>
    </form>
</body>
</html>

