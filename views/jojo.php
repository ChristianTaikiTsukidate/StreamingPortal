<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX mit PHP</title>
    <script>
        function loadMessage() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "MediaEditView.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("message").innerText = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
<h1>AJAX Beispiel mit PHP</h1>
<button onclick="loadMessage()">Nachricht laden</button>
<p id="message"></p>
</body>
</html>