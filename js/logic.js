function loadPage(title, isBack=false) {
	var legal_names = ['allgemeines', 'programm', 'haus', 'kosten', 'anfahrt', 'anmeldung', 'kontakt'];
	if (!legal_names.includes(title)) {
		title = "404"
	} else {
		markMenu(title);
	}

	var article = document.querySelector('article');
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			article.innerHTML = this.responseText;
			if (!isBack) {
				history.pushState({title: title}, title, "?p=" + title);
			}
		}
	}
	
	xhttp.open("GET", "../content/" + title + ".inc", true);
	xhttp.send();
}

function markMenu(title) {
	var last = document.getElementById("lastSelected");
	if (last) {
		last.removeAttribute("id");	
	}

	document.querySelector("li[onclick*=" + title + "]").id = "lastSelected";		
}

window.addEventListener("popstate", function (event) {
	if (event.state == null) {
		return;
	}
	loadPage(event.state.title, true);
});

// Details zum Auto nur anzeigen, wenn der Mensch ein Auto hat
function autofrage() {
	var autoform = document.getElementById("autofrage");
	var besitztAuto = document.getElementById("besitztAuto");
	var besitztKeinAuto = document.getElementById("besitztKeinAuto");

	if (besitztKeinAuto.checked){
	    autoform.className = "hidden";
	} else if (besitztAuto.checked) {
	    autoform.className = "visible";
	}
}
