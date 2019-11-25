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
                console.log(rss.response);
                categories = JSON.parse(rss.response);
                categories.forEach(categorie => {

                    printTitreCategorie(categorie);

                    div.innerHTML += '<div id="sujets' + categorie['nom'] + '"></div>';
                    // var sujetDeLaPage = reponsegetFromBdd('sujets', 0, 10);
                    // sujetDeLaPage.forEach(sujet => {
                    //     document.getElementById("sujets" + categorie['nom']).innerHTML += '<div id="sujet' + sujet['nom'] + '">' + sujet['nom'] + '</div>';
                    // });









                    printBoutonsPage(getNbPages, categorie);
                });
            } else {
                div.innerHTML += "la requete $_POST est mal formulée";
            }

        }
    }
    var sujets = new XMLHttpRequest();
    sujets.open('POST', '../public/js/para.php', true);
    sujets.send("requete=count");

    sujets.onreadystatechange = function () {

        if (sujets.readyState == 4) {
            console.log("readystate=" + sujets.readyState + " response=" + sujets.response);
            console.log(sujets.response);
            console.log('0');
            // return "la requete $_POST est mal formulée";

        } else {
            console.log(sujets.readyState);
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

function printBoutonsPage(getNbPages, categorie) {
    var nombrepages = getNbPages(categorie);
    document.getElementById('partie' + categorie['nom']).innerHTML += '<div id="boutonsPage'
        + categorie['nom'] + '"></div>';
    for (var i = 1; i <= nombrepages; i++) {
        document.getElementById('boutonsPage' + categorie['nom']).innerHTML += '<button onclick="">' + i + '</div>';
    }
    div.innerHTML += '</div></div>';
}






