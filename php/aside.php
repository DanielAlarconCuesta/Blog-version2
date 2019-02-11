<?php
	function loadAside() {
		$years = returnsYearsOfPosts();

		echo "<ul>";
		for ($i=0; $i<count($years); $i++) {
			$auxYear = $years[$i];
			echo "<li><h4><a href='index.php?year=$auxYear'>".$auxYear."</a></h4>";
				echo "<ul>";
				$months = returnsMonthsOfAYearOfPosts($auxYear);
					for ($j=0; $j<count($months); $j++) {
						$auxMonth = $months[$j];
						$dateObj   = DateTime::createFromFormat('!m', $auxMonth);
						$auxMonthName = $dateObj->format('F');
						echo "<li><a href='index.php?year=$auxYear&month=$auxMonth'>$auxMonthName</a></li>";
					}

				echo "</ul>";

			echo "</li>";
		}
		echo "</ul>";
	}
?>

<aside class="col-sm-2 col-xs-11">
	<?php loadAside(); ?>
</aside>
