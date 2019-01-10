<h2>blabla</h2>

<?php
//echo "wsstruktur";
function wsTitel($obertitel, $untertitel) {
	?>
	<h1 class="obertitel">
		<?php
		echo $obertitel;
		?>
	</h1>
	?>
	if (!empty($untertitel)) {
		?>
		<h2 class="untertitel">
			<?php
			echo $untertitel;
			?>
		</h2>
		<?php
	}
}

function wsZeiten($zeit) {
	?>
	<div class="workshopzeiten">
		<p class="wszeitueberschrift">
			Der Workshop erstreckt sich über drei Teile:<br />
		</p>
		<p>
			<?php
			if ($zeit == 1) {
				?>
				<em>
					Samstag, den 19.5., von 11:00 Uhr bis 14:00 Uhr<br />
					sowie von 17:00 Uhr bis 20:00 Uhr<br />
					und Sonntag, den 20.5., von 11:00 Uhr bis 14:00 Uhr.
				</em>
				<?php
			} elseif ($zeit == 2) {
				?>
				<em>
					Sonntag, den 20.5., von 17:00 Uhr bis 20:00 Uhr<br />
					und Pfingstmontag, den 21.5., von 11:00 Uhr bis 14:00 Uhr<br />
					sowie von 17:00 Uhr bis 20:00 Uhr.
				</em>
				<?php
			}
			?>
		</p>
	</div>
	<?php
}
?>