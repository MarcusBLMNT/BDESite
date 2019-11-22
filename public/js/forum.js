
var div = document.getElementById("resultatAjax");
div.innerHTML += 'la belle page';
getRSS('sujets');

function getRSS(requete) {
    console.log(requete);
    var rss = new XMLHttpRequest();
    rss.open('POST', '../public/js/para.php', true);
    rss.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    rss.send("requete=" + requete);
    rss.onreadystatechange = function () {
        if (rss.readyState == 4) {

            data = rss.responseText;
            var link = JSON.parse(data);
            console.log(link);
            div.innerHTML += '<div id=unSujet">' + link[0]['nom'] + '</div>';

        }
    }

}




