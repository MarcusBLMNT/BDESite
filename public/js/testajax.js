var responseDiv = document.getElementById('resultatAjax');
var xhttp = new XMLHttpRequest();
xhttp.open('GET', 'http://127.0.0.1/BDESite2/git/BDESite/public/api/apiphp/apiListerUtilisateurs.php', true);
xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4) {
        var json = JSON.parse(xhttp.response);
        var length = json.length;
        for (var i = 0; i < length; i++) {
            console.log("Nom : " + json[i].pseudo);
            var originalContent = responseDiv.innerHTML;
            responseDiv.innerHTML = "Pseudo : " + json[i].pseudo + "<br>" + originalContent;
        }
    }
    responseDiv.style.color = "red";
}
xhttp.send();