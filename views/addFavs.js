let heart = document.getElementsByClassName('favBtn');
for (let i = 0; i < heart.length; i++) {
    heart[i].onclick = function () {
        let xhr = new XMLHttpRequest();
        let icon = heart[i].querySelector('i');
        if(icon.classList.contains("fa-heart-o"))
        {
            xhr.open("GET", "insertFavorite.php?id=" + heart[i].value.toString(), true);
            icon.classList.remove("fa-heart-o");
            icon.classList.add("fa-heart");
        } else {
            xhr.open("GET", "deleteFavorite.php?id=" + heart[i].value.toString(), true);
            icon.classList.remove("fa-heart");
            icon.classList.add("fa-heart-o");
        }
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            } else {
                alert('Error:' . xhr.statusText);
            }
        }
        xhr.send();
    }
}