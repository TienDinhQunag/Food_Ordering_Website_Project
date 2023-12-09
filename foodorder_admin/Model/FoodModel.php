<?php
include('../config/database.php');

class FoodModel {
    private $db;

    // Hàm lấy danh sách món ăn
    public function getAllFoods() {
        global $conn;
        $sql = "SELECT IDMonAn, TenMonAn, MoTa, Gia, LoaiMonAn, HinhAnh FROM MonAn";
        $result = $conn->query($sql);
        $foods = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $foods[] = $row;
            }
        }
        return $foods;
    }
    public function searchFoods($searchTerm) {
        global $conn;

        $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

        $sql = "SELECT IDMonAn, TenMonAn, MoTa, Gia, LoaiMonAn, HinhAnh FROM MonAn
                WHERE TenMonAn LIKE '%$searchTerm%'";
                
        $result = $conn->query($sql);

        $foods = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $foods[] = $row;
            }
        }

        return $foods;
    }


    // Thêm mới món ăn
    // Viết hàm thêm món ăn tại đây
    // Thêm mới món ăn
        public function addNewFood($tenMonAn, $moTa, $gia, $loaiMonAn, $hinhAnh) {
            global $conn;

            $tenMonAn = mysqli_real_escape_string($conn, $tenMonAn);
            $moTa = mysqli_real_escape_string($conn, $moTa);
            $loaiMonAn = mysqli_real_escape_string($conn, $loaiMonAn);
            $hinhAnh = mysqli_real_escape_string($conn, $hinhAnh);

            // Thực hiện việc thêm mới món ăn vào cơ sở dữ liệu
            $sql = "INSERT INTO MonAn (TenMonAn, MoTa, Gia, LoaiMonAn, HinhAnh) VALUES ('$tenMonAn', '$moTa', $gia, '$loaiMonAn', '$hinhAnh')";
            $result = $conn->query($sql);

            if (!$result) {
                echo "Lỗi: " . $conn->error;
            }
        }

        public function getFoodById($foodId) {
            global $conn;
            $sql = "SELECT * FROM MonAn WHERE IDMonAn = $foodId";
            $result = $conn->query($sql);
            return $result->fetch_assoc();
        }
        
        
        public function editFood($foodId, $tenMonAn, $moTa, $gia, $loaiMonAn, $hinhAnh) {
            global $conn;
    
            $tenMonAn = mysqli_real_escape_string($conn, $tenMonAn);
            $moTa = mysqli_real_escape_string($conn, $moTa);
            $loaiMonAn = mysqli_real_escape_string($conn, $loaiMonAn);
            $hinhAnh = mysqli_real_escape_string($conn, $hinhAnh);
    
            // Update the food information in the database
            $sql = "UPDATE MonAn SET 
                    TenMonAn = '$tenMonAn', 
                    MoTa = '$moTa', 
                    Gia = " . ($gia !== '' ? $gia : 'NULL') . ", 
                    LoaiMonAn = '$loaiMonAn', 
                    HinhAnh = '$hinhAnh' 
                    WHERE IDMonAn = $foodId";
    
            $result = $conn->query($sql);
    
            if (!$result) {
                echo "Lỗi: " . $conn->error;
            }
        }
        public function deleteFood($foodId) {
            global $conn;
    
            // Additional validation or security checks can be added here
    
            $sql = "DELETE FROM MonAn WHERE IDMonAn = $foodId";
            $result = $conn->query($sql);
    
            if (!$result) {
                echo "Lỗi: " . $conn->error;
                // Handle error as needed
            }
        }
        
        

        
   
        
        



    


}
?>
