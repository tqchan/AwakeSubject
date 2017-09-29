<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
	<title>index</title>
</head>
<script src="code.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script src="js/recorder.js"></script>
  <style type="text/css">
    .picdemo {
      width: 50%;
    }
    .rec {
    width: 8em;
    height: 3em;
  }
  #recbt {
    margin: 1em;
  }
  .button {
		width: 5em;
		height: 3em;
	}
	#audioRecBt {
		display: none;
	}
  </style>
<body>
	<div id="recbt">
		<button class="rec" name="pic_no" value="onsei" onClick="record(0);">音声</button>
		<!-- <button class="rec" onclick="startRecording(this);">record</button>
		<button class="rec" onclick="stopRecording(this);" disabled>stop</button> -->
	</div>
	<script type="text/javascript">
	function rand(no){
		// var pic_rand_no = Math.floor(Math.random()*(91-2)) + 2;
		var pic_rand_no = Math.floor(Math.random()*(38-1)) + 1;
		// console.log(pic_rand_no+":"+no);
		var picture = document.getElementById("gazou");
		picture.src = "../img/スライド (" + pic_rand_no + ").JPG";
		// picture.src = "img/スライド" + pic_rand_no + ".JPG";
		picture.value = pic_rand_no;
		var tmp = pic_rand_no + "," + no;
		record(tmp);
	}
	function pass(){
		// var pic_rand_no = Math.floor(Math.random()*(91-2)) + 2;
		var pic_rand_no = Math.floor(Math.random()*(38-1)) + 1;
		// console.log(pic_rand_no+":"+no);
		var picture = document.getElementById("gazou");
		picture.src = "../img/スライド (" + pic_rand_no + ").JPG";
		// picture.src = "img/スライド" + pic_rand_no + ".JPG";
		picture.value = pic_rand_no;
		var tmp = pic_rand_no + ",pass";
		record(tmp);
	}
	</script>
	<input type="image" id="gazou" src="img/スライド10.JPG" value="0" name="pic_no" class="picdemo" >
	<div>
	<button class="button" onclick="rand(0)">正答</button>
	<button class="button" onclick="rand(1)">無反応</button>
	<button class="button" onclick="rand(2)">錯語</button>
	<button class="button" onclick="rand(3)">保続</button>
	<button class="button" onclick="pass()">パス</button>
</div>
  <div id="audioRecBt">
    <h2>Recordings</h2>
      <ul id="recordingslist"></ul>
    <h2>Log</h2>
      <pre id="log"></pre>
  </div>
 <!--  <div>
  	<a href="../index.php">top</a>
  </div> -->
</body>
</html>