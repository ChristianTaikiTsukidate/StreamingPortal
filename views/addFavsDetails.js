let heart = document.getElementById('followBtn');
heart.onclick = function () {
    let xhr = new XMLHttpRequest();
    let icon = heart.querySelector('i');
    let followBtnValue = document.getElementById('followBtnValue').value;
    if (icon.classList.contains("fa-heart-o")) {
        xhr.open("GET", "insertFavorite.php?id=" + followBtnValue, true);
        icon.classList.remove("fa-heart-o");
        icon.classList.add("fa-heart");
    } else {
        xhr.open("GET", "deleteFavorite.php?id=" + followBtnValue, true);
        icon.classList.remove("fa-heart");
        icon.classList.add("fa-heart-o");
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
         //   alert(xhr.responseText);
        } else {
            alert('Error:'.xhr.statusText);
        }
    }
    xhr.send();
}