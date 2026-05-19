<style>

body{
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #eef2f7, #d9e7ff);
    margin: 0;
    padding: 0;
}

.container{
    width: 90%;
    margin: 40px auto;
}

.container h2{
    text-align: center;
    color: #222;
    margin-bottom: 25px;
    font-size: 32px;
}

.order-table{
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 5px 18px rgba(0,0,0,0.12);
}

.order-table th{
    background: linear-gradient(90deg, #667eea, #764ba2);
    color: white;
    padding: 16px;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.order-table td{
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 15px;
    color: #333;
}

.order-table tr:nth-child(even){
    background: #f8f9ff;
}

.order-table tr:hover{
    background: #edf4ff;
    transition: 0.3s;
}

.status{
    padding: 6px 14px;
    border-radius: 20px;
    color: white;
    font-size: 13px;
    font-weight: bold;
}

.status.pending{
    background: orange;
}

.status.completed{
    background: #28a745;
}

.status.processing{
    background: #007bff;
}

.no-orders{
    color: red;
    font-size: 18px;
    font-weight: bold;
    padding: 20px;
}

</style>

<div class="container">

    <h2>My Orders</h2>

    <table class="order-table">

        <tr>

            <th>Order ID</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>

        </tr>

        <?php if(isset($orders) && !empty($orders)){ ?>

            <?php foreach($orders as $order){ ?>

            <tr>

                <td><?php echo $order['id']; ?></td>

                <td>$<?php echo $order['total']; ?></td>

                <td>

                    <span class="status <?php echo strtolower($order['status']); ?>">

                        <?php echo $order['status']; ?>

                    </span>

                </td>

                <td><?php echo $order['created_at']; ?></td>

            </tr>

            <?php } ?>

        <?php }else{ ?>

            <tr>

                <td colspan="4" class="no-orders">

                    No Orders Found

                </td>

            </tr>

        <?php } ?>

    </table>

</div>