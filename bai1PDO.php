<?php
//kết nối csdl bằng PDO
$DB_TYPE = "mysql";
$DB_HOST = "localhost";
$DB_NAME = "buoi5_php";
$USER_NAME = "root";
$USER_PASSWORD = "";
//kết nối
$conn = new PDO("$DB_TYPE:host=$DB_HOST;dbname=$DB_NAME", $USER_NAME, $USER_PASSWORD);
if ($conn){
    echo "Kết nối thành công";
}
//tạo bảng
$state = "CREATE TABLE sinhvien_pdo(
    MaSV VARCHAR(11) NOT NULL PRIMARY KEY,
    HoTen VARCHAR NOT NULL(50),
    NgaySinh DATE,
    Lop VARCHAR(20),
    ĐTB FLOAT
)";
if(!$conn->exec($state)){
  die ("Thất bại" . mysqli_error());
else {
  echo "Tạo thành công";
}
}
//Thêm dữ liệu
$stmt = $conn->prepare("INSERT INTO sinhvien_pdo('MaSV', 'HoTen', NgaySinh', 'Lop', 'ĐTB') value (:MaSV, :HoTen, :NgaySinh, :Lop, :ĐTB)");
$data = [
    ['MaSV'=>'SV001', 'HoTen'=>'Pham Van Anh', 'NgaySinh'=>'2002-01-01', 'Lop'=>'K56', 'ĐTB'=>'5.5'],
    ['MaSV'=>'SV002', 'HoTen'=>'Pham Thi Binh', 'NgaySinh'=>'2004-12-02', 'Lop'=>'K58', 'ĐTB'=>'7.5' ],
    ['MaSV'=>'SV003', 'HoTen'=>'Le Van Cuong', 'NgaySinh'=>'2003-10-03', 'Lop'=>'K57', 'ĐTB'=>'9.0'],
    ['MaSV'=>'SV004', 'HoTen'=>'Pham Van Son', 'NgaySinh'=>'2002-04-04', 'Lop'=>'K56', 'ĐTB'=>'6.5'],
    ['MaSV'=>'SV005', 'HoTen'=>'Hoang Thi Huong', 'NgaySinh'=>'2002-06-05', 'Lop'=>'K56', 'ĐTB'=>'8.0'],
];
$stmt->execute($data);

//cập nhật dữ liệu
$stmt = $conn->prepare("UPDATE sinhvien_pdo SET ĐTB=:ĐTB  WHERE MaSV=:MaSV");
$data = [
         'MaSV' => 'SV001',
         'ĐTB' => '8.5'
];
$result = $stmt-> execute($data);
if (!$result) {
    die("Cập nhật thất bại: " . mysqli_error()); 
    // Thông báo lỗi nếu thực thi câu lệnh thất bại
} else {
    echo "Cập nhật thành công";
}

//xóa dữ liệu
$stmt = $conn->prepare("DELETE from sinhvien_pdo WHERE MaSV=:MaSV");
$data = [
         'MaSV' => 'SV003',
];
$result=$stmt-> execute($data);
    
if (!$result) {
    die("Xóa thất bại: " . mysqli_error()); 
    // Thông báo lỗi nếu thực thi câu lệnh thất bại
} else {
    echo "Xóa thành công";
}

?>
