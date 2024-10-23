<?php
// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    // สร้างชื่อไฟล์
    $filename = 'myfile.txt';

    // เขียนข้อมูลลงในไฟล์
    $content = "ชื่อ: $name\nนามสกุล: $surname\n";

    // เขียนลงในไฟล์
    if (file_put_contents($filename, $content, FILE_APPEND | LOCK_EX) !== false) {
        echo "บันทึกข้อมูลเรียบร้อยแล้วในไฟล์ $filename";
    } else {
        echo "ไม่สามารถเขียนข้อมูลลงในไฟล์ได้";
    }
} else {
    echo "ไม่พบข้อมูลที่ส่งมา";
}
?>
