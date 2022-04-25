const peerConnections = {};
const config = {
  iceServers: [
    {
      "urls": "stun:stun.l.google.com:19302",
    },
  ]
};
// Get camera and microphone
const videoElement = document.querySelector("video");
const audioSelect = document.querySelector("select#audioSource");
const videoSelect = document.querySelector("select#videoSource"); 
 
const stopCamera = document.querySelector("#stopCamera"); 

var broadcasting_status  = 0;
var broadcasting_audio = true;
var broadcasting_video  = true;
var socket = null;
 
//stopCamera.addEventListener("click", stopVideoOnly)
 

function microInit(){
	var vox = VoxImplant.getInstance();
		vox.addEventListener(VoxImplant.Events.SDKReady, function(e) { vox.connect(); });
		vox.addEventListener(VoxImplant.Events.MicAccessResult, onMicAccessResult);

		vox.init({
			micRequired: true
		});

		function onMicAccessResult(e) {	
			if (e.result) createMicActivityIndicator(e.stream);
		}

		function createMicActivityIndicator(stream) {

			var audioContext = new AudioContext(),
				analyser = audioContext.createAnalyser(),
				microphone = audioContext.createMediaStreamSource(stream),
				javascriptNode = audioContext.createScriptProcessor(2048, 1, 1);

			analyser.smoothingTimeConstant = 0.3;
			analyser.fftSize = 1024;

			microphone.connect(analyser);
			analyser.connect(javascriptNode);
			javascriptNode.connect(audioContext.destination);

			var ctx = document.getElementById("mic_activity").getContext("2d");

			javascriptNode.onaudioprocess = function() {
				var array =  new Uint8Array(analyser.frequencyBinCount);
				analyser.getByteFrequencyData(array);
				var values = 0,
					length = array.length;

				for (var i = 0; i < length; i++) values += array[i];

				var average = values / length;
				ctx.clearRect(0, 0, 30, 150);
				var grad = ctx.createLinearGradient(1,1,28,148);
				grad.addColorStop(0,"#FF0000");
				grad.addColorStop(0.5, "yellow");
				grad.addColorStop(1,"#00FF00");
				ctx.fillStyle=grad;
				ctx.fillRect(1,148-average,28,148);
			}

		}
} 

function start(){
	if(broadcasting_audio){
		microInit();
		broadcasting_audio = false;
	}
	socket = io.connect('https://server.ncdeliteveterans.org:8080');
    
    start_broadcasting();
	videoElement.style.display = 'inline-block';
	stopCamera.style.display = 'inline-block'; 
	
}

function stop(){
     broadcasting_video = 0;
    socket.emit('setFlag',broadcasting_video);
    setTimeout(function(){ socket.close();},2000);
    
	 if (window.stream) {
		window.stream.getTracks().forEach(track => {
		  track.stop();
		});
	 }
	 videoElement.srcObject =  null;
	 $('#currentUser').text("");
	 removeStatus();
	 //videoElement.style.display = 'none';
}

function start_broadcasting(){
	
	broadcasting_video = 1;
	socket.emit('setFlag',broadcasting_video);
	
	socket.on("answer", (id, description) => {
		 
	  peerConnections[id].setRemoteDescription(description);
	});

	socket.on("watcher", id => {
	  const peerConnection = new RTCPeerConnection(config);
	  peerConnections[id] = peerConnection;

	  let stream = videoElement.srcObject;
	  stream.getTracks().forEach(track => peerConnection.addTrack(track, stream));

	  peerConnection.onicecandidate = event => {
		if (event.candidate) {
		  socket.emit("candidate", id, event.candidate);
		}
	  };

	  peerConnection
		.createOffer()
		.then(sdp => peerConnection.setLocalDescription(sdp))
		.then(() => {
		  socket.emit("offer", id, peerConnection.localDescription);
		});
	});

	socket.on("candidate", (id, candidate) => {
	  peerConnections[id].addIceCandidate(new RTCIceCandidate(candidate));
	});
	
	socket.on('getFlag', function(ret) {
	  console.log("Video Flag:", ret);
	});

	socket.on("disconnectPeer", id => {
	  peerConnections[id].close();
	  delete peerConnections[id];
	});

	window.onunload = window.onbeforeunload = () => {
	  socket.close();
	};
 
	audioSelect.onchange = getStream;
	videoSelect.onchange = getStream;

	getStream()
	  .then(getDevices)
	  .then(gotDevices);
	  
}

function getDevices() {
  return navigator.mediaDevices.enumerateDevices();
}

function gotDevices(deviceInfos) {
  window.deviceInfos = deviceInfos;
  for (const deviceInfo of deviceInfos) {
    const option = document.createElement("option");
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === "audioinput") {
      option.text = deviceInfo.label || `Microphone ${audioSelect.length + 1}`;
      audioSelect.appendChild(option);
    } else if (deviceInfo.kind === "videoinput") {
      option.text = deviceInfo.label || `Camera ${videoSelect.length + 1}`;
      videoSelect.appendChild(option);
    }
  }
}

function getStream() {
  if (window.stream) {
    window.stream.getTracks().forEach(track => {
      track.stop();
    });
  }
  const audioSource = audioSelect.value;
  const videoSource = videoSelect.value;
  const constraints = {
    audio: { deviceId: audioSource ? { exact: audioSource } : undefined },
    video: { deviceId: videoSource ? { exact: videoSource } : undefined }
  };
  return navigator.mediaDevices
    .getUserMedia(constraints)
    .then(gotStream)
    .catch(handleError);
}

function gotStream(stream) {
  window.stream = stream;
  audioSelect.selectedIndex = [...audioSelect.options].findIndex(
    option => option.text === stream.getAudioTracks()[0].label
  );
  videoSelect.selectedIndex = [...videoSelect.options].findIndex(
    option => option.text === stream.getVideoTracks()[0].label
  );
  videoElement.srcObject = stream;
  socket.emit("broadcaster");
}

 
// stop only camera
function stopVideoOnly() {
	let stream = videoElement.srcObject;
    stream.getTracks().forEach(function(track) {
        if (track.readyState == 'live' && track.kind === 'video') {
            track.stop();
        }
    }); 
 
	stopCamera.style.display = 'none';
	
	broadcasting_video = 2;
	socket.emit('setFlag',broadcasting_video);
	
}
 

function handleError(error) {
  console.error("Error: ", error);
}