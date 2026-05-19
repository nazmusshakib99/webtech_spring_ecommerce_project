function submitReview(btn){

    let form = btn.closest(".reviewForm");
    let data = new FormData(form);

    fetch("../Controller/reviewValidation.php", {
        method: "POST",
        body: data
    })
    .then(res => res.json())
    .then(res => {

        if(res.ok){
            alert("Review submitted successfully!");
            location.reload();
        } else {
            alert(res.msg);
        }

    })
    .catch(err => console.log(err));
}