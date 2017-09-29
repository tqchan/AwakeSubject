<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title></title>
</head>
<!--Ajaxで指定エレメントの内容を書き換えるのサンプル-->
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
var moraArray = ['単語'];
var answerArray = ['回答'];
var timeArray = ['時間'];
var moraVal = "";
var answerValue = "";
var time;
var outArray = ['単語,回答,時間\n'];

$(function(){
	$('.button').click(function(){
		$('#container').load('readexcel7.php');
	});
});
function record(answerVal) {
	moraVal = document.getElementById('mora').value;
	answerValue = answerVal;
	var date = new Date();
	time = date.getTime();
	outArray.push(moraVal + "," + answerVal + "," + time + "\n");
	console.log(outArray);
	output(moraVal,answerVal,time);
}

function output(m,a,t) {
	var outStr = m + "," + a + "," + t;
		$.post(
			'record.php',
			{'kiroku' : outStr},
		);
}
</script>
<style type="text/css">
	#container{
		font-style: Meyrio;
		font-size: 2em;
	}
	.button {
		width: 5em;
		height: 2em;
	}
</style>
<body>

<div id="container">
	<?php
		$PHPExcel = include("readexcel7.php");
	?>
</div>
<div>
	<button class="button" onclick="record(0)">正答</button>
	<button class="button" onclick="record(1)">無反応</button>
	<button class="button" onclick="record(2)">錯語</button>
	<button class="button" onclick="record(3)">保続</button>
</div>
</body>
</html>