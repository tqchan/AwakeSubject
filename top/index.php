<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
	<title>test</title>
</head>
<style type="text/css">
#iframe{
  width: 80%;
  height: 40em;
}
.rec {
    width: 8em;
    height: 3em;
  }
</style>
<body>
  <script src="recorder.js"></script>
<script type="text/javascript">
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
<div>
<button class="rec" onclick="startRecording(this);">record</button>
<button class="rec" onclick="stopRecording(this);" disabled>stop</button>
<p><a href="./koshou" target="inline2">復唱</a></p>
<p><a href="./pic" target="inline2">画像選択</a></p>
<p><a href="./pic2/" target="inline2">画像選択　ランダム</a></p>
</div>
<div id="iframe">
<iframe src="./koshou" name="inline2" width="80%" height="80%">
  
</iframe>
</div>
<div>
    <h2>Recordings</h2>
      <ul id="recordingslist"></ul>
    <h2>Log</h2>
      <pre id="log"></pre>
  </div>
</body>
</html>