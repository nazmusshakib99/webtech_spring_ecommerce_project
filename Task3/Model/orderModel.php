<?php

require_once "db.php";

class OrderModel extends Database {

    public function createOrder($userId, $shippingAddress, $paymentMethod, $items, $totalAmount){

        $conn = $this->connection();
        mysqli_begin_transaction($conn);

        try {
            $userId = intval($userId);
            $shippingAddress = mysqli_real_escape_string($conn, $shippingAddress);
            $paymentMethod = mysqli_real_escape_string($conn, $paymentMethod);
            $totalAmount = floatval($totalAmount);

            $orderSql = "INSERT INTO orders (user_id, shipping_address, payment_method, total_amount, status)
                         VALUES ($userId, '$shippingAddress', '$paymentMethod', $totalAmount, 'Pending')";

            if(!mysqli_query($conn, $orderSql)){
                throw new Exception(mysqli_error($conn));
            }

            $orderId = mysqli_insert_id($conn);

            foreach($items as $item){
                $productId = intval($item['product_id']);
                $quantity = intval($item['quantity']);
                $unitPrice = floatval($item['unit_price']);

                $stockSql = "UPDATE products
                             SET stock_qty = stock_qty - $quantity
                             WHERE id = $productId AND stock_qty >= $quantity";

                if(!mysqli_query($conn, $stockSql) || mysqli_affected_rows($conn) !== 1){
                    throw new Exception("Insufficient stock for product ID $productId");
                }

                $itemSql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price)
                            VALUES ($orderId, $productId, $quantity, $unitPrice)";

                if(!mysqli_query($conn, $itemSql)){
                    throw new Exception(mysqli_error($conn));
                }
            }

            mysqli_commit($conn);
            return $orderId;

        } catch(Exception $e){
            mysqli_rollback($conn);
            return false;
        }
    }

    public function getOrderSummary($orderId, $userId = null){

        $conn = $this->connection();
        $orderId = intval($orderId);

        $where = "id = $orderId";
        if($userId !== null){
            $where .= " AND user_id = " . intval($userId);
        }

        $orderResult = mysqli_query($conn, "SELECT * FROM orders WHERE $where");
        $order = $orderResult ? mysqli_fetch_assoc($orderResult) : null;

        if(!$order){
            return null;
        }

        $itemsSql = "SELECT oi.*, p.name, p.image
                     FROM order_items oi
                     JOIN products p ON p.id = oi.product_id
                     WHERE oi.order_id = $orderId";
        $itemsResult = mysqli_query($conn, $itemsSql);

        $items = [];
        while($row = mysqli_fetch_assoc($itemsResult)){
            $items[] = $row;
        }

        return [
            'order' => $order,
            'items' => $items
        ];
    }

    public function getOrdersByUser($userId){

        $conn = $this->connection();
        $userId = intval($userId);

        $result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC");
        $orders = [];

        while($row = mysqli_fetch_assoc($result)){
            $orders[] = $row;
        }

        return $orders;
    }
}

?>
