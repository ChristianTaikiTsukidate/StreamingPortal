let hearts = document.getElementsByClassName('favBtn');
for (const heart of hearts) {
    heart.onclick = function () {
        let xhr = new XMLHttpRequest();
        let icon = heart.querySelector('i');
        if(icon.classList.contains("fa-heart-o"))
        {
            xhr.open("GET", "insertFavorite.php?id=" + heart.value.toString(), true);
            icon.classList.remove("fa-heart-o");
            icon.classList.add("fa-heart");
        } else {
            xhr.open("GET", "deleteFavorite.php?id=" + heart.value.toString(), true);
            icon.closest(".hoverContainer").remove();
        }
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // alert(xhr.responseText);
            } else {
                alert('Error:' . xhr.statusText);
            }
        }
        xhr.send();
    }
}