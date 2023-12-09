<?php

class OrderModel
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function executeQuery($query, $params = array())
    {
        try {
            $stmt = $this->database->conn->prepare($query);

            // Bind parameters if there are any
            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value);
            }

            $stmt->execute();
            return $stmt->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Query execution failed: " . $e->getMessage();
        }
    }

    public function executeNonQuery($sql, $params = array())
    {
        try {
            $stmt = $this->database->conn->prepare($sql);

            // Bind parameters if there are any
            foreach ($params as $key => &$value) {
                $stmt->bindParam($key, $value);
            }

            $stmt->execute();
            return $stmt->rowCount();  // Return the number of affected rows
        } catch (PDOException $e) {
            echo "Query execution failed: " . $e->getMessage();
        }
    }

    public function createOrder($username, $totalPrice)
    {
        $sql = "INSERT INTO DonHang (TenTaiKhoan, TongDonHang) VALUES (:username, :totalPrice)";
        $params = [':username' => $username, ':totalPrice' => $totalPrice];

        $this->executeNonQuery($sql, $params);

        // Get the last inserted order ID
        $orderId = $this->database->conn->lastInsertId();

        // Perform other actions related to order creation if needed

        return $orderId;
    }

    public function addOrderDetail($orderId, $productId, $quantity)
    {
        $query = "INSERT INTO ChiTietDonHang (IDDonHang, IDMonAn, SoLuong) 
                  VALUES (:orderId, :productId, :quantity)";
        $params = [':orderId' => $orderId, ':productId' => $productId, ':quantity' => $quantity];

        $this->executeQuery($query, $params);
    }
}

?>
