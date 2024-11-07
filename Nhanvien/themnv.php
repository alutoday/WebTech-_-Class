<?php
$connection = mysqli_connect("localhost", "root", "", "DULIEU") 
or die("Kết nối thất bại: " . mysqli_connect_error());

$phongban_sql = "SELECT IDPB, Tenpb FROM phongban";
$phongban_result = mysqli_query($connection, $phongban_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manv = mysqli_real_escape_string($connection, $_POST['manv']);
    $tennv = mysqli_real_escape_string($connection, $_POST['tennv']);
    $phongban = mysqli_real_escape_string($connection, $_POST['phongban']);
    $diachi = mysqli_real_escape_string($connection, $_POST['diachi']);
    
    $insert_sql = "INSERT INTO nhanvien (IDNV, Hoten, IDPB, Diachi) VALUES ('$manv', '$tennv', '$phongban', '$diachi')";
    if (mysqli_query($connection, $insert_sql)) {
        header("Location: xemthongtinnv.php"); 
        exit();
    } else {
        echo "Lỗi thêm nhân viên: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chèn nhân viên</title>
</head>
<body>
    <h1>Chèn thông tin nhân viên</h1>
    <form method="POST" action="">
        <label for="manv">Mã Nhân Viên:</label>
        <input type="text" id="manv" name="manv" required><br><br>
        
        <label for="tennv">Tên Nhân Viên:</label>
        <input type="text" id="tennv" name="tennv" required><br><br>

        <label for="phongban">Phòng Ban:</label>
        <select id="phongban" name="phongban" required>
            <option value="">-- Chọn Phòng Ban --</option>
            <?php
            while ($row = mysqli_fetch_assoc($phongban_result)) {
                echo '<option value="' . $row['IDPB'] . '">' . $row['Tenpb'] . '</option>';
            }
            ?>
        </select><br><br>

        <label for="diachi">Địa chỉ:</label>
        <input type="text" id="diachi" name="diachi" required><br><br>

        <div class="button-container">
                <input type="submit" name="OK" value="OK" /> 
                <input type="reset" name="reset" value="Reset" />
            </div>
    </form>

</body>
</html>

<?php
mysqli_free_result($phongban_result);
mysqli_close($connection);
?>