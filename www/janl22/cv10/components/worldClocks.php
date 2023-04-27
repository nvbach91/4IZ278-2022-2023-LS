<?php

$timeZones = [
	'Australia/Sydney' => 'Sydney',
	'Asia/Tokyo' => 'Tokyo',
	'Europe/London' => 'London',
	'America/New_York' => 'Washington, D.C.',
	'Europe/Prague' => 'Prague'
];

$dateTimeFormat = 'd.m.Y H:i:s';
try {
	$pragueDateTime = new DateTime('now', new DateTimeZone('Europe/Prague'));
} catch (Exception $e) {
}

?>

<h4 class="mb-4">World Clocks</h4>
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center mb-4">
	<?php foreach ($timeZones as $timeZone => $timeZoneCity): ?>
		<?php
		try {
			$zoneDateTime = new DateTime('now', new DateTimeZone($timeZone));
		} catch (Exception $e) {
		}
		$offsetFromPrague = $zoneDateTime->getOffset() - $pragueDateTime->getOffset();
		$offset = sprintf('%+d hours', $offsetFromPrague / 3600);
		?>
		<div class="col mb-3">
			<div class="card h-100">
				<div class="card-body p-4">
					<div class="text-center">
						<h6 class="fw-bolder"><?php echo $timeZoneCity ?></h6>
						<?php echo $zoneDateTime->format($dateTimeFormat); ?>
						<br>Offset: <?php echo $offset; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>