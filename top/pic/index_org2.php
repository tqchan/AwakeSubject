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
    .rec {S
    width: 8em;
    height: 3em;
  }
  #recbt {
    margin: 1em;
  }
  </style>
<body>
	<div id="recbt">
		<button class="rec" name="pic_no" value="onsei" onClick="record(0);">音声</button>
		<button class="rec" onclick="startRecording(this);">record</button>
		<button class="rec" onclick="stopRecording(this);" disabled>stop</button>
	</div>
	<div>
		<div>
			<input type="image" src="./slide6.JPG" value="1" name="pic_no" class="picdemo" onClick="record(1)">
		    <input type="image" src="./slide3.JPG" value="2" name="pic_no" class="picdemo" onClick="record(2)">
		    <input type="image" src="./slide1.jpg" value="3" name="pic_no" class="picdemo" onClick="record(3)">
		</div>
		<div>
			<input type="image" src="./slide5.JPG" value="4" name="pic_no" class="picdemo"  onClick="record(4)">
			<input type="image" src="./slide4.JPG" value="5" name="pic_no" class="picdemo"  onClick="record(5)">
			<input type="image" src="./slide2.JPG" value="6" name="pic_no" class="picdemo"  onClick="record(6)">
		</div>
	</div>
  <div>
    <h2>Recordings</h2>
      <ul id="recordingslist"></ul>
    <h2>Log</h2>
      <pre id="log"></pre>
  </div>
    <div>
    <a href="../index.php">top</a>
  </div>
</body>
</html>