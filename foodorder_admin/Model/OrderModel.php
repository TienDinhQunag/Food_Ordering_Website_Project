<?php
class OrderModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllOrders() {
        // Thực hiện truy vấn để lấy thông tin đơn hàng và IDDonHang
        $sql = "SELECT * FROM DonHang";
        $result = $this->conn->query($sql);

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            // Lấy chi tiết giỏ hàng cho mỗi đơn hàng
            $orderDetails = $this->getOrderDetails($row['IDDonHang']);
            $row['OrderDetails'] = $orderDetails;

            $orders[] = $row;
        }

        return $orders;
    }

    private function getOrderDetails($orderID) {
        // Thực hiện truy vấn để lấy thông tin chi tiết giỏ hàng
        $sql = "SELECT * FROM ChiTietGioHang WHERE IDDonHang = $orderID";
        $result = $this->conn->query($sql);

        $orderDetails = [];
        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }

        return $orderDetails;
    }
}
?>
s