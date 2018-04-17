function getXMLHttpRequest() {
    var e = null;
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                e = new ActiveXObject("Msxml2.XMLHTTP")
            } catch (t) {
                e = new ActiveXObject("Microsoft.XMLHTTP")
            }
        } else {
            e = new XMLHttpRequest
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null
    }
    return e
}

var lastNotifs = undefined;
function actuBarre() {
    var e = getXMLHttpRequest();
    e.onreadystatechange = function() {
        if (e.readyState == 4 && (e.status == 200 || e.status == 0)) {
            document.getElementById("Barr").innerHTML = e.responseText;
            if (lastNotifs == undefined)
                lastNotifs = e.responseText;
            else if (lastNotifs != e.responseText) {
                lastNotifs = e.responseText;
                actuNotifs();
            }
        }
    };
    e.open("GET", "/includes/debut_ajax.php", true);
    e.send(null)
}
function actuNotifs() {
    var e = getXMLHttpRequest();
    e.onreadystatechange = function() {
        if (e.readyState == 4 && (e.status == 200 || e.status == 0))
            notifyMe("http://www.planete-toad.fr/images/avadefaut.png", e.responseText);
    };
    e.open("GET", "./js/newnotifs.php", true);
    e.send(null)
}
var xhr = getXMLHttpRequest();
setInterval("actuBarre()", 12e3);

document.addEventListener('DOMContentLoaded', function () {
    if (!Notification)
        return;
    if (Notification.permission !== "granted")
        Notification.requestPermission();
});


function notifyMe(image,texte) {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Planète Toad', {
      icon: image,
      body: texte
    });

    notification.onclick = function () {
      document.location.href = "http://www.planete-toad.fr/notifs.html";
      window.focus();
      notification.close();
      notification.cancel();
    };

  }

}