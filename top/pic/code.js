var date;
var unixTimestamp;
var picvalue = 0;

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
	console.log(val + ":" + time);
	var str = val + "," + time;
	output(str);
}

function rand1(){
  picvalue = document.getElementById("gazou1").value;
  console.log(picvalue+": rand1");
  record(picvalue);
  rand();
}

function rand2(){
  picvalue = document.getElementById("gazou2").value;
  console.log(picvalue+": rand2");
  record(picvalue);
  rand();
}

function rand3(){
  picvalue = document.getElementById("gazou3").value;
  console.log(picvalue+": rand3");
  record(picvalue);
  rand();
}

function rand4(){
  picvalue = document.getElementById("gazou4").value;
  console.log(picvalue+": rand4");
  record(picvalue);
  rand();
}

function rand5(){
  picvalue = document.getElementById("gazou5").value;
  console.log(picvalue+": rand5");
  record(picvalue);
  rand();
}

function rand6(){
  picvalue = document.getElementById("gazou6").value;
  console.log(picvalue+": rand6");
  record(picvalue);
  rand();
}


function rand(){
    var pic_rand_no1 = Math.floor(Math.random()*(92-2)) + 2; //max-min min
    var pic_rand_no2 = Math.floor(Math.random()*(92-2)) + 2; //max-min min
    var pic_rand_no3 = Math.floor(Math.random()*(92-2)) + 2; //max-min min
    var pic_rand_no4 = Math.floor(Math.random()*(92-2)) + 2; //max-min min
    var pic_rand_no5 = Math.floor(Math.random()*(92-2)) + 2; //max-min min
    var pic_rand_no6 = Math.floor(Math.random()*(92-2)) + 2; //max-min min
    // console.log(pic_rand_no+":"+no);
    var picture1 = document.getElementById("gazou1");
    var picture2 = document.getElementById("gazou2");
    var picture3 = document.getElementById("gazou3");
    var picture4 = document.getElementById("gazou4");
    var picture5 = document.getElementById("gazou5");
    var picture6 = document.getElementById("gazou6");
    picture1.src = "img/スライド" + pic_rand_no1 + ".JPG";
    picture1.value = pic_rand_no1;
    picture2.src = "img/スライド" + pic_rand_no2 + ".JPG";
    picture2.value = pic_rand_no2;
    picture3.src = "img/スライド" + pic_rand_no3 + ".JPG";
    picture3.value = pic_rand_no3;
    picture4.src = "img/スライド" + pic_rand_no4 + ".JPG";
    picture4.value = pic_rand_no4;
    picture5.src = "img/スライド" + pic_rand_no5 + ".JPG";
    picture5.value = pic_rand_no5;
    picture6.src = "img/スライド" + pic_rand_no6 + ".JPG";
    picture6.value = pic_rand_no6;
    // picture6.click = rand6;
    // var tmp = pic_rand_no + ",";
    // record(tmp);
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