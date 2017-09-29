<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
	<title>index</title>
	<script src="code.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- <link href="style.css" rel="stylesheet" type="text/css"> -->
    <style type="text/css">
    	.picdemo {
    		width: 30%;
    	}
    </style>
</head>
<body>
<!--<form name="myTime" action="https://script.google.com/macros/s/AKfycbw6OfcQH1-lUs3HmDR78GYaJ7ihqddJDvaRTuv4W-dcR2um2Bc/exec">
-->
<form name="myTime">
<!--
log file location
https://docs.google.com/spreadsheets/d/19kCUQ4PlDM5oOV6kHGXdZgT33GUERHAmnDTBpntrgOY/edit?usp=sharing
-->
	<div>
		<button name="pic_no" value="onsei" onClick="kakunin();validateForm()">音声データ</button>
		<button onclick="startRecording(this);">record</button>
		<button onclick="stopRecording(this);" disabled>stop</button>
	</div>

	<div>
		unixtime：
		<input type="text" size="40" name="timestamp">
		<script type="text/javascript">
			setInterval("nowUnixtime()",1000);
		</script>
	</div>
	<div>
  <script type="text/javascript">
			$('.picdemo').click(function(){
        var selectNo = $(this).val();
        alert(selectNo);
      });
  </script>
		<div>
			<input type="image" src="./slide6.JPG" value="1" name="pic_no" class="picdemo">
			<input type="image" src="./slide3.JPG" value="2" name="pic_no" onClick="kakunin();validateForm()" class="picdemo">
			<input type="image" src="./slide1.jpg" value="3" name="pic_no" onClick="kakunin();validateForm()" class="picdemo">
		</div>
		<div>
			<input type="image" src="./slide5.JPG" value="4" name="pic_no" onClick="kakunin();validateForm()" class="picdemo">
			<input type="image" src="./slide4.JPG" value="5" name="pic_no" onClick="kakunin();validateForm()" class="picdemo">
			<input type="image" src="./slide2.JPG" value="6" name="pic_no" onClick="kakunin();validateForm()" class="picdemo">
		</div>
</form>
</div>
<div>
	<h2>Recordings</h2>
  	<ul id="recordingslist"></ul>
	<h2>Log</h2>
  	<pre id="log"></pre>
  	<script type="text/javascript">
  	var audioNo = 1;
//録音のスクリプト
function __log(e, data) {
    log.innerHTML += "\n" + e + " " + (data || '');
  }
	var audio_context;
	var recorder;
	function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.');
    // Uncomment if you want the audio to feedback directly
    //input.connect(audio_context.destination);
    //__log('Input connected to audio context destination.');
    
    recorder = new Recorder(input);
    __log('Recorder initialised.');
  }
  function startRecording(button) {
    recorder && recorder.record();
    button.disabled = true;
    button.nextElementSibling.disabled = false;
    __log('Recording...');
  }
  function stopRecording(button) {
    recorder && recorder.stop();
    button.disabled = true;
    button.previousElementSibling.disabled = false;
    __log('Stopped recording.');
    
    // create WAV download link using audio data blob
    createDownloadLink();
    
    recorder.clear();
  }

  function createDownloadLink() {
    recorder && recorder.exportWAV(function(blob) {
      var url = URL.createObjectURL(blob);
      var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');
      au.controls = true;
      au.src = url;
      hf.href = url;
      // hf.id = 'audio' + audioNo;
      var audioName = new Date().toLocaleString() + '.wav';
      // hf.download = new Date().toLocaleString() + '.wav';
      hf.download = audioName;
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);
    //   $.post(
    //   'save.php',
    //   {'saveaudio' : blob},
    // );
    });
    // var audioClick = document.getElementById('audio' + audioNo).click();
    //   audioNo++;
    
  }

  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
      window.URL = window.URL || window.webkitURL;
      
      audio_context = new AudioContext;
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }
    
    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
  };

  </script>
  <script src="js/recorder.js"></script>
</div>
</body>
</html>