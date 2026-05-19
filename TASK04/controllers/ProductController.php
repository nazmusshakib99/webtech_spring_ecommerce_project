<?php

require_once "../models/Product.php";
require_once "../models/Review.php";

class ProductController{

    private Product $productModel;
    private Review $reviewModel;

    public function __construct(){

        $this->productModel = new Product();

        $this->reviewModel = new Review();

    }

    public function catalogue(){

        $products = $this->productModel->getAllProducts();

        include "../views/products/catalogue.php";

    }

    public function detail(int $id): void{

        $product = $this->productModel->getProductById($id);

        $reviews = $this->reviewModel->getReviewsByProduct($id);

        include ROOT . "/views/products/detail.php";

    }

    public function addReview(int $id): void{

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $user_name = $_POST['user_name'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            $this->reviewModel->addReview(
                $id,
                $user_name,
                $rating,
                $comment
            );

            header("Location: public/index.php?route=product/detail/".$id);

        }

    }

}