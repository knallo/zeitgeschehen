USE db_zeitgeschehen;

INSERT INTO allgemein VALUES (
	'2019-06-07',
	'2019-06-10',
	'2019-06-07',
	'2019-06-10',
	4,
	2,
	2,
	60,
	70
);

INSERT INTO workshops_zeit VALUES (
	'2019-06-07 11:00',
	'2019-06-07 14:00',
	'2019-06-07 17:00',
	'2019-06-07 20:00',
	'2019-06-08 11:00',
	'2019-06-08 14:00',
	'2019-06-08 17:00',
	'2019-06-08 20:00',
	'2019-06-09 11:00',
	'2019-06-09 14:00',
	'2019-06-09 17:00',
	'2019-06-09 20:00'
);

INSERT INTO workshops VALUES (
	"Transnistrische Eisenbahngesellschaften",
	"und der Stand ihrer Entwicklung",
	"Ein kurzer Einblick in die Entwicklung der transnistrischen Eisenbahngesellschaften.<br/> Dazu gehört natürlich <strong>eine</strong> Versagerin und <strong>ein</strong> Versager.",
	"TNE",
	True,
	False
);

INSERT INTO workshops (titel, einfuehrungstext, kuerzel, ist_freitag, ist_sonntag) VALUES (
	"Vielbeschworene Wirkungen",
	"Gibt es nur wenn die Revolution durchgeführt wird! <br/> Der abermalige Beweis <br/> ihrer Notwendigkeit ist für mich keiner!",
	"VW",
	True,
	False
);

INSERT INTO workshops VALUES (
	"Angenommen",
	"alle diese Workshops",
	"gäbe es wirklich?",
	"ANGST",
	False,
	True
);

INSERT INTO workshops VALUES (
	"Das",
	"wars",
	"dann aber auch mal",
	"DITTO",
	False,
	True
);

INSERT INTO teilnehmer (
	name,
	geld,
	essenswuensche,
	mailadresse,
	herkunftsort,
	marketing,
	sonstiges
)
VALUES (
	"tobias",
	90,
	NULL,
	"meine@mailadresse.de",
	"bremen",
	NULL,
	NULL
),(
	"kill_i_am",
	10,
	"all of the food",
	"thebest@trump.de",
	"bremen",
	NULL,
	NULL
),(
	"anton",
	100000,
	NULL,
	"thebest@trump.de",
	"bremen",
	"wat den noch",
	NULL
),(
	"anna lena baerenäum",
	10,
	NULL,
	"all@ofthelights.com",
	"bremen",
	NULL,
	"daswarsdennabernu"
),(
	"is this the real me?",
	10,
	"all of the food",
	"wat@watwat.de",
	"bremen",
	"hace fyou ever been my hero",
	"no i have not"
),(
	"mystery girl",
	10,
	"none of the food",
	"thebest@moneycan.buy",
	"berlin",
	NULL,
	NULL
),(
	"ist this mein reich?",
	10,
	NULL,
	"gau@land.de",
	"bremen",
	NULL,
	"nein"
);

INSERT INTO autos VALUES (
	"großer sedan",
	"jeder über 25",
	"0900fickmich",
	1
),(
	"kleiner sedan",
	"nur ich",
	"0900fickmich",
	1
),(
	"garkein sedan",
	"darf er das?",
	"0800jadarfer",
	2
);

INSERT INTO freitag VALUES (1);
INSERT INTO samstag VALUES (1), (2);
INSERT INTO sonntag VALUES (3);
INSERT INTO montag VALUES (4);
