CREATE DATABASE db_zeitgeschehen;

USE db_zeitgeschehen;

-- table creation
CREATE TABLE allgemein (
	anfangsdatum DATE NOT NULL,
	enddatum DATE NOT NULL,
	haus_oeffnungsdatum DATE NOT NULL,
	haus_schliessdatum DATE NOT NULL,
	workshops_anzahl INT UNSIGNED NOT NULL,
	freitagsworkshops_anzahl INT UNSIGNED NOT NULL,
	sonntagsworkshops_anzahl INT UNSIGNED NOT NULL,
	kosten_untere_schranke INT UNSIGNED NOT NULL,
	kosten_obere_schranke INT UNSIGNED NOT NULL,

	CONSTRAINT anfang_vor_ende CHECK (anfangsdatum > enddatum),
	CONSTRAINT oeffnen_vor_schliessen CHECK (haus_oeffnungsdatum > haus_schliessdatum),
	CONSTRAINT workshops_anzahl_korrekt CHECK (workshops_anzahl = freitagsworkshops_anzahl + sonntagsworkshops_anzahl),
	CONSTRAINT freitag_anfang_vor_ende CHECK (freitagsschiene_anfangszeit < freitagsschiene_endzeit),
	CONSTRAINT sonntag_anfang_vor_ende CHECK (sonntagsschiene_anfangszeit < sonntagsschiene_endzeit),
	CONSTRAINT kosten_schranken_korrekt CHECK (kosten_untere_schranke <= kosten_obere_schranke)
);

CREATE TABLE workshops_zeit (
	freitagsschiene_anfang DATETIME NOT NULL,
	freitagsschiene_erstes_zwischenende DATETIME NOT NULL,
	freitagsschiene_erster_zwischenanfang DATETIME NOT NULL,
	freitagsschiene_zweites_zwischenende DATETIME NOT NULL,
	freitagsschiene_zweiter_zwischenanfang DATETIME NOT NULL,
	freitagsschiene_ende DATETIME NOT NULL,
	sonntagsschiene_anfang DATETIME NOT NULL,
	sonntagsschiene_erstes_zwischenende DATETIME NOT NULL,
	sonntagsschiene_erster_zwischenanfang DATETIME NOT NULL,
	sonntagsschiene_zweites_zwischenende DATETIME NOT NULL,
	sonntagsschiene_zweiter_zwischenanfang DATETIME NOT NULL,
	sonntagsschiene_ende DATETIME NOT NULL
);

CREATE TABLE workshops (
	titel VARCHAR(255) NOT NULL,
	untertitel VARCHAR(255),
	einfuehrungstext VARCHAR(2500) NOT NULL,
	kuerzel VARCHAR(10) NOT NULL,
	ist_freitag BOOLEAN NOT NULL,
	ist_sonntag BOOLEAN NOT NULL,

	CONSTRAINT freitag_oder_sonntag CHECK (ist_freitag XOR ist_sonntag) 
);

CREATE TABLE teilnehmer (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	geld INT UNSIGNED NOT NULL,
	essenswuensche VARCHAR(255),
	mailadresse VARCHAR(255) NOT NULL,
	herkunftsort VARCHAR(255) NOT NULL,
	marketing VARCHAR(255),
	sonstiges VARCHAR(255),

	PRIMARY KEY(id)
);

CREATE TABLE autos (
	art VARCHAR(255) NOT NULL,
	fahrerlaubnis VARCHAR(255) NOT NULL,
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
