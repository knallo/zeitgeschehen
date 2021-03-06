var PAGES = ['allgemeines', 'programm', 'haus', 'kosten', 'anfahrt', 'anmeldung', 'kontakt', 'impressum'];
var WORKSHOPS = ['klima', 'trump', 'kritik', 'bge', 'demonstrationsfreiheit'];
var ORDER = {allgemein:"programm", programm:"haus", haus:"kosten", kosten:"anfahrt", anfahrt:"anmeldung", anmeldung:"kontakt", kontakt:"impressum", impressum:"show"};
var maxWidthOnMobile = "650px";

function manipulateCSS(tag, property) {
	var stylesheet = document.styleSheets[0];
	if (stylesheet.insertRule) {
	    stylesheet.insertRule(tag + property, stylesheet.cssRules.length);
	} else if (stylesheet.addRule) {
	    stylesheet.addRule(tag, property, -1);
	}
}

function changeBackgroundColors(page, workshop) {
	var color;
	if (!workshop) {
		if (page == "allgemeines") {
			color = "#cce5f4";
		} else if (page == "programm") {
			color = "#f3d8e0";
		} else if (page == "haus") {
			color = "#d1e8d4";
		} else if (page == "kosten") {
			color = "#fffcd9";
		} else if (page == "anfahrt") {
			color = "#f3d8e0";
		} else if (page == "anmeldung") {
			color = "#cce5f4";
		} else if (page == "kontakt") {
			color = "#fddec8";
		} else {
			color = "#cce5f4";
		}
	} else {
		if (page == "trump") {
			color = "#cce5f4";
		} else if (page == "bge") {
			color = "#d1e8d4";
		} else if (page == "kritik") {
			color = "#fffcd9";
		} else if (page == "klima") {
			color = "#fddec8";
		} else if (page == "demonstrationsfreiheit") {
			color = "#cce5f4";
		}
	}
	// manipulateCSS(".pace-progress", "{background-color: " + color + "}");
	manipulateCSS("body", "{background-color: " + color + "}");
	manipulateCSS("a:hover", "{color: " + color + "}");
	manipulateCSS("input[type=submit]:hover", "{color: " + color + "}");
}

function makeJsLinkVisible() {
	manipulateCSS(".jsLink", "{display: inline}");
}

function loadPage(title, isBack=false) {
	if (!PAGES.includes(title)) {
		title = "404"
	} else {
		markMenu(title);
	}

	changeBackgroundColors(title, false);

	var article = document.querySelector('article');
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			article.innerHTML = this.responseText;
			if (!isBack) {
				history.pushState({title: title, isPage: true}, title, "?p=" + title);
			}
			makeJsLinkVisible();
			toggleMenu();
		}
	}

	xhttp.open("GET", "../content/" + title + ".php", true);
	xhttp.send();
}

function loadWorkshop(title, isBack=false) {
	if (!WORKSHOPS.includes(title)) {
		loadPage('404');
		return;
	} else {
		markMenu('programm');
	}

	changeBackgroundColors(title, true);

	var article = document.querySelector('article');
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			html = this.responseText;
			html += "<br /><a onclick='loadPage(\"programm\")'>zurück zum Programm</a>";
			article.innerHTML = html;
			if (!isBack) {
				history.pushState({title: title, isWorkshop: true}, title, "?workshop="+title);
			}
			makeJsLinkVisible();
		}
	}

	xhttp.open("GET", "../content/workshop-" + title + ".php", true);
	xhttp.send();
}

window.onload = function makeMenuCollapsedOnMobile() {
	if (window.matchMedia("(max-width: "+maxWidthOnMobile+")").matches) {
		document.querySelector("header").querySelector("ul").className = "responsive";
	}

	makeJsLinkVisible();
	var url = window.location.href.split("=");
	var workshop;
	if (url[0].split("?")[1] == "workshop") {
		workshop = true;
	} else {
		workshop = false;
	}
	changeBackgroundColors(window.location.href.split("=")[1], workshop);
}

function markMenu(title, initial=false) {
	var last = document.querySelector("a[class=lastSelected]");
	if (last) {
		last.removeAttribute("class");
	}

	title = title !== "impressum" ? title : "kontakt";
	var item = document.getElementById(title);
	item.className = "lastSelected";
	if (window.matchMedia("(max-width: "+maxWidthOnMobile+")").matches) {
		button = document.getElementById("menu-button");
		if (initial) {
			item.parentNode.insertBefore(item, item.parentNode.firstChild);
			item.parentNode.insertBefore(button, item.parentNode.firstChild.nextElementSibling);
		} else {
			item.parentNode.insertBefore(button, item.parentNode.firstChild.nextElementSibling.nextElementSibling);
		}
	}

}

window.addEventListener("popstate", function (event) {
	if (event.state == null) {
		return;
	}
	console.log(event.state.title);
	if (event.state.isPage) {
		loadPage(event.state.title, true);
	} else if (event.state.isWorkshop) {
		loadWorkshop(event.state.title, true);
	} else {
		loadPage("404", true);
	}
});

// Details zum Auto nur anzeigen, wenn der Mensch ein Auto hat
function autofrage() {
	var autoform = document.getElementById("autofrage");
	var besitztAuto = document.getElementById("besitztAuto");
	var besitztKeinAuto = document.getElementById("besitztKeinAuto");
	var autoInputs = autoform.querySelectorAll("input");

	if (besitztKeinAuto.checked){
	    autoform.className = "hidden";
			for (let input of autoInputs) {
				input.removeAttribute("required");
			}
	} else if (besitztAuto.checked) {
	    autoform.className = "visible";
			for (let input of autoInputs) {
				input.setAttribute("required", "");
			}
	}
}

// Man muss sich für mindestens einen Tag anmelden
function mindestens_ein_tag() {
	var checkboxes = document.querySelectorAll("input[type=checkbox]");
	var is_one_checked = false;

	for (let checkbox of checkboxes) {
		if (checkbox.checked) {
			is_one_checked = true;
		}
	}

	for (let checkbox of checkboxes) {
		if (is_one_checked) {
			checkbox.removeAttribute("required");
		} else {
			checkbox.setAttribute("required", "");
		}
	}
}

function insertInOrder(element) {
	if (ORDER[element.id]) {
		var menu = document.querySelector('header').querySelector('ul');
		menu.insertBefore(element, document.getElementById(ORDER[element.id]));
	}
}

function toggleMenu() {
	if (window.matchMedia("(max-width: "+maxWidthOnMobile+")").matches) {
		showMenu();
	}
}

function showMenu() {
	var menu = document.querySelector('header').querySelector('ul');
	var button = menu.querySelector('a#menu-button');
	var selected = menu.querySelector('a.lastSelected');

	if (menu.className != "responsive") {
		//button.innerHTML = "⇊";
		menu.className = "responsive";
		menu.insertBefore(selected, menu.firstChild);
		menu.insertBefore(button, selected.nextElementSibling);
	} else {
		//button.innerHTML = "⇈";
		menu.removeAttribute("class");
		insertInOrder(selected);
		menu.insertBefore(button, document.getElementById("programm"));
	}
}

if (window.matchMedia) {
	var query = window.matchMedia("(min-width: "+maxWidthOnMobile+")");
	query.addListener(function changeMenu(mq) {
		if (mq.matches) {
			document.querySelector('header').querySelector('ul').className = "responsive";
		}
		showMenu();
	});

}

// Anmeldungen

function toggleTag(el) {
	var nextEl = el.nextElementSibling;
	if (nextEl.style.display == "none") {
		nextEl.style.display = "block";
	} else {
		nextEl.style.display = "none";
	}
}
