function addNewComment(corps, createur, sujet) {
    console.log(corps + sujet + createur);
    var xml = new XMLHttpRequest();
    //ajouter un msg
    xml.open('POST', 'js/para.php', true);
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xml.send('requete=newComment&corps=' + corps + '&createur=' + createur + "&sujet=" + sujet);
    xml.onreadystatechange = function () {
        if (xml.readyState == 4) {

            //refresh la page
            var xml2 = new XMLHttpRequest();
            xml2.open('POST', 'js/para.php', true);
            xml2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xml2.send('requete=getComment&sujet=' + sujet);

            xml2.onreadystatechange = function () {
                if (xml2.readyState == 4) {
                    if (xml2.response != '0') {
                        var messages = JSON.parse(xml2.response);

                        var textInHTML = '';
                        var div = document.getElementById('messages');

                        div.innerHTML = '';
                        messages.forEach(message => {
                            textInHTML += '<div class="message">' + message['datemsg'] + ' ' + message['corps'] + ' (' + message['pseudo'] + ')';
                        });
                        div.innerHTML += textInHTML;
                        div.scrollTop = div.scrollHeight - div.clientHeight;

                    }

                }
            }
        }
    }
}


