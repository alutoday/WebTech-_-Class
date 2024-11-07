<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm Kiếm Thông Tin Nhân Viên</title>
</head>
<body>
<form action="timkiemnv.php" method="GET">
<h2>Tìm Kiếm Thông Tin Nhân Viên</h2>
    <label><input type="radio" name="searchType" value="IDNV" checked> IDNV</label>
    <label><input type="radio" name="searchType" value="Hoten"> Họ tên</label>
    <label><input type="radio" name="searchType" value="Diachi"> Địa chỉ</label>
    <br><br>
    <label>Nhập vào thông tin:</label>
    <input type="text" name="searchQuery" required>
    <br><br>
    <button type="submit">OK</button>
    <button type="reset">Reset</button>
</form>

<?php
if (isset($_GET['searchType']) && isset($_GET['searchQuery'])) {
    $connection = mysqli_connect("localhost", "root", "", "DULIEU") 
    or die("Kết nối thất bại: " . mysqli_connect_error());

    $searchType = mysqli_real_escape_string($connection, $_GET['searchType']);
    $searchQuery = mysqli_real_escape_string($connection, $_GET['searchQuery']);

    $sql = "SELECT * FROM nhanvien WHERE $searchType LIKE '%$searchQuery%'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table border="1" width="100%">';
        echo '<tr><th>IDNV</th><th>Họ tên</th><th>IDPB</th><th>Địa chỉ</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr><td>' . $row['IDNV'] .
                '</td><td>' . $row['Hoten'] .
                '</td><td>' . $row['IDPB'] .
                '</td><td>' . $row['Diachi'] . '</td></tr>';
        }
        
        echo '</table>';
    } else {
        echo "Không tìm thấy kết quả nào.";
    }

    mysqli_free_result($result);
    mysqli_close($connection);
}
?>

</body>
</html>
