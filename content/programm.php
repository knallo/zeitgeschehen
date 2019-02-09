	<h1>
	Programm
</h1>

<?php
	include("includes/newsletter.php");
	printCalendar("desktop");
?>

<?php
	include("mysql/programm.php")
?>

<p>Wir besprechen in <?php echo $zahlwoerter[date('d', strtotime($workshopzeiten['zweite_schiene_ende'])) - date('d', strtotime($workshopzeiten['erste_schiene_anfang'])) + 1] ?> Tagen <?php echo $zahlwoerter[$anzahl_workshops] ?> Workshopthemen. Jedes der Themen wird <?php echo $zahlwoerter[3 * $slotlaenge] ?>stündig (drei mal <?php echo $zahlwoerter[$slotlaenge] ?> Stunden) behandelt - <?php echo $zahlwoerter[$anzahl_erste] ?> Themen werden <?php echo $wochentage[date('N', strtotime($workshopzeiten['erste_schiene_anfang'])) - 1] ?> und <?php echo $wochentage[date('N', strtotime($workshopzeiten['erste_schiene_zweiter_zwischenanfang'])) - 1] ?><?php echo vor_oder_nachmittag(date('H', strtotime($workshopzeiten['erste_schiene_zweiter_zwischenanfang']))) ?> behandelt, die <?php echo $zahlwoerter[$anzahl_zweite] ?> anderen <?php echo $wochentage[date('N', strtotime($workshopzeiten['zweite_schiene_anfang'])) - 1] ?><?php echo vor_oder_nachmittag(date('H', strtotime($workshopzeiten['zweite_schiene_anfang']))) ?> und <?php echo $wochentage[date('N', strtotime($workshopzeiten['zweite_schiene_zweiter_zwischenanfang'])) - 1] ?>.</p>
<p> </p>

<p>Das Haus ist geöffnet von <b><?php echo date('d.m.', $start) ?></b> bis <b><?php echo date('d.m.y', $end) ?></b></p>
<ol>
	<li>Die ersten <?php echo $zahlwoerter[$anzahl_erste] ?> Workshops gehen parallel von <b><?php echo date('d.m., H', strtotime($workshopzeiten['erste_schiene_anfang'])) ?> Uhr</b> bis <b><?php echo date('d.m., H', strtotime($workshopzeiten['erste_schiene_ende'])) ?> Uhr</b></li>
	<li>Die letzten <?php echo $zahlwoerter[$anzahl_zweite] ?> Workshops gehen parallel von <b><?php echo date('d.m., H', strtotime($workshopzeiten['zweite_schiene_anfang'])) ?> Uhr</b> bis <b><?php echo date('d.m., H', strtotime($workshopzeiten['zweite_schiene_ende'])) ?> Uhr</b></li>
</ol>

<h2><?php echo date('d.', strtotime($workshopzeiten['erste_schiene_anfang'])); ?>-<?php echo date('d.', strtotime($workshopzeiten['erste_schiene_ende'])); ?> <?php echo $monate[date('m', strtotime($workshopzeiten['erste_schiene_ende'])) - 1] ?></h2>
<table>
	<tbody>
		<tr>
			<?php
				foreach ($workshops_erste_schiene as &$workshop) {
					echo "<td>";
					echo "<h3 class='obertitel'>" . $workshop[0] . "</h3>";
					if ($workshop[1] != "") {
						echo "<h4 class='untertitel'>" . $workshop[1] . "</h4>";
					}
					echo "<p>" . $zeittext_erste_schiene . "</p>";
					echo $workshop[2];
				}
			 ?>
		</tr>
	</tbody>
</table>
<p> </p>
<h2><?php echo date('d.', strtotime($workshopzeiten['zweite_schiene_anfang'])); ?>-<?php echo date('d.', strtotime($workshopzeiten['zweite_schiene_ende'])); ?> <?php echo $monate[date('m', strtotime($workshopzeiten['zweite_schiene_ende'])) - 1] ?></h2>
<table>
	<tbody>
		<tr>
			<?php
				foreach ($workshops_zweite_schiene as &$workshop) {
					echo "<td>";
					echo "<h3 class='obertitel'>" . $workshop[0] . "</h3>";
					if ($workshop[1] != "") {
						echo "<h4 class='untertitel'>" . $workshop[1] . "</h4>";
					}
					echo "<p>" . $zeittext_zweite_schiene . "</p>";
					echo $workshop[2];
				}
			 ?>
		</tr>
	</tbody>
</table>
<?php
	printCalendar("mobile");
?>

<?php
	include("mysql/close.php");
?>
