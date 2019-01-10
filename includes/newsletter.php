<?php
function printNewsletter($page, $appearence) {
	?>
	<div class="littleBox newsletter <?php echo $appearence; ?>">
		<p>
			Willst auf dem Laufenden bleiben? Hier kannst du dich in den Newsletter eintragen (du kannst dich jederzeit wieder austragen):
		</p>
		<form action="?p=<?php echo $page; ?>&newsletter=true" method="post">
			<input type="mail" name="mail" placeholder="beispiel@mail.de">
			<input type="submit" name="newsletterAbs" value="Newsletter abonnieren">
		</form>

		<?php
		if (!empty($_POST['newsletterAbs'])) {
			$to1 = 'zeitgeschehen-subscribe@lists.riseup.net';
			$to2 = 'zeitgeschehen@riseup.net';
			$subject = 'Eintrag auf Verteiler';
			$message = 'Bitte folgende Mail auf den Verteiler aufnehmen: ' . $_POST['mail'];
			$headers = 'From: ' . $_POST['mail'] . "\r\n" .
			    'Reply-To: ' . $_POST['mail'] . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			if (mail($to1, $subject, $message, $headers) &&
				mail($to2, $subject, $message, $headers)) {
				echo "<div class='alert'>Deine Adresse wurde gespeichert.</div>";
			}
		}
		?>
	</div>
	<?php
}

function printCalendar($appearence) {
	?>
	<div class="littleBox newsletter <?php echo $appearence; ?>">
		<p><strong>NEU: </strong><br />
			Ab sofort gibt es 
			<a href="https://zeitgeschehen.net/uploads/zeitgeschehen-kalender_2018.ics" target="blank" alt="Kalender-Datei für alle Workshops beim Argumente gegen das Zeitgeschehen 2018">hier</a> 
			eine .ics-Datei für die automatische Eintragung der Workshops in deinen Kalender. Einfach Datei herunterladen und öffnen.</p>
	</div>
	<?php
}
?>