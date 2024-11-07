<?php
$connection = mysqli_connect("localhost", "root", "", "DULIEU") 
or die("Kết nối thất bại: " . mysqli_connect_error());

$idpb = $_GET['IDPB'];

$sql = "SELECT * FROM phongban WHERE IDPB='$idpb'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Không tìm thấy phòng ban.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenpb = mysqli_real_escape_string($connection, $_POST['tenpb']);
    $mota = mysqli_real_escape_string($connection, $_POST['mota']);

    $update_sql = "UPDATE phongban SET Tenpb='$tenpb', Mota='$mota' WHERE IDPB='$idpb'";
    if (mysqli_query($connection, $update_sql)) {
        header("Location: capnhatpb.php");
        exit();
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập Nhật Phòng Ban</title>
</head>
<body>
    <h1>Cập Nhật Thông Tin Phòng Ban</h1>
    <form method="POST" action="">
        <label for="idpb">Mã Phòng Ban:</label>
        <input type="text" id="idpb" name="idpb" value="<?php echo $row['IDPB']; ?>" readonly><br><br>
        
        <label for="tenpb">Tên Phòng Ban:</label>
        <input type="text" id="tenpb" name="tenpb" value="<?php echo $row['Tenpb']; ?>" ><br><br>

        <label for="mota">Mô Tả:</label>
        <input type="text" id="mota" name="mota" value="<?php echo $row['Mota']; ?>" ><br><br>
        
        <button type="submit">Cập Nhật</button>
    </form>

</body>
</html>

<?php
mysqli_free_result($result);
mysqli_close($connection);
?>
