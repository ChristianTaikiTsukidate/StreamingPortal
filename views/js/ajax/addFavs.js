function addFavs() {
    var countryId = document.getElementById("country").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_cities.php?country_id=" + countryId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("city").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
let heart = document.getElementsByClassName('favBtn');
for (let i = 0; i <= heart.length; i++) {
    heart[i].onclick = function () {
        var xhr = new XMLHttpRequest();
        if(heart[i].querySelector('i').classList.toString() === "fa fa-heart-o")
        {
            xhr.open("GET", "insertFavorite.php?id=" + heart[i].value, true);
            heart[i].querySelector('i').classList.remove("fa-heart-o");
            heart[i].querySelector('i').classList.add("fa-heart");
        } else {
            alert("not")
        }
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
            }
        }
        xhr.send();
    }
}