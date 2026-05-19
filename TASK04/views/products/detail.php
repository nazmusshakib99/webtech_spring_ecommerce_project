<?php include ROOT . "/views/partials/header.php"; ?>

<style>

.container{
    width: 85%;
    margin: auto;
    padding: 20px;
}

.product-card{
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.product-card img{
    width: 100%;
    max-width: 400px;
    height: auto;
    border-radius: 10px;
    display: block;
    margin-bottom: 20px;
}

.product-card h2{
    margin-bottom: 10px;
    color: #222;
}

.product-card p{
    color: #555;
    line-height: 1.6;
}

.product-card h3{
    color: #007bff;
    margin-top: 15px;
}

.review-box{
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    margin-bottom: 25px;
}

.review-box h3{
    margin-bottom: 20px;
    color: #222;
}

input[type="text"],
textarea{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 15px;
}

textarea{
    min-height: 120px;
    resize: vertical;
}

.star{
    font-size: 30px;
    color: orange;
    cursor: pointer;
    margin-right: 5px;
}

.btn{
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover{
    background: #0056b3;
}

.review-box h4{
    margin-bottom: 5px;
    color: #333;
}

.review-box p{
    color: #555;
    line-height: 1.5;
}

hr{
    border: 0;
    border-top: 1px solid #ddd;
    margin: 20px 0;
}

</style>

<?php

if(!isset($product)){

    die("Product Not Found");

}

?>

<div class="container">

    <div class="product-card">

        <img src="public/images/<?php echo $product['image']; ?>" alt="">

        <h2><?php echo $product['name']; ?></h2>

        <p><?php echo $product['description']; ?></p>

        <h3>$<?php echo $product['price']; ?></h3>

    </div>

    <div class="review-box">

        <h3>Give Review</h3>

        <form method="POST"
              action="public/index.php?route=product/addReview/<?php echo $product['id']; ?>">

            <input type="text"
                   name="user_name"
                   placeholder="Your Name"
                   required>

            <br><br>

            <div>

                <span class="star" data-star="1">☆</span>
                <span class="star" data-star="2">☆</span>
                <span class="star" data-star="3">☆</span>
                <span class="star" data-star="4">☆</span>
                <span class="star" data-star="5">☆</span>

            </div>

            <input type="hidden"
                   name="rating"
                   id="rating">

            <br>

            <textarea name="comment"
                      placeholder="Write review"
                      required></textarea>

            <br><br>

            <button class="btn" type="submit">

                Submit Review

            </button>

        </form>

    </div>

    <div class="review-box">

        <h3>Reviews</h3>

        <?php if(isset($reviews) && !empty($reviews)){ ?>

            <?php foreach($reviews as $review){ ?>

            <div>

                <h4>

                    <?php echo $review['user_name']; ?>

                </h4>

                <p>

                    Rating:
                    <?php echo $review['rating']; ?>/5

                </p>

                <p>

                    <?php echo $review['comment']; ?>

                </p>

                <hr>

            </div>

            <?php } ?>

        <?php }else{ ?>

            <p>No Reviews Yet</p>

        <?php } ?>

    </div>

</div>

<?php include ROOT . "/views/partials/footer.php"; ?>