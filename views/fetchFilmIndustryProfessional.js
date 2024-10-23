let endpoint = "http://localhost:5081/api/FilmIndustryProfessional";
data = fetch(endpoint)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(json => {
        let li = ``;
        json.forEach(filmIndustryProfessional => {
            li += `<tr>
                <td>${filmIndustryProfessional.id}</td>
                <td><input type="text" class="form-control" value="${filmIndustryProfessional.firstname}"/></td>
                <td><input type="text" class="form-control" value="${filmIndustryProfessional.lastname}"/></td>
                <td><button class="btn btn-primary updateBtn" value="${filmIndustryProfessional.id}">Update</button></td>
                <td><button class="btn btn-danger deleteBtn" value="${filmIndustryProfessional.id}">Delete</button></td>
            </tr>`;
        });
        document.getElementById("fetchBody").innerHTML = li;

        let updateBtns = document.getElementsByClassName("updateBtn");
        for (let i = 0; i < updateBtns.length; i++) {
            updateBtns[i].onclick = function () {
                // Get the input value when the button is clicked

                const firstname = updateBtns[i].closest('tr').getElementsByTagName('input')[0].value;
                const lastname = updateBtns[i].closest('tr').getElementsByTagName('input')[1].value;
                const requestOptions = {
                    method: 'PUT',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        firstname: firstname,
                        lastname: lastname
                    }) // Sending the updated name
                };

                // Fetch the update API
                fetch(`${endpoint}/${updateBtns[i].value}`, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Update successful:', data);
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            }
        }
        // Add event listeners for update buttons after rendering the table
        let deleteBtns = document.getElementsByClassName("deleteBtn");
        for (let i = 0; i < deleteBtns.length; i++) {
            deleteBtns[i].onclick = function () {
                const requestOptions = {
                    method: 'DELETE',
                    headers: {'Content-Type': 'application/json'}
                };

                // Fetch the update API
                fetch(`${endpoint}/${deleteBtns[i].value}`, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        const row = this.closest('tr');
                        if (row) {
                            row.remove();
                        } else {
                            alert('No row found to remove');
                        }
                        console.log('Delete successful:', data);
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });

            }
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
let addBtn = document.getElementById("addBtn");
addBtn.onclick = function () {
    const requestOptions = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            firstname: addBtn.closest('form').getElementsByTagName('input')[0].value,
            lastname: addBtn.closest('form').getElementsByTagName('input')[1].value
        })
    };
    // Fetch the update API
    fetch(`${endpoint}`, requestOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Update successful:', data);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}