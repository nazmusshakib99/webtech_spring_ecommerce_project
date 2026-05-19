<?php

require_once "../models/Order.php";

class AdminController{

    private Order $orderModel;

    public function __construct(){

        $this->orderModel = new Order();

    }

    public function orders(){

        $orders = $this->orderModel->getAllOrders();

        include "../views/partials/header.php";

        include "../views/admin/orders.php";

        include "../views/partials/footer.php";

    }

}
?>