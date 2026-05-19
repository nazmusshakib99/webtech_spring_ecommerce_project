<style>

body{
    font-family: Arial, sans-serif;
    background: #f4f7fb;
}

.order-table{
    width: 100%;
    border-collapse: collapse;
    margin-top: 25px;
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
}

.order-table th{
    background: linear-gradient(90deg, #4facfe, #00f2fe);
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 16px;
}

.order-table td{
    padding: 14px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    color: #333;
}

.order-table tr:nth-child(even){
    background: #f9fcff;
}

.order-table tr:hover{
    background: #eaf7ff;
    transition: 0.3s;
}

.btn{
    background: linear-gradient(90deg, #ff6a00, #ee0979);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s;
}

.btn:hover{
    transform: scale(1.05);
}

.status{
    padding: 6px 12px;
    border-radius: 20px;
    color: white;
    font-size: 13px;
    font-weight: bold;
}

.status.pending{
    background: orange;
}

.status.completed{
    background: green;
}

.status.processing{
    background: #007bff;
}

.no-orders{
    text-align: center;
    color: red;
    font-size: 18px;
    padding: 20px;
}

</style>

<table class="order-table">

    <tr>

        <th>Order ID</th>
        <th>User ID</th>
        <th>Total</th>
        <th>Status</th>
        <th>Action</th>

    </tr>

    <?php if(!empty($orders)){ ?>

        <?php foreach($orders as $order){ ?>

        <tr>

            <td><?php echo $order['id']; ?></td>

            <td><?php echo $order['user_id']; ?></td>

            <td>$<?php echo $order['total']; ?></td>

            <td>

                <span class="status <?php echo strtolower($order['status']); ?>">

                    <?php echo $order['status']; ?>

                </span>

            </td>

            <td>

                <button class="btn"
                    onclick="loadOrderDetails(<?php echo $order['id']; ?>)">

                    View

                </button>

            </td>

        </tr>

        <?php } ?>

    <?php }else{ ?>

    <tr>

        <td colspan="5" class="no-orders">

            No Orders Found

        </td>

    </tr>

    <?php } ?>

</table>