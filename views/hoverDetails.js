hoverContainers = document.getElementsByClassName('hoverContainer');
for (let i = 0; i < hoverContainers.length; i++) {
    hoverContainers[i].onmouseenter = function () {
        let xhr = new XMLHttpRequest();
        let mediaId = hoverContainers[i].getElementsByTagName('input')[0].value;
        xhr.open("GET", "getMovieDetails.php?id=" + mediaId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let details = JSON.parse(xhr.responseText);
                let genreArr = Array.from(details['genres']);
                let genres = details['genres'][0];
                for (let j = 1; j < genreArr.length; j++) {
                    genres += ", " + genreArr[j];
                }
                hoverContainers[i].getElementsByClassName('details-box')[0].style.display = 'block';
                hoverContainers[i].getElementsByClassName('details-box')[0].innerHTML =
                    '                    <ul>\n' +
                    '                        <li><span>Type: </span>' + details['type'] + '</li>\n' +
                    '                        <li><span>Studios: </span> Lerche</li>\n' +
                    '                        <li><span>Date aired: </span>' + details['releaseYear'] + '</li>\n' +
                    '                        <li><span>Status: </span> Airing</li>\n' +
                    '                        <li><span>Genre: </span>' + genres + '</li>\n' +
                    '                        <li><span>Rating: </span>' + details['rating'] + '</li>\n' +
                    '                        <li><span>Duration: </span>' + details['duration'] + '</li>\n' +
                    '                    </ul>\n'
            } else {
                alert('Error:'.xhr.statusText);
            }
        }
        xhr.send();
    }
    hoverContainers[i].onmouseleave = function () {
        hoverContainers[i].getElementsByClassName('details-box')[0].style.display = 'none';
    }
}