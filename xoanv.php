<?php
$connection = mysqli_connect("localhost", "root", "", "DULIEU") or die("Kết nối thất bại: " . mysqli_connect_error());

if (isset($_GET['delete_id'])) {
    $idnv = mysqli_real_escape_string($connection, $_GET['delete_id']);
    $sql_delete = "DELETE FROM nhanvien WHERE IDNV='$idnv'";
    mysqli_query($connection, $sql_delete);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$sql = "SELECT * FROM nhanvien";
$result = mysqli_query($connection, $sql);

echo '<table border="1" width="100%">';
echo '<caption>Dữ liệu bảng Nhân viên</caption>';
echo '<tr><th>IDNV</th><th>Họ tên</th><th>IDPB</th><th>Địa chỉ</th><th>Xóa</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr><td>' . $row['IDNV'] .
        '</td><td>' . $row['Hoten'] .
        '</td><td>' . $row['IDPB'] .
        '</td><td>' . $row['Diachi'] .
        '</td><td><a href="?delete_id=' . $row['IDNV'] . '">Xóa</a></td></tr>';
}
echo '</table>';

mysqli_free_result($result);
mysqli_close($connection);
?>
