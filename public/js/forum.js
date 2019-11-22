
var div = document.getElementById("resultatAjax");
div.innerHTML += 'la belle page';
getRSS();

function getRSS() {
    var rss = new XMLHttpRequest();
    rss.open('POST', '../public/js/para.txt', true);
    rss.send(null);
    rss.onreadystatechange = function () {
        if (rss.readyState == 4) {

            data = rss.responseText;
            var link = data;
            div.innerHTML += link;

        }
    }

}




