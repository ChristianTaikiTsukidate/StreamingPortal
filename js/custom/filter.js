let dictionaryOptions = {
    genresfilter: [],
    releaseyearfilter: [],
    ratingsfilter: [],
    streamingservicefilter: [],
    actorsfilter: [],
    directorsfilter: [],
    mediafilter: []
};
document.getElementById("filterButton").onclick = hideFilter;
filterOptions = document.getElementsByClassName("filterOption");
for (let i = 0; i < filterOptions.length; i++) {
    filterOptions[i].onclick = function (){
        let arr = dictionaryOptions[this.parentNode.id];
        if(!arr.includes(this.innerHTML)) {
            arr.push(this.innerHTML);
            this.style.backgroundColor = 'red';
        } else {
            arr.splice(arr.indexOf(this.innerHTML), 1);
            this.style.backgroundColor = 'white';
        }
        arr.sort();
    }
}

function hideFilter() {
    document.getElementById('filters').style.display = "none";
    let filterButton = document.getElementById('filterButton');
    filterButton.innerHTML = "Show";
    filterButton.onclick = showFilter;
    appendFilterOption('Genre', dictionaryOptions.genresfilter);
    appendFilterOption('Release Date', dictionaryOptions.releaseyearfilter);
    appendFilterOption('Rating', dictionaryOptions.ratingsfilter);
    appendFilterOption('Streaming Service', dictionaryOptions.streamingservicefilter);
    appendFilterOption('Actor', dictionaryOptions.actorsfilter);
    appendFilterOption('Director', dictionaryOptions.directorsfilter);
    appendFilterOption('Media', dictionaryOptions.mediafilter);
    document.getElementById('selectedFilters').style.display = "block";
}
function showFilter() {
    document.getElementById('filters').style.display = "block";
    let filterButton = document.getElementById('filterButton');
    filterButton.innerHTML = "Hide";
    filterButton.onclick = hideFilter;
    document.getElementById('selectedFilters').innerHTML = '';
    document.getElementById('selectedFilters').style.display = "none";
}
function appendFilterOption(filterName, arr) {
    const nodeContainer = document.createElement("div");
    nodeContainer.classList.add("container");
    const nodeRow = document.createElement("div");
    nodeRow.classList.add("row");
    const nodeFilterName = document.createElement("div");
    nodeFilterName.classList.add("col-sm");
    nodeFilterName.innerHTML = filterName + ": ";
    nodeRow.appendChild(nodeFilterName);
    for (let i = 0; i < arr.length; i++) {
        const nodeColSm = document.createElement("div");
        nodeColSm.classList.add("col-sm");
        nodeColSm.innerHTML = arr[i];
        nodeRow.appendChild(nodeColSm);
    }
    nodeContainer.appendChild(nodeRow)
    document.getElementById("selectedFilters").appendChild(nodeContainer);
}
dropdownbtns = document.getElementsByClassName("dropdownbtn");
for (let i = 0; i < dropdownbtns.length; i++) {
    dropdownbtns[i].onclick = function() {
        let filterDropdowns = document.getElementsByClassName("filterDropdown");
        let isOpened = this.parentElement.getElementsByClassName("filterDropdown")[0].style.display === "block";
        for (let j = 0; j < filterDropdowns.length; j++) {
            filterDropdowns[j].style.display = "none";
        }
        if(!isOpened) {
            this.parentElement.getElementsByClassName("filterDropdown")[0].style.display = "block"
        }
    }
}

// document.onclick = function() {
//     let filterDropdowns = document.getElementsByClassName("filterDropdown");
//     for (let j = 0; j < filterDropdowns.length; j++) {
//         filterDropdowns[j].style.display = "none";
//     }
// }

filterInputs = document.getElementsByClassName("filterInput");
for (let i = 0; i < filterInputs.length; i++) {
    filterInputs[i].onkeydown = function () {
        const filter = this.value.toUpperCase();
        const div = this.parentElement;
        const a = div.getElementsByTagName("a");
        for (let i = 0; i < a.length; i++) {
            let txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
}
}

document.getElementById("searchButton").onclick = function () {
    let i = 0;
    for(let key in dictionaryOptions) {
        i = i + dictionaryOptions[key].length;
    }
    document.getElementById("filterResult").value = JSON.stringify(dictionaryOptions);
    if(i === 0) {
        document.getElementById("noFilterNotification").style.display = "block";
    } else {
        document.getElementById("noFilterNotification").style.display = "none";
    }
}

