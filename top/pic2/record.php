<?php
	$str = $_POST['kiroku'];
	$fileName = 'log/data.csv';
	// $fileName = 'log/test.csv';
	$fp = fopen($fileName, 'a');
	$csvData = mb_convert_encoding($str, "SJIS-win","UTF-8");
	fwrite($fp, $csvData."\n");
	fclose($fp);
	//=((C1/1000+32400)/86400+25569)
?>