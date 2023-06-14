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
$state_table = "CREATE TABLE lichsu_gd(
    id INT(11) NOT NULL PRIMARY KEY,
    ngay_gd DATETIME,
    loai_gd VARCHAR (50),
    so_tien FLOAT,
    mo_ta VARCHAR (50)
)";
if(!$conn->exec($state_table)){
die ("Thất bại" .mysqli_error($conn));
else {
echo "Tạo thành công";
}
}
//Thêm dữ liệu
$stmt = $conn->prepare("INSERT INTO lichsu_gd('id', 'ngay_gd', 'loai_gd', 'so_tien', 'mo_ta') value (:id, :ngay_gd, :loai_gd, :so_tien, :mo_ta)");
$data = [
    ['id'=>'1', 'ngay_gd'=>'07/05/2023', 'loai_gd'=>'rút tiền', 'so_tien'=>'500', 'mo_ta'=>'rút tiền ATM'],
    ['id'=>'2', 'ngay_gd'=>'10/05/2023', 'loai_gd'=>'chuyển tiền', 'so_tien'=>'800', 'mo_ta'=> 'chuyểntiền ATM' ],
    ['id'=>'3', 'ngay_gd'=>'11/05/2023', 'loai_gd'=>'rút tiền', 'so_tien'=>'1500', 'mo_ta'=>'rút tiền ATM'],
    ['id'=>'4', 'ngay_gd'=>'14/05/2023', 'loai_gd'=>'rút tiền', 'so_tien'=>'600', 'mo_ta'=>'rút tiền ATM'],
    ['id'=>'5', 'ngay_gd'=>'15/05/2023', 'loai_gd'=> 'chuyển tiền', 'so_tien'=>'2000', 'mo_ta'=>'chuyển tiền ATM'],
];
$stmt -> execute($data);

//cập nhật dữ liệu
$stmt = $conn->prepare("UPDATE lichsu_gd SET so_tien=:so_tien  WHERE id=:id");
$data = ['so_tien' => '1000', 'id' => '3'];
$result = $stmt-> execute($data);
if (!$result) {
    die("Cập nhật thất bại: " . mysqli_error()); 
    // Thông báo lỗi nếu thực thi câu lệnh thất bại
} else {
    echo "Cập nhật thành công";
}

//xóa dữ liệu
$stmt = $conn->prepare("DELETE from lichsu_gd WHERE id=:id");
$data = [
         'id' => '5',
];
$result=$stmt-> execute($data);
    
if (!$result) {
    die("Xóa thất bại: " . mysqli_error()); 
    // Thông báo lỗi nếu thực thi câu lệnh thất bại
} else {
    echo "Xóa thành công";
}

?>
