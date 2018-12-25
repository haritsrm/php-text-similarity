<?php
	if (isset($_POST['ta1'])) {
	    $string1 = $_POST['ta1'];
	    $string2 = $_POST['ta2'];
	    require("phpCompareStrings.inc.php");
	    $phpCompareStrings = new PhpCompareStrings($string2, $string1);
	    $percent = $phpCompareStrings->getSimilarityPercentage();
	    $percent2 = $phpCompareStrings->getDifferencePercentage();
	    echo '<p>Kalimat pertama dan kedua memiliki kemiripan = ' . $percent . '% dan perbedaan ' . $percent2 . '%</p>';
	}
?>