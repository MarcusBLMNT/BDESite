var xhttp = new XMLHttpRequest();
xhttp.open('GET', "http://localhost/BDESite2/git/BDESite/public/api/apiphp/apiListerUtilisateur.php", true);
xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4) {
        console.log(xhttp.responseText);
    }
}
xhttp.send();