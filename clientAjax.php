<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche en Live</title>
    <style>
        /* Styles de base */
        #results {
            border: 1px solid #ccc;
            max-width: 400px;
            margin-top: 10px;
        }
        .result-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
    <h1>Recherche en Live avec AJAX et PHP</h1>
    <input type="text" id="search" placeholder="Rechercher...">
    <div id="results"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('search').addEventListener('input', function() {
                var query = this.value;
                if (query.length > 0) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'serverAjax.php?search=' + encodeURIComponent(query), true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById('results').innerHTML = xhr.responseText;
                        }
                    };
                    xhr.send();
                } else {
                    document.getElementById('results').innerHTML = '';
                }
            });
        });
    </script>
</body>
</html>
