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

function markMenu(title, initial=false) {
	var last = document.getElementById("lastSelected");
	if (last) {
		last.removeAttribute("id");	
	}

	var item = document.querySelector("li[onclick*=" + title + "]")
	item.id = "lastSelected";		
	if (window.matchMedia("(max-width: 820px)").matches && initial) {
		menu = item.parentNode;
		menu.insertBefore(item, menu.firstChild);
	}

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

function showMenu() {
	var menu = document.querySelector('header').querySelector('ul');
	if (menu.className === "responsive") {
		menu.removeAttribute('class');
		var selected = menu.querySelector("li#lastSelected");
		if (selected) {
			menu.insertBefore(selected, menu.firstChild);
		}
	} else {
		button = menu.querySelector("li#menu-button");
		menu.firstChild.parentNode.insertBefore(button, menu.firstChild.nextSibling);
		menu.className = "responsive";
	}
}
