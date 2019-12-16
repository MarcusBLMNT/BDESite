//faire ça pour chaque catégorie
var div = document.getElementById("resultatAjax");

function init(idRole) {

    var rss = new XMLHttpRequest();
    rss.open('POST', 'js/para.php', true);
    rss.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rss.send("requete=count");
    rss.onreadystatechange = function () {
        if (rss.readyState == 4) {
            if (rss.response != '0') {
                categories = JSON.parse(rss.response);
                categories.forEach(categorie => {
                    printTitreCategorie(categorie);
                    document.getElementById('partie' + categorie['nom']).innerHTML += '<div id="sujets' + categorie['nom'] + '"></div>';
                    setSujets(idRole, categorie['nom'], 0, 10);
                    printBoutonsPage(idRole, categorie);
                });
            }
            else {
                div.innerHTML += "la requete $_POST est mal formulée";
            }
        }
    }

}

function setSujets(idRole, categorieAct, offset, limit) {
    var rss2 = new XMLHttpRequest();
    rss2.open('POST', 'js/para.php', true);
    rss2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rss2.send('requete=sujets&offset=' + offset + '&limit=' + limit + "&categorie=" + categorieAct);
    rss2.onreadystatechange = function () {
        if (rss2.readyState == 4) {
            if (rss2.response != '0') {
                console.log(rss2.response);
                sujets = JSON.parse(rss2.response);
                var textInHtml = ' <form method="GET" action="../public/indexSujet.php"><table>';
                sujets.forEach(sujet => {

                    if (sujet['prive'] == '1' && idRole < 2) {

                        textInHtml += '<tr>Sujet privé!</tr>';
                    } else {
                        textInHtml += '<tr><td><button id="boutonsujet" value="' + sujet['id'] + '" name=sujet>' + sujet['nom'] + '</button></td><td>|'
                            + sujet['auteur'] + '</td><td>|' + sujet['date'] + '</td><td>|' + sujet['nbmessages'] + '</td><td>|' + sujet['auteurDernierMessage'] + '</td><td>|' + sujet['dateDernierMessage'] + '</td></tr>';

                    }
                });
                textInHtml += '</table></form>';
                document.getElementById('sujets' + categorieAct).innerHTML = textInHtml;

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

function printBoutonsPage(idRole, categorie) {
    var nombrepages = getNbPages(categorie);
    document.getElementById('partie' + categorie['nom']).innerHTML += '<div id="boutonsPage'
        + categorie['nom'] + '"></div>';
    for (var i = 1; i <= nombrepages; i++) {
        var offset = 10 * i - 10;
        var temp = '<button onclick=setSujets(' + idRole + ',"' + categorie['nom'] + '",' + offset + ',10)>' + i + '</div>';
        document.getElementById('boutonsPage' + categorie['nom']).innerHTML += temp;
    }
    div.innerHTML += '</div></div>';
}






