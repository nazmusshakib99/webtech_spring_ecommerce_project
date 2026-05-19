<?php

require_once "../models/Order.php";

class OrderController{

    private Order $orderModel;

    public function __construct(){

        $this->orderModel = new Order();

    }

    public function myOrders(){

        $userId = 1;

        $orders = $this->orderModel->getOrdersByUser($userId);

        include "../views/partials/header.php";

        include "../views/orders/my_orders.php";

        include "../views/partials/footer.php";

    }

}
?>