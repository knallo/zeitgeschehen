USE db_zeitgeschehen;

--drop old data
DROP TABLE allgemein;
DROP TABLE workshops_zeit;
DROP TABLE workshops;
DROP TABLE autos;
DROP TABLE freitag;
DROP TABLE samstag;
DROP TABLE sonntag;
DROP TABLE montag;
DROP TABLE dienstag;
DROP TABLE intern;
DROP TABLE teilnehmer;

--create new tables
CREATE TABLE allgemein (
	anfangsdatum DATE NOT NULL,
	enddatum DATE NOT NULL,
	haus_oeffnungszeit DATETIME NOT NULL,
	haus_schliesszeit DATETIME NOT NULL,
	kosten_untere_schranke INT UNSIGNED NOT NULL,
	kosten_obere_schranke INT UNSIGNED NOT NULL,

	CONSTRAINT anfang_vor_ende CHECK (anfangsdatum < enddatum),
	CONSTRAINT oeffnen_vor_schliessen CHECK (haus_oeffnungszeit < haus_schliesszeit),
	CONSTRAINT kosten_schranken_korrekt CHECK (kosten_untere_schranke <= kosten_obere_schranke)
);

CREATE TABLE workshops_zeit (
	erste_schiene_anfang DATETIME NOT NULL,
	erste_schiene_erstes_zwischenende DATETIME NOT NULL,
	erste_schiene_erster_zwischenanfang DATETIME NOT NULL,
	erste_schiene_zweites_zwischenende DATETIME NOT NULL,
	erste_schiene_zweiter_zwischenanfang DATETIME NOT NULL,
	erste_schiene_ende DATETIME NOT NULL,
	zweite_schiene_anfang DATETIME NOT NULL,
	zweite_schiene_erstes_zwischenende DATETIME NOT NULL,
	zweite_schiene_erster_zwischenanfang DATETIME NOT NULL,
	zweite_schiene_zweites_zwischenende DATETIME NOT NULL,
	zweite_schiene_zweiter_zwischenanfang DATETIME NOT NULL,
	zweite_schiene_ende DATETIME NOT NULL,

	CONSTRAINT erste_schiene_anfang_vor_erstem_zwischenende CHECK (erste_schiene_anfang < erste_schiene_erstes_zwischenende),
	CONSTRAINT erste_schiene_erstes_zwischenende_vor_erstem_zwischenanfang CHECK (erste_schiene_erstes_zwischenende < erste_schiene_erster_zwischenanfang),
	CONSTRAINT erste_schiene_erster_zwischenanfang_vor_zweitem_zwischenende CHECK (erste_schiene_erster_zwischenanfang < erste_schiene_zweites_zwischenende),
	CONSTRAINT erste_schiene_zweites_zwischenende_vor_zweitem_zwischenanfang CHECK (erste_schiene_zweites_zwischenende < erste_schiene_zweiter_zwischenanfang),
	CONSTRAINT erste_schiene_zweiter_zwischenanfang_vor_ende CHECK (erste_schiene_zweiter_zwischenanfang < erste_schiene_ende),
	CONSTRAINT zweite_schiene_anfang_vor_erstem_zwischenende CHECK (zweite_schiene_anfang < zweite_schiene_erstes_zwischenende),
	CONSTRAINT zweite_schiene_erstes_zwischenende_vor_erstem_zwischenanfang CHECK (zweite_schiene_erstes_zwischenende < zweite_schiene_erster_zwischenanfang),
	CONSTRAINT zweite_schiene_erster_zwischenanfang_vor_zweitem_zwischenende CHECK (zweite_schiene_erster_zwischenanfang < zweite_schiene_zweites_zwischenende),
	CONSTRAINT zweite_schiene_zweites_zwischenende_vor_zweitem_zwischenanfang CHECK (zweite_schiene_zweites_zwischenende < zweite_schiene_zweiter_zwischenanfang),
	CONSTRAINT zweite_schiene_zweiter_zwischenanfang_vor_ende CHECK (zweite_schiene_zweiter_zwischenanfang < zweite_schiene_ende)
);

CREATE TABLE workshops (
	titel VARCHAR(255) NOT NULL,
	untertitel VARCHAR(255),
	einfuehrungstext VARCHAR(2500) NOT NULL,
	kuerzel VARCHAR(10) NOT NULL,
	ist_erste_schiene BOOLEAN NOT NULL,
	ist_zweite_schiene BOOLEAN NOT NULL,

	CONSTRAINT erste_oder_zweite_schiene CHECK (ist_erste_schiene XOR ist_zweite_schiene)
);

CREATE TABLE teilnehmer (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	geld INT UNSIGNED NOT NULL,
	essenswuensche VARCHAR(255),
	ueber_25 BOOLEAN,
	fahrerlaubnis BOOLEAN,
	mailadresse VARCHAR(255) NOT NULL,
	herkunftsort VARCHAR(255),
	marketing VARCHAR(255),
	sonstiges VARCHAR(255),

	CONSTRAINT ueber_25_nur_mit_fahrerlaubnis CHECK (fahrerlaubnis || !ueber_25),

	PRIMARY KEY(id)
);

CREATE TABLE autos (
	art VARCHAR(255) NOT NULL,
	nutzung VARCHAR(255) NOT NULL,
	telefonnummer VARCHAR(255) NOT NULL,
	teilnehmer_id INT UNSIGNED NOT NULL,

	CONSTRAINT fk_teilnemher_id
	FOREIGN KEY (teilnehmer_id) REFERENCES teilnehmer (id)
	ON DELETE CASCADE
	ON UPDATE RESTRICT
);

CREATE TABLE freitag (
	teilnehmer_id INT UNSIGNED NOT NULL UNIQUE,

	CONSTRAINT fk_teilnehmer_id_freitag
	FOREIGN KEY (teilnehmer_id) REFERENCES teilnehmer (id)
	ON DELETE CASCADE
	ON UPDATE RESTRICT
);

CREATE TABLE samstag (
	teilnehmer_id INT UNSIGNED NOT NULL UNIQUE,

	CONSTRAINT fk_teilnehmer_id_samstag
	FOREIGN KEY (teilnehmer_id) REFERENCES teilnehmer (id)
	ON DELETE CASCADE
	ON UPDATE RESTRICT
);

CREATE TABLE sonntag (
	teilnehmer_id INT UNSIGNED NOT NULL UNIQUE,

	CONSTRAINT fk_teilnehmer_id_sonntag
	FOREIGN KEY (teilnehmer_id) REFERENCES teilnehmer (id)
	ON DELETE CASCADE
	ON UPDATE RESTRICT
);

CREATE TABLE montag (
	teilnehmer_id INT UNSIGNED NOT NULL UNIQUE,

	CONSTRAINT fk_teilnehmer_id_montag
	FOREIGN KEY (teilnehmer_id) REFERENCES teilnehmer (id)
	ON DELETE CASCADE
	ON UPDATE RESTRICT
);

CREATE TABLE dienstag (
	teilnehmer_id INT UNSIGNED NOT NULL UNIQUE,

	CONSTRAINT fk_teilnehmer_id_dienstag
	FOREIGN KEY (teilnehmer_id) REFERENCES teilnehmer (id)
	ON DELETE CASCADE
	ON UPDATE RESTRICT
);

CREATE TABLE intern (
	teilnehmer_id INT UNSIGNED NOT NULL UNIQUE,

	CONSTRAINT fk_teilnehmer_id_intern
	FOREIGN KEY (teilnehmer_id) REFERENCES teilnehmer (id)
	ON DELETE CASCADE
	ON UPDATE RESTRICT
);

--insert test data
USE db_zeitgeschehen;

INSERT INTO allgemein VALUES (
	'2019-06-07',
	'2019-06-11',
	'2019-06-07 16:00',
	'2019-06-11 12:00',
	60,
	70
);

INSERT INTO workshops_zeit VALUES (
	'2019-06-08 11:00',
	'2019-06-08 14:00',
	'2019-06-08 17:00',
	'2019-06-08 20:00',
	'2019-06-09 11:00',
	'2019-06-09 14:00',
	'2019-06-09 17:00',
	'2019-06-09 20:00',
	'2019-06-10 11:00',
	'2019-06-10 14:00',
	'2019-06-10 17:00',
	'2019-06-10 20:00'
);

INSERT INTO workshops VALUES (
	"Erster Beispielworkshop",
	"Beispieluntertitel",
	"Das komische Zeichen am Ende dieses Satzes macht einen Zeilenumbruch.<br/> Will man etwas fett machen geht das so <b>fett</b>. Damit etwas kursiv ist greift man zu <em>kursiv</em>.",
	"EBW",
	True,
	False
);

INSERT INTO workshops (titel, einfuehrungstext, kuerzel, ist_erste_schiene, ist_zweite_schiene) VALUES (
	"Zweiter Beispielworkshop",
  "Das komische Zeichen am Ende dieses Satzes macht einen Zeilenumbruch.<br/> Will man etwas fett machen geht das so <b>fett</b>. Damit etwas kursiv ist greift man zu <em>kursiv</em>.",
	"ZBW",
	True,
	False
);

INSERT INTO workshops VALUES (
	"Dritter Beispielworkshop",
  "Beispieluntertitel",
  "Das komische Zeichen am Ende dieses Satzes macht einen Zeilenumbruch.<br/> Will man etwas fett machen geht das so <b>fett</b>. Damit etwas kursiv ist greift man zu <em>kursiv</em>.",
	"ANGST",
	False,
	True
);

INSERT INTO workshops VALUES (
	"Vierter Beispielworkshop",
  "Beispieluntertitel",
  "Das komische Zeichen am Ende dieses Satzes macht einen Zeilenumbruch.<br/> Will man etwas fett machen geht das so <b>fett</b>. Damit etwas kursiv ist greift man zu <em>kursiv</em>.",
	"DITTO",
	False,
	True
);
