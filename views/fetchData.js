data = fetch("http://localhost:5081/api/Genre")
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    }).then(json => {
        let li = ``;
        json.forEach(genre => {
            li += `<tr>
                <td><input type="text" class="form-control" value="${genre.id}"/></td>
                <td><input type="text" class="form-control" value="${genre.name}"/></td>
                <td><button class="btn btn-primary" value="${genre.id}" class="updateBtn">Update</button></td>
                <td><button class="btn btn-danger" value="${genre.id}" class="deleteBtn">Delete</button></td>
            </tr>`;
        });
        document.getElementById("genreTBody").innerHTML = li;
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
updateBtns = document.getElementsByClassName("updateBtn");
for (let i = 0; i < updateBtns.length; i++) {
    updateBtns[i].onclick = function (){

    }
}