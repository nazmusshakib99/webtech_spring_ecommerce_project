<?php include ROOT . "/views/partials/header.php"; ?>

<style>

body{
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #eef2ff, #d7f0ff);
}

.container{
    width: 90%;
    margin: auto;
    padding: 40px 0;
}

.container h2{
    text-align: center;
    margin-bottom: 40px;
    color: #222;
    font-size: 38px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.product-grid{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.product-card{
    background: #ffffff;
    border-radius: 18px;
    padding: 20px;
    text-align: center;
    overflow: hidden;
    position: relative;
    transition: 0.4s;
    box-shadow: 0px 6px 18px rgba(0,0,0,0.12);
}

.product-card:hover{
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0px 10px 25px rgba(0,0,0,0.18);
}

.product-card::before{
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(90deg, #ff512f, #dd2476, #4facfe);
}

.product-card img{
    width: 100%;
    height: 230px;
    object-fit: cover;
    border-radius: 15px;
    margin-bottom: 18px;
    transition: 0.4s;
}

.product-card:hover img{
    transform: scale(1.05);
}

.product-card h3{
    color: #222;
    font-size: 24px;
    margin-bottom: 12px;
}

.product-card p{
    color: #666;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 18px;
}

.product-card h4{
    font-size: 28px;
    margin-bottom: 22px;
    background: linear-gradient(90deg, #007bff, #00c6ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
}

.btn{
    display: inline-block;
    text-decoration: none;
    background: linear-gradient(90deg, #ff512f, #dd2476);
    color: white;
    padding: 12px 24px;
    border-radius: 30px;
    font-size: 15px;
    font-weight: bold;
    transition: 0.3s;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
}

.btn:hover{
    transform: scale(1.08);
    background: linear-gradient(90deg, #dd2476, #ff512f);
}

.no-products{
    text-align: center;
    color: red;
    font-size: 22px;
    font-weight: bold;
    margin-top: 30px;
}

</style>

<div class="container">

    <h2>Product Catalogue</h2>

    <div class="product-grid">

        <?php if(isset($products) && !empty($products)){ ?>

            <?php foreach($products as $product){ ?>

            <div class="product-card">

                <img src="public/images/<?php echo $product['image']; ?>" alt="">

                <h3><?php echo $product['name']; ?></h3>

                <p><?php echo $product['description']; ?></p>

                <h4>$<?php echo $product['price']; ?></h4>

                <a class="btn"
                   href="public/index.php?route=product/detail/<?php echo $product['id']; ?>">

                    View Details

                </a>

            </div>

            <?php } ?>

        <?php }else{ ?>

            <p class="no-products">

                No Products Found

            </p>

        <?php } ?>

    </div>

</div>

<?php include ROOT . "/views/partials/footer.php"; ?>