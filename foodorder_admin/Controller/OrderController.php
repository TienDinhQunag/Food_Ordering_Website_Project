// OrderController.php

<?php
class OrderController {
    private $model;

    public function __construct($conn) {
        $this->model = new OrderModel($conn);
    }

    public function index() {
        // Gọi hàm từ model để lấy thông tin đơn hàng
        $orders = $this->model->getAllOrders();

        // Hiển thị view
        require('../views/order_list.php');
    }

    public function viewOrderDetails($orderId) {
        // Gọi hàm từ model để lấy thông tin chi tiết đơn hàng theo $orderId
        $orderDetails = $this->model->getOrderDetailsById($orderId);

        // Hiển thị view chi tiết đơn hàng
        require('../views/order_details.php');
    }
}
?>
