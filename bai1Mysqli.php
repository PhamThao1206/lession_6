
<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "buoi5_php";

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
  die("Kết nối thất bại: " . mysqli_connect_error());
}
echo "Kết nối thành công";

// Tạo bảng danh sách sinh viên
$sql = "CREATE TABLE sinhvien_li (
    MaSV VARCHAR(11) NOT NULL PRIMARY KEY,
    HoTen VARCHAR NOT NULL(50),
    NgaySinh DATE,
    Lop VARCHAR(20),
    ĐTB FLOAT
);";

if (mysqli_query($conn, $sql)) {
  echo "Tạo bảng thành công";
} else {
  echo "Tạo bảng thất bại: " . mysqli_error($conn);
}

// Thêm 5 sinh viên mới vào bảng danh sách
$sql = "INSERT INTO sinhien_li (MaSV, HoTen, NgaySinh, Lop, ĐTB )
VALUES
(SV001, 'Nguyen Van Anh', '2002-01-01', 'K56', 5.5),
(SV002, 'Pham Thi Binh', '2004-12-02', 'K58', 7.5),
(SV003, 'Le Van Cuong', '2003-10-03', 'K57', 9.0),
(SV004, 'Pham Van Son', '2002-04-04', 'K56', 6.5),
(SV005, 'Hoang Thi Huong', '2002-06-05', 'K56', 8.0)";

if (mysqli_query($conn, $sql)) {
  echo "Thêm sinh viên thành công";
} else {
  echo "Thêm sinh viên thất bại: " . mysqli_error($conn);
}

// Cập nhật điểm trung bình của sinh viên có mã "SV001" thành 8.5
$sql = "UPDATE sinhvien_li
SET ĐTB = 8.5
WHERE MaSV = SV001";

if (mysqli_query($conn, $sql)) {
  echo "Cập nhật điểm trung bình thành công";
} else {
  echo "Cập nhật điểm trung bình thất bại: " . mysqli_error($conn);
}

// Xoá thông tin của sinh viên có mã "SV003" khỏi bảng danh sách
$sql = "DELETE FROM sinhvien_li
WHERE MaSV = SV003";

if (mysqli_query($conn, $sql)) {
  echo "Xoá sinh viên thành công";
} else {
  echo "Xoá sinh viên thất bại: " . mysqli_error($conn);
}

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>