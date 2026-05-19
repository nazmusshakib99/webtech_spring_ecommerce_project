document.addEventListener("DOMContentLoaded", function(){

    const stars = document.querySelectorAll(".star");

    stars.forEach(star => {

        star.addEventListener("click", function(){

            let rating = this.dataset.star;

            document.getElementById("rating").value = rating;

            stars.forEach(s => s.innerHTML = "☆");

            for(let i=0;i<rating;i++){
                stars[i].innerHTML = "★";
            }

        });

    });

});

async function loadOrderDetails(orderId){

    try{

        const response = await fetch(`index.php?route=order/detail/${orderId}`);

        const data = await response.text();

        document.getElementById("order-details").innerHTML = data;

    }catch(error){

        console.log(error);

    }

}