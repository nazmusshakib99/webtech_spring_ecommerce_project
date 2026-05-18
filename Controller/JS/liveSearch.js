

function liveSearch(value){

   

    if(value.length == 0){
        document.getElementById("suggestions").style.display = "none";
        return;
    }

    

        var xhr = new XMLHttpRequest();

        xhr.open("GET", "../Controller/searchValidation.php?search=" + value, true);

        xhr.onload = function(){
            document.getElementById("suggestions").style.display = "block";
            document.getElementById("suggestions").innerHTML = this.responseText;
        }

        xhr.send();

    }

