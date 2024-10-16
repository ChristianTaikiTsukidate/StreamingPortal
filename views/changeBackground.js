document.getElementById("backgroundbutton").onclick = function () {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "getBackgroundImages.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementsByTagName("html")[0].style.backgroundImage = "url('img/background/" + xhr.responseText + "')";
            document.getElementsByTagName("body")[0].style.backgroundImage = "url('img/background/" + xhr.responseText + "')";
        } else {
            alert('Error:'.xhr.statusText);
        }
    }
    xhr.send();
}