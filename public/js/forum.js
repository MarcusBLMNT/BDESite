//faire ça pour chaque catégorie
var div = document.getElementById("resultatAjax");

var rss = new XMLHttpRequest();
rss.open('POST', '../public/js/para.php', true);
rss.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

function count() {


    rss.send("requete=count");
    rss.onreadystatechange = function () {
        if (rss.readyState == 4) {
            if (rss.response != '0') {
                categories = JSON.parse(rss.response);
                categories.forEach(categorie => {

                    div.innerHTML += '<div id="partie' + categorie['nom'] + '" class="col-md-6 col-xs-3"><div class="titre">' + categorie['nom'];
                    var nombrepages = getNbPages(categorie);
                    console.log(nombrepages);
                    document.getElementById('partie' + categorie['nom']).innerHTML += '<div class="boutonsPage">';
                    for (var i = 1; i <= nombrepages; i++) {
                        document.getElementById('partie' + categorie['nom']).innerHTML += '<button onclick=""> un bouton page</div>';
                    }
                    div.innerHTML += '</div></div>';
                });
            } else {
                div.innerHTML += "la requete $_POST est mal formulée"
            }
        }
    }


    function getNbPages(categorie) {
        var nombrepages = Math.trunc(parseInt(categorie['nbSujet'], 10) / 10);
        if (parseInt(categorie['nbSujet'], 10) / 10 > nombrepages) {
            nombrepages++;
        }
        return nombrepages;
    }
}

function getRSS(requete) {


    rss.send("requete=" + requete);
    rss.onreadystatechange = function () {
        if (rss.readyState == 4) {
            if (rss.response != '0') {
                categories = JSON.parse(rss.response);
                categories.forEach(sujet => {
                    div.innerHTML += '<div id="sujet">' + sujet['nom'] + '</div>';
                });
            } else {
                div.innerHTML += "la requete $_POST est mal formulée"
            }
        }
    }

}




