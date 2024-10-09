document.getElementById("deleteBtn").onclick = function () {
    let result = confirm("Want to delete?");
    if (!result) {
        document.getElementById("deleteBtn").name = "form_NOTdelete";
    }
}