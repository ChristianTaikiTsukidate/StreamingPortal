document.getElementById("seriesMovieButton").onclick = function () {
    let seriesBtnArr = document.getElementsByClassName("seriesBtn");
    if(document.getElementById("seriesMovieButton").innerText === "Series") {
        document.getElementById("seriesMovieButton").innerText = "Movie";
        for (let i = 0; i < seriesBtnArr.length; i++) {
            seriesBtnArr[i].style.display = "block";
        }
        document.getElementById("movieSpecifics").style.display = "none";
        document.getElementById("submitMedia").value = "Series";
        document.getElementById("addingForm").action = "episodeeditpage.php";
        document.getElementById("Duration").removeAttribute('required');
        document.getElementById("Release Year").removeAttribute('required');
    } else {
        document.getElementById("seriesMovieButton").innerText = "Series";

        for (let i = 0; i < seriesBtnArr.length; i++) {
            seriesBtnArr[i].style.display = "none";
        }
        document.getElementById("movieSpecifics").style.display = "block";
        document.getElementById("submitMedia").value = "Movie";
        document.getElementById("addingForm").action = "movieedit.php";
        document.getElementById("Duration").setAttribute('required', 'required');
        document.getElementById("Release Year").setAttribute('required', 'required');
    }
}