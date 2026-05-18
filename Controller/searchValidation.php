<?php

require_once "../Model/productModel.php";
require_once "../Model/categoryModel.php";

$productModel = new ProductModel();
$categoryModel = new CategoryModel();

if(isset($_GET['search'])){

    $keyword = trim($_GET['search']);

    if($keyword == ""){
        exit();
    }

    $conn = $categoryModel->connection();
    $safeKeyword = mysqli_real_escape_string($conn, $keyword);

   
    $catSql = "SELECT * FROM categories WHERE name LIKE '%$safeKeyword%'";
    $catResult = mysqli_query($conn, $catSql);

    while($cat = mysqli_fetch_assoc($catResult)){
        ?>
        <a href="../Controller/categoryValidation.php?id=<?php echo $cat['id']; ?>">
            <div style="padding:8px; font-weight:bold; background:#f9f9f9;">
                Category: <?php echo htmlspecialchars($cat['name']); ?>
            </div>
        </a>
        <?php
    }

   
    $products = $productModel->searchProducts($keyword);

    while($item = mysqli_fetch_assoc($products)){
        ?>
        <a href="../Controller/productValidation.php?id=<?php echo $item['id']; ?>">
            <div style="display:flex; align-items:center; gap:10px; padding:8px;">
                <img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>" width="40">
                <?php echo htmlspecialchars($item['name']); ?> - $<?php echo $item['price']; ?>
            </div>
        </a>
        <?php
    }
}
?>