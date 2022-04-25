let peerConnection;
const config = {
	iceServers: [
		{
			"urls": "stun:stun.l.google.com:19302",
		},
	]
};

const socket = io.connect('https://server.ncdeliteveterans.org:8080');
const video = document.querySelector("#my_video");
const enableAudioButton = document.querySelector("#enable-audio");
const message = document.querySelector("#broadcating_wait");
const broadcating_video = document.querySelector("#broadcating_video");
const Brocast_Soc = document.querySelector("#Brocast_Soc");
 

enableAudioButton.addEventListener("click", enableAudio)

socket.on("offer", (id, description) => { 
	peerConnection = new RTCPeerConnection(config);
	peerConnection
		.setRemoteDescription(description)
		.then(() => peerConnection.createAnswer())
		.then(sdp => peerConnection.setLocalDescription(sdp))
		.then(() => {
			message.style.display = 'none';
			broadcating_video.style.display = 'block';
			socket.emit("answer", id, peerConnection.localDescription);
		});
	peerConnection.ontrack = event => {	    
		video.srcObject = event.streams[0];
	};
	peerConnection.onicecandidate = event => {
		if (event.candidate) {
			socket.emit("candidate", id, event.candidate);
		}
	};
});


socket.on("candidate", (id, candidate) => {
	peerConnection
		.addIceCandidate(new RTCIceCandidate(candidate))
		.catch(e => console.error(e));
});

socket.on("connect", () => {
	socket.emit("watcher");
});

socket.on("broadcaster", () => {
	socket.emit("watcher");
});

socket.on('getFlag', function(ret) {
    console.log('getFlag',ret);
	ret = parseInt(ret); 
	if(ret == 1){
	    broadcating_video.style.display = 'block';
	    message.style.display = 'none';
	    Brocast_Soc.style.display = 'none';
	}else if(ret == 2){
	    broadcating_video.style.display = 'none';
	    message.style.display = 'none';
	    Brocast_Soc.style.display = 'block';
	}else{
	    broadcating_video.style.display = 'none';
	    message.style.display = 'block';
	    Brocast_Soc.style.display = 'none';
	}
});

window.onunload = window.onbeforeunload = () => {
	socket.close();
	peerConnection.close();
};

function enableAudio() {
	console.log("Enabling audio")
	video.muted = false;
}
