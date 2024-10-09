window.onload = function() {
    //alert("Reminder: bereits gewählte Suchfilter über Session setzen.")
    dictionaryOptions.genreFilter.push("Action");
    dictionaryOptions.releaseDateFilter.push("2024");
    dictionaryOptions.ratingFilter.push("5");
    dictionaryOptions.streamingServiceFilter.push("Netflix");
    dictionaryOptions.actorFilter.push("a");
    dictionaryOptions.directorFilter.push("a");
    let filterOptions = document.getElementsByClassName("filterOption");
    for (let i = 0; i < filterOptions.length; i++) {
        if(filterOptions[i].innerHTML === "Action") {
            filterOptions[i].style.backgroundColor = 'red';
        } else if(filterOptions[i].innerHTML === "2024") {
            filterOptions[i].style.backgroundColor = 'red';
        } else if(filterOptions[i].innerHTML === "5") {
            filterOptions[i].style.backgroundColor = 'red';
        } else if(filterOptions[i].innerHTML === "Netflix") {
            filterOptions[i].style.backgroundColor = 'red';
        } else if(filterOptions[i].innerHTML === "a") {
            filterOptions[i].style.backgroundColor = 'red';
        } else if(filterOptions[i].innerHTML === "a") {
            filterOptions[i].style.backgroundColor = 'red';
        }
    }
}
document.getElementById("searchField").onkeyup = searchMovie;
document.getElementById("searchField").onkeydown = searchMovie;
    function searchMovie () {
        productItems = document.getElementsByClassName("product__item");
        for (let i = 0; i < productItems.length; i++) {
            if(!productItems[i].getElementsByTagName("h5")[0].innerText.toUpperCase().includes(this.value.toUpperCase())) {
                productItems[i].style.display = "none";
            } else {
                productItems[i].style.display = "block";
            }
        }
    }
