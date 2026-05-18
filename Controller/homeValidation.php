<?php
session_start();

require_once "../Model/categoryModel.php";
require_once "../Model/productModel.php";

$category = new CategoryModel();
$product = new ProductModel();

$categories = $category->getAllCategories();
$products = $product->getAllProducts();

include "../View/homeView.php";
?>