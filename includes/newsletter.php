<?php
function printNewsletter($page) {
	?>
	<div class="newsletter">
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
?>