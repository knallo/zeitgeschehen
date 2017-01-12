function loadPage(title) {
	var last = document.getElementById("lastSelected");
	if (last) {
		last.removeAttribute("id");	
	}

	var legal_names = ['allgemeines', 'programm', 'haus', 'kosten', 'anfahrt', 'anmeldung', 'kontakt'];
	if (!legal_names.includes(title)) {
		title = "404"
	} else {
		document.querySelector("li[onclick*=" + title + "]").id = "lastSelected";		
	}
	var article = document.querySelector('article');
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			article.innerHTML = this.responseText;
		}
	}
	
	xhttp.open("GET", "../content/" + title + ".inc", true);
	xhttp.send();
}
