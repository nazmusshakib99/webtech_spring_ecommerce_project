/* ================= ADD PRODUCT ================= */
function addProduct(){

    let form = document.getElementById("addForm");
    let data = new FormData(form);

    data.append("action", "add");

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            document.getElementById("msg").innerHTML = this.responseText;

            // reload after success
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    };

    xhttp.open("POST", "../Controller/adminValidation.php", true);
    xhttp.send(data);
}




/* ================= TOGGLE STOCK ================= */
function toggleStock(id){

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            location.reload();
        }
    };

    xhttp.open("POST", "../Controller/adminValidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("toggle=1&id=" + id);
}


/* ================= UPDATE PRODUCT ================= */
function updateProduct(){

    let form = document.getElementById("editForm");
    let data = new FormData(form);

    data.append("action", "update");

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

          
            window.location.href = "../View/adminView.php";
        }
    };

    xhttp.open("POST", "../Controller/adminValidation.php", true);
    xhttp.send(data);
}
s


/* ================= UPDATE ORDER STATUS ================= */
function updateOrder(select, id){

    let status = select.value;

    fetch("../Controller/adminValidation.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "updateOrder=1&id=" + id + "&status=" + status
    })
    .then(res => res.json())
    .then(res => {
        if(res.ok){
            alert("Order updated successfully");
        } else {
            alert("Error updating order");
        }
    })
    .catch(err => console.log(err));

    
}