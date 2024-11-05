<?php
$connection = mysqli_connect("localhost", "root", "", "DULIEU") or die("Kết nối thất bại: " . mysqli_connect_error());

if (isset($_POST['delete_ids'])) {
    $idsToDelete = $_POST['delete_ids'];
    foreach ($idsToDelete as $idnv) {
        $idnv = mysqli_real_escape_string($connection, $idnv);
        $sql_delete = "DELETE FROM nhanvien WHERE IDNV='$idnv'";
        mysqli_query($connection, $sql_delete);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$sql = "SELECT * FROM nhanvien";
$result = mysqli_query($connection, $sql);

echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">';
echo '<table border="1" width="100%">';
echo '<caption>Dữ liệu bảng Nhân viên</caption>';
echo '<tr><th>IDNV</th><th>Họ tên</th><th>IDPB</th><th>Địa chỉ</th><th>Xóa</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr><td>' . $row['IDNV'] .
        '</td><td>' . $row['Hoten'] .
        '</td><td>' . $row['IDPB'] .
        '</td><td>' . $row['Diachi'] .
        '</td><td><input type="checkbox" name="delete_ids[]" value="' . $row['IDNV'] . '"></td></tr>';
}

echo '<tr><td colspan="4"></td><td><button type="submit">Xóa các nhân viên</button></td></tr>';
echo '</table>';
echo '</form>';

mysqli_free_result($result);
mysqli_close($connection);
?>
