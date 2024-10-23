<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Write File</title>
</head>
<body>
    <h2>กรอกข้อมูล</h2>
    <form action="writefile.php" method="post">
        <label for="name">ชื่อ:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="surname">นามสกุล:</label>
        <input type="text" id="surname" name="surname" required><br><br>
        <input type="submit" value="บันทึก">
    </form>
</body>
</html>
