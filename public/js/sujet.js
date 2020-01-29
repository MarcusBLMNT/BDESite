function addNewComment(corps, createur, sujet, user) {

    var xml = new XMLHttpRequest();
    //ajouter un msg
    xml.open('POST', 'js/para.php', true);
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xml.send('requete=newComment&corps=' + corps + '&createur=' + createur + "&sujet=" + sujet);
    xml.onreadystatechange = function () {
        if (xml.readyState == 4) {

            //refresh la page
            refresh(sujet, user);
        }
    }
}

function refresh(sujet, user) {
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
                    textInHTML += ' <button onclick="signalerMessage(' + message['id'] + ',' + user + ')">signaler le message</button>';
                });
                div.innerHTML += textInHTML;
                div.scrollTop = div.scrollHeight - div.clientHeight;
            }
        }
    };
}



