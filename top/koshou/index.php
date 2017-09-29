<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title></title>
</head>
<style type="text/css">
  ul { list-style: none; }
  #recordingslist audio { display: block; margin-bottom: 10px; }
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

</script>
<body>
  <div id="recbt">
    <!-- <button class="rec" onclick="startRecording(this);">record</button>
  	<button class="rec" onclick="stopRecording(this);" disabled>stop</button> -->
  </div>
  <div>
  	<table>
  		<tr>
  			<th><a href="3mora.php" target="inline">3モーラ</a></th>
  			<th><a href="4mora.php" target="inline">4モーラ</a></th>
  			<th><a href="5mora.php" target="inline">5モーラ</a></th>
  			<th><a href="6mora.php" target="inline">6モーラ</a></th>
  			<th><a href="7mora.php" target="inline">7モーラ</a></th>
  		</tr>
  	</table>
  	<iframe src="3mora.php" name="inline"></iframe>
  </div>
  <div id="audioRecBt">
	<h2>Recordings</h2>
  	<ul id="recordingslist"></ul>
	<h2>Log</h2>
  	<pre id="log"></pre>
    </div>
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
      var audioName = new Date().toLocaleString() + '.wav';
      hf.download = audioName;
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);
    });
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
  <div>
    <!-- <a href="../index.php">top</a> -->
  </div>
</body>
</html>