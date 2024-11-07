<?php
$connection = mysqli_connect("localhost", "root", "", "DULIEU") 
or die("Kết nối thất bại: " . mysqli_connect_error());

$idpb = $_GET['IDPB'];
$sql = "SELECT * FROM nhanvien WHERE IDPB = '$idpb'";
$result = mysqli_query($connection, $sql);

echo '<table border="1" width="100%">';
echo '<caption>Dữ liệu phòng ban: ' . $idpb . '</caption>';
echo '<tr><th>IDNV</th><th>Tên nhân viên</th><th>IDPB</th><th>Địa chỉ</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr><td>' . $row['IDNV'] .
        '</td><td>' . $row['Hoten'] .
        '</td><td>' . $row['IDPB'] .
        '</td><td>' . $row['Diachi'] . '</td></tr>';
}

echo '</table>';
mysqli_free_result($result);
mysqli_close($connection);
?>
