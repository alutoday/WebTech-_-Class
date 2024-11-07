<?php
$connection = mysqli_connect("localhost", "root", "", "DULIEU")
 or  die("Kết nối thất bại: " . mysqli_connectionect_error());


$sql = "SELECT * FROM nhanvien";
$result = mysqli_query($connection, $sql);

echo '<table border="1" width="100%">';
echo '<caption>Dữ liệu bảng Nhân viên</caption>';
echo '<tr><th>IDNV</th><th>Hoten</th><th>IDPB</th><th>Diachi</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr><td>' . $row['IDNV']
         . '</td><td>' . $row['Hoten'] 
         . '</td><td>' . $row['IDPB'] 
         . '</td><td>' . $row['Diachi'] . '</td></tr>';
}
echo '</table>';

mysqli_free_result($result);
mysqli_close($connection);
?>
