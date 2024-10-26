function generateAPITable(endpoint) {
    generateAPIHeadersAndAddRow(endpoint);
    generateAPIRows(endpoint);
}
function generateAPIHeadersAndAddRow(endpoint) {
    let dataSchema = fetch(endpoint + "/schema").then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    }).then(json => {
        let headers = ``;
        let body = `<tr>`;
        for (let key in json) {
            if (json.hasOwnProperty(key) && !Array.isArray(json[key])) {
                headers += `<th scope="col">${key}</th>`;
                if(key === "id") {
                    body += `<td><input type="text" class="form-control" name="${key}" placeholder="${key}" disabled style="background-color: grey; color: white; -webkit-text-fill-color: white; opacity: 1;"></td>`;
                } else {
                    body += `<td><input type="text" class="form-control" name="${key}" placeholder="${key}"></td>`;
                }
            }
        }
        headers += `<th scope="col">Actions</th>`;
        body += `<td><button class="btn btn-primary" id="addBtn" href="javascript:void(0);">Submit</button></td></tr>`;
        document.getElementById("fetchHeader").innerHTML = headers;
        document.getElementById("fetchBody").innerHTML = body;
    }).catch(error => {
        console.error('Fetch error:', error);
    });
}
function generateAPIRows(endpoint) {
    data = fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(json => {

            let body = generateFetchBody(json);

            document.getElementById("fetchBody").innerHTML += body;

            addBtnLogic(endpoint);

            updateBtnLogic(endpoint)

            // Add event listeners for update buttons after rendering the table
            deleteBtnLogic(endpoint);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}
function generateHTTPBodyData(valuesArr) {
    const data = {};
    for (const input of valuesArr) {
        if(input.value !== "") {
            data[input.name] = input.value;
        } else {
        }

    }
    return JSON.stringify(data);
}

function updateBtnLogic(endpoint) {
    let updateBtns = document.getElementsByClassName("updateBtn");
    for (let i = 0; i < updateBtns.length; i++) {
        updateBtns[i].onclick = function () {
            // Get the input value when the button is clicked
            // Get the inputs from the row
            const valuesArr = updateBtns[i].closest('tr').getElementsByTagName('input');
            let jsonBody = generateHTTPBodyData(valuesArr);

            const requestOptions = {
                method: 'PUT', headers: {'Content-Type': 'application/json'}, body: jsonBody, // Sending the updated name
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
}
function generateFetchBody(json) {
    let body = ``;
    json.forEach(jsonObject => {
        body += `<tr>`;

        Object.entries(jsonObject).forEach(([key, value]) => {
            if (!Array.isArray(value)) {
                if (key === "id") {
                    body += `<td><input type="text" class="form-control" name="${key}" value="${value}" disabled style="background-color: grey; color: white; -webkit-text-fill-color: white; opacity: 1;"/></td>`;
                } else {
                    body += `<td><input type="text" class="form-control" name="${key}" value="${value}"/></td>`;
                }
            }
        });

        body += `
                <td><button class="btn btn-primary updateBtn" href="javascript:void(0);" value="${jsonObject.id}">Update</button>
                <button class="btn btn-danger deleteBtn" href="javascript:void(0);" value="${jsonObject.id}">Delete</button></td>
            </tr>`;
    })
    return body;
}

function deleteBtnLogic(endpoint) {
    let deleteBtns = document.getElementsByClassName("deleteBtn");
    for (let i = 0; i < deleteBtns.length; i++) {
        deleteBtns[i].onclick = function () {
            const requestOptions = {
                method: 'DELETE', headers: {'Content-Type': 'application/json'}
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
}

function addBtnLogic(endpoint) {
    const addBtn = document.getElementById("addBtn");
    addBtn.onclick = function () {
        const valuesArr = addBtn.closest('tr').getElementsByTagName('input');
        let jsonBody = generateHTTPBodyData(valuesArr);
        const requestOptions = {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: jsonBody
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
}