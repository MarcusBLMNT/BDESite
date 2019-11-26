//faire ça pour chaque catégorie
var div = document.getElementById("resultatAjax");



function init() {


    getTitleFromBdd();



}


function getTitleFromBdd() {
    var rss = new XMLHttpRequest();
    rss.open('POST', 'js/para.php', true);
    rss.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rss.send("requete=count");
    rss.onreadystatechange = function () {
        if (rss.readyState == 4) {
            if (rss.response != '0') {
                console.log(rss.response);
                categories = JSON.parse(rss.response);
                categories.forEach(categorie => {
                    printTitreCategorie(categorie);
                    document.getElementById('partie' + categorie['nom']).innerHTML += '<div id="sujets' + categorie['nom'] + '"></div>';
                    setSujets(categorie, 0, 10);
                    printBoutonsPage(categorie);
                });
            }
            else {
                div.innerHTML += "la requete $_POST est mal formulée";
            }
        }
    }

}

function setSujets(categorieAct, offset, limit) {
    var rss2 = new XMLHttpRequest();
    rss2.open('POST', 'js/para.php', true);
    rss2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rss2.send('requete=sujets&offset=' + offset + '&limit=' + limit + "&categorie=" + categorieAct['nom']);
    rss2.onreadystatechange = function () {
        if (rss2.readyState == 4) {
            if (rss2.response != '0') {
                console.log(rss2.response);
                sujets = JSON.parse(rss2.response);
                sujets.forEach(sujet => {
                    document.getElementById('sujets' + categorieAct['nom']).innerHTML += '<div id="sujet">' + sujet['nom'] + '</div>';

                });
            }
            else {

            }
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


function printTitreCategorie(categorie) {
    div.innerHTML += '<div id="partie' + categorie['nom'] + '" class="col-md-6 col-xs-3"><div class="titre">' + categorie['nom'];
}

function printBoutonsPage(categorie) {
    var nombrepages = getNbPages(categorie);
    document.getElementById('partie' + categorie['nom']).innerHTML += '<div id="boutonsPage'
        + categorie['nom'] + '"></div>';
    for (var i = 1; i <= nombrepages; i++) {
        document.getElementById('boutonsPage' + categorie['nom']).innerHTML += '<button onclick="">' + i + '</div>';
    }
    div.innerHTML += '</div></div>';
}






