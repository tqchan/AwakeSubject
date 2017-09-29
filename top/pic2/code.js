var date;
var unixTimestamp;

function nowUnixtime(){
    // Dateオブジェクトを作成 (引数なし)
    date = new Date();
    // 現在のUNIX時間を取得する (秒単位)
    unixTimestamp = Math.floor(date.getTime());
}

function output(value) {
	    var outStr = value;
		  $.post(
			  'record.php',
			  {'kiroku' : outStr},
		  );
    }

function record(val){
	nowUnixtime();
	var time = unixTimestamp;
	// console.log(val + ":" + time);
	var str = val + "," + time;
	output(str);
}

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