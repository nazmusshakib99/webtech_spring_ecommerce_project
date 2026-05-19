<?php
session_start();
require_once "../Config/helper.php";
require_admin();

require_once "../Model/adminModel.php";

$model = new AdminModel();
$products = $model->getAllProducts();
$categories = $model->getCategories();

$status = $_GET['status'] ?? "";
$from = $_GET['from'] ?? "";
$to = $_GET['to'] ?? "";

$orders = $model->getAllOrders($status, $from, $to);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<link rel="stylesheet" href="../View/Style/adminStyle.css">
<script src="../Controller/JS/admin.js"></script>
</head>

<body>

<div class="header">
    <h2>Admin Dashboard</h2>
    <a href="../Controller/logout.php" class="logout">Logout</a>
</div>

<div class="form-container">
<h3>Add Product</h3>

<form id="addForm" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Product Name" required>
<textarea name="description" placeholder="Description"></textarea>
<input type="number" name="price" placeholder="Price" required>
<input type="number" name="stock" placeholder="Stock" required>

<select name="category_id" required>
<option value="">Select Category</option>
<?php while($cat = mysqli_fetch_assoc($categories)){ ?>
<option value="<?php echo $cat['id']; ?>">
<?php echo isset($cat['parent_id']) && $cat['parent_id'] ? "-- ".$cat['name'] : $cat['name']; ?>
</option>
<?php } ?>
</select>

<input type="file" name="image" required>

<button type="button" onclick="addProduct()">Add Product</button>

<p id="msg"></p>
</form>
</div>

<table>
<tr>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($products)){ ?>
<tr class="<?php echo ($row['stock_qty'] <= 5) ? 'low-stock' : ''; ?>">

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['price']; ?></td>
<td><?php echo $row['stock_qty']; ?></td>

<td>
<span class="badge <?php echo $row['is_available'] ? 'in' : 'out'; ?>"
onclick="toggleStock(<?php echo $row['id']; ?>)">
<?php echo $row['is_available'] ? 'In Stock' : 'Out'; ?>
</span>
</td>

<td>
<a href="../Controller/editProduct.php?id=<?php echo $row['id']; ?>">Edit</a> |

<a href="../Controller/adminValidation.php?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this product?')">
Delete
</a>

</td>

</tr>
<?php } ?>

</table>

<?php
if(isset($_GET['msg'])){

    if($_GET['msg'] == "deleted"){
        echo "<p style='color:green; text-align:center;'>
        Product Deleted Successfully
        </p>";
    }

    if($_GET['msg'] == "cannot_delete"){
        echo "<p style='color:red; text-align:center;'>
        Cannot delete product because it already exists in orders
        </p>";
    }
}
?>


</body>
</html>