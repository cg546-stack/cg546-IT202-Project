function getRealTime() {
    var domshirttypes     = document.getElementById("shirttypecount");
    var domshirts         = document.getElementById("shirtcount");
    var dombuypricetotal  = document.getElementById("buypricetotal");
    var domsellpricetotal = document.getElementById("sellpricetotal");

    var request = new XMLHttpRequest();
    request.open("GET", "realtime.php", true);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var xmldoc = request.responseXML;

            var xmlshirttypes = xmldoc.getElementsByTagName("shirttypes")[0];
            var shirttypes = xmlshirttypes.childNodes[0].nodeValue;

            var xmlshirts = xmldoc.getElementsByTagName("shirts")[0];
            var shirts = xmlshirts.childNodes[0].nodeValue;

            var xmlbuypricetotal = xmldoc.getElementsByTagName("buypricetotal")[0];
            var buypricetotal = xmlbuypricetotal.childNodes[0].nodeValue;

            var xmlsellpricetotal = xmldoc.getElementsByTagName("sellpricetotal")[0];
            var sellpricetotal = xmlsellpricetotal.childNodes[0].nodeValue;

            domshirttypes.innerHTML    = shirttypes;
            domshirts.innerHTML        = shirts;
            dombuypricetotal.innerHTML  = buypricetotal;
            domsellpricetotal.innerHTML = sellpricetotal;
        }
    };
    request.send();
}