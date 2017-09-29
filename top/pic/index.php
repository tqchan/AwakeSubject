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
      width: 30%;
    }
    .rec {
    width: 8em;
    height: 3em;
  }
  #recbt {
    margin: 1em;
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
	<div>
		<div>
			<input type="image" id="gazou1" src="img/slide6.JPG" value="1" name="pic_no" class="picdemo" onClick="rand1()">
		  <input type="image" id="gazou2" src="img/slide3.JPG" value="2" name="pic_no" class="picdemo" onClick="rand2()">
		  <input type="image" id="gazou3" src="img/slide1.jpg" value="3" name="pic_no" class="picdemo" onClick="rand3()">
		</div>
		<div>
			<input type="image" id="gazou4" src="img/slide5.JPG" value="4" name="pic_no" class="picdemo"  onClick="rand4()">
			<input type="image" id="gazou5" src="img/slide4.JPG" value="5" name="pic_no" class="picdemo"  onClick="rand5()">
			<input type="image" id="gazou6" src="img/slide2.JPG" value="6" name="pic_no" class="picdemo"  onClick="rand6()">
		</div>
	</div>
  <div id="audioRecBt">
    <h2>Recordings</h2>
      <ul id="recordingslist"></ul>
    <h2>Log</h2>
      <pre id="log"></pre>
  </div>
    <div>
    <!-- <a href="../index.php">top</a> -->
  </div>
</body>
</html>