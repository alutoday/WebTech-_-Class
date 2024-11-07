<?php
$connection=mysqli_connect("localhost","root","","DULIEU") 
or die("Ket noi that bai:".mysqli_connectionect_error());

$sql="SELECT * FROM phongban";
$result=mysqli_query($connection,$sql);

echo '<table border="1" width="100%">';
echo '<caption>Du lieu bang phong ban</caption>';
echo '<tr><th>Ma phong ban</th><th>Ten phong ban</th><th>Mo ta</th><th>Xem nhan vien</th></tr>';

while($row=mysqli_fetch_assoc($result)){
    echo'<tr><td>'.$row['IDPB'].
        '</td><td>'.$row['Tenpb'].
        '</td><td>'.$row['Mota'].
        '</td><td><a href="xemthongtinNVPB.php?IDPB='.$row['IDPB'].'">xxx</a></td></tr>';

}
echo '</table';
mysqli_free_result($result);
mysqli_close($connection);
?>