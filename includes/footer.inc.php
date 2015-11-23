<div id="footer">
	<p>
	&copy;
	<?php
	$libName = "HyperCube OJ";
	$start_year = 2015;
	ini_set('date.timezone', 'Asia/Kolkata');
	$year = date('Y');
	if($start_year == $year)
		echo " $year ";
	else
		echo " {$start_year}-{$year} ";
	echo $libName;
    ?>
	</p>
</div>
