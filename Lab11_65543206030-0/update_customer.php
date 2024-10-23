<?php 
session_start(); // เริ่มต้น session

// ตรวจสอบว่าผู้ใช้ได้ลงชื่อเข้าใช้หรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // ถ้ายังไม่ได้ลงชื่อเข้าใช้ ให้ redirect ไปที่ login.php
    exit();
}

// เชื่อมต่อฐานข้อมูล
ob_start(); // เริ่มการบัฟเฟอร์ข้อมูล
$con = mysqli_connect("localhost", "root", "1234", "mystore");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
    exit();
}

// รับค่า Customer_id จาก URL
if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    // ดึงข้อมูลลูกค้าจากฐานข้อมูล
    $sql = "SELECT * FROM costomer WHERE Customer_id = '$customer_id'";
    $result = mysqli_query($con, $sql);
    
    // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
    if ($row = mysqli_fetch_assoc($result)) {
        // แสดงข้อมูลลูกค้าในฟอร์มเพื่อแก้ไข
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>แก้ไขข้อมูลลูกค้า</title>
        </head>
        <body>
            <h2>แก้ไขข้อมูลลูกค้า</h2>
            <form method="post" action="">
                <label for="fname">ชื่อ:</label>
                <input type="text" id="fname" name="Fname" value="<?php echo $row['Customer_Name']; ?>" required><br><br>

                <label for="lname">นามสกุล:</label>
                <input type="text" id="lname" name="lname" value="<?php echo $row['Customer_Lastname']; ?>" required><br><br>

                <label for="gender">เพศ:</label>
                <input type="radio" id="male" name="gender" value="male" <?php if ($row['Gender'] == 'male') echo 'checked'; ?> required> ชาย
                <input type="radio" id="female" name="gender" value="female" <?php if ($row['Gender'] == 'female') echo 'checked'; ?> required> หญิง
                <br><br>

                <label for="birthdate">วันเกิด:</label>

                <label for="day">วัน:</label>
                <select id="day" name="day" required>
                    <?php
                    // สร้าง dropdown สำหรับวัน
                    for ($i = 1; $i <= 31; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
        ?>
                </select>
                <select id="month" name="month" required>
                    <?php
                    // สร้าง dropdown สำหรับเดือน
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
                <select id="year" name="year" required>
                    <?php
                    // สร้าง dropdown สำหรับปี
                    $currentYear = date("Y") + 543; // ปีปัจจุบันในระบบไทย
                    for ($i = $currentYear; $i >= $currentYear - 100; $i--) { // แสดงปีย้อนหลัง 100 ปี
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
            </select><br><br>

            <label for="Add">ที่อยู่:</label>
            <input type="text" id="add" name="add" value="<?php echo $row['Address']; ?>" required><br><br>

            <label for="province">จังหวัด:</label>
            <select id="province" name="province" required>
                <?php
                $provinces = ['เชียงใหม่', 'ลำปาง', 'แพร่', 'น่าน', 'พะเยา', 'เชียงราย', 'แม่ฮ่องสอน'];
                foreach ($provinces as $province) {
                    $selected = ($row['Province'] == $province) ? 'selected' : '';
                    echo "<option value='$province' $selected>$province</option>";
                }
                ?>
            </select><br><br>

            <label for="pnum">รหัสไปรษณีย์:</label>
            <input type="text" id="pnum" name="pnum" value="<?php echo $row['Zipcode']; ?>" required><br><br>

            <label for="phone">โทรศัพท์:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $row['Telephone']; ?>" required><br><br>

            <label for="info">รายละเอียดอื่นๆ:</label>
            <textarea id="info" name="info" rows="5" cols="50" required><?php echo $row['Customer_Description']; ?></textarea><br><br>


                <!-- เพิ่ม input fields อื่นๆ สำหรับข้อมูลลูกค้าที่เหลือ -->
                
                <input type="submit" name="update" value="บันทึกการแก้ไข">
                <button type="button" onclick="cancel()"><a href='show_customer.php'>ยกเลิก</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "ไม่พบข้อมูลลูกค้าที่ต้องการแก้ไข";
    }
}

// เมื่อผู้ใช้กดบันทึกการแก้ไข
// เมื่อผู้ใช้กดบันทึกการแก้ไข



if (isset($_POST['update'])) {
    // รับค่าที่ถูกแก้ไขจากฟอร์ม
    $fname = mysqli_real_escape_string($con, $_POST['Fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $day = mysqli_real_escape_string($con, $_POST['day']);
    $month = mysqli_real_escape_string($con, $_POST['month']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $now = getdate();
    $Age = ($now['year'] + 543) - $year;
    $birthdate = "$day-$month-$year"; // จัดรูปแบบวันเกิด
    $address = mysqli_real_escape_string($con, $_POST['add']);
    $province = mysqli_real_escape_string($con, $_POST['province']);
    $pnum = mysqli_real_escape_string($con, $_POST['pnum']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $info = mysqli_real_escape_string($con, $_POST['info']);

    // อัปเดตข้อมูลในฐานข้อมูล
    $sql_update = "UPDATE costomer SET 
                    Customer_Name = '$fname', 
                    Customer_Lastname = '$lname', 
                    Gender = '$gender',
                    Age = '$Age',
                    Birthdate = '$birthdate',
                    Address = '$address',
                    Province = '$province',
                    Zipcode = '$pnum',
                    Telephone = '$phone',
                    Customer_Description = '$info'
                    WHERE Customer_id = '$customer_id'";

    if (mysqli_query($con, $sql_update)) {
        echo "อัปเดตข้อมูลลูกค้าสำเร็จ!";
        header("Location: show_customer.php"); // การเปลี่ยนเส้นทางไปที่ show_customer.php
        exit(); // หยุดการทำงานหลังจาก redirect
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($con);
    }

    mysqli_close($con);
    exit();
}

mysqli_close($con);

ob_end_flush(); // ปิดการบัฟเฟอร์ข้อมูล
?>
