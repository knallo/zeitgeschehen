<?php
function wsTitel($obertitel, $untertitel) {
	?>
	<h1 class="obertitel">
		<?php
		echo $obertitel;
		?>
	</h1>
	<h2 class="untertitel">
		<?php
		echo $untertitel;
		?>
	</h2>
	<?php
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
					Samstag, den 3.6., von 11:00 Uhr bis 14:00 Uhr<br />
					sowie von 17:00 Uhr bis 20:00 Uhr,<br />
					und Sonntag, den 4.6., von 11:00 Uhr bis 14:00 Uhr.
				</em>
				<?php
			} else {
				?>
				<em>
					Sonntag, den 4.6., von 17:00 Uhr bis 20:00 Uhr,<br />
					und Pfingstmontag, den 5.6., von 11:00 Uhr bis 14:00 Uhr<br />
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