
<?php
// Kết nối đến cơ sở dữ liệu MySQL
$db_servername = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'buoi5_php';

// Tạo kết nối
$connection = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

// Kiểm tra kết nối
if (!$connection) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
echo "Kết nối thành công";
?>

<?php
// Tạo bảng lịch sử giao dịch
$sql = "CREATE TABLE lichsu_gd(
    id INT(11) PRIMARY KEY,
    ngay_gd DATETIME,
    loai_gd VARCHAR (50),
    so_tien FLOAT,
    mo_ta VARCHAR (50)
)";

if (mysqli_query($conn, $sql)) {
  echo "Tạo bảng thành công";
} else {
  echo "Tạo bảng thất bại: " . mysqli_error($conn);
}

// Thêm giao dịch vào bảng
$sql = "INSERT INTO lichsu_gd (id, ngay_gd, loai_gd, so_tien, mo_ta)
VALUES
(1, '07/05/2023', 'rút tiền', '500', 'rút tiền ATM'),
(2, '10/05/2023', 'chuyển tiền', '800', 'chuyển tiền ATM'),
(3, '11/05/2023', 'rút tiền', '1500', 'rút tiền ATM'),
(4, '14/05/2023', 'rút tiền', '600', 'rút tiền ATM'),
(5, '15/05/2023', 'chuyển tiền', '2000', 'chuyển tiền ATM')";

if (mysqli_query($conn, $sql)) {
  echo "Thêm thành công";
} else {
  echo "Thêm thất bại: " . mysqli_error($conn);
}

// Cập nhật số tiền của giao dịch có số thứ tự 3 trong bảng lịch sử thành 1000.
$sql = "UPDATE lichsu_gd
SET so_tien = 1000;
WHERE id = 3";

if (mysqli_query($conn, $sql)) {
  echo "Cập nhật thành công";
} else {
  echo "Cập nhật thất bại: " . mysqli_error($conn);
}

// Xoá thông tin của giao dịch có số thứ tự 5 khỏi bảng lịch sử.
$sql = "DELETE FROM lichsu_gd
WHERE id = 5";

if (mysqli_query($conn, $sql)) {
  echo "Xoá thành công";
} else {
  echo "Xoá thất bại: " . mysqli_error($conn);
}

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);