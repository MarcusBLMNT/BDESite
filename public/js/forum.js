//faire ça pour chaque catégorie
var div = document.getElementById("resultatAjax");


function getRSS(requete) {
    var rss = new XMLHttpRequest();
    rss.open('POST', '../public/js/para.php', true);
    rss.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rss.send("requete=" + requete);
    rss.onreadystatechange = function () {
        if (rss.readyState == 4) {
            if (rss.response != '0') {
                REP = JSON.parse(rss.response);
                REP.forEach(sujet => {
                    div.innerHTML += '<div id="sujet">' + sujet['nom'] + '</div>';
                });
            } else {
                div.innerHTML += "la requete $_POST est mal formulée"
            }
        }
    }

}




