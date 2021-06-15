<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$img = array('https://avatarbox.net/avatars/img10/porky_pig_concerned_avatar_picture_18020.jpg','https://avatarbox.net/avatars/img37/dancing_kid_avatar_picture_57685.gif');
include 'im.php';
$img_pick = array_rand($img);
$colors = array('#007AFF','#FF7000','#FF7000','#15E25F','#CFC700','#CFC700','#CF1100','#CF00BE','#F00');
$color_pick = array_rand($colors);
?>

<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' >
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<style type="text/css">
/*--------------------
Mixins
--------------------*/
/*--------------------
Body
--------------------*/
*,
*::before,
*::after {
	box-sizing: border-box;
}

html,
body {
	height: 100%;
}

body {
	background: linear-gradient(135deg, #044f48, #2a7561);
	background-size: cover;
	font-family: "Open Sans", sans-serif;
	font-size: 12px;
	line-height: 1.3;
	overflow: hidden;
}

.bg {
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	z-index: 1;
	background: url("https://images.unsplash.com/photo-1451186859696-371d9477be93?crop=entropy&fit=crop&fm=jpg&h=975&ixjsv=2.1.0&ixlib=rb-0.3.5&q=80&w=1925") no-repeat 0 0;
	filter: blur(80px);
	transform: scale(1.2);
}

/*--------------------
Chat
--------------------*/
.chat {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 300px;
	height: 80vh;
	max-height: 500px;
	z-index: 2;
	overflow: hidden;
	box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
	background: rgba(0, 0, 0, 0.5);
	border-radius: 20px;
	display: flex;
	justify-content: space-between;
	flex-direction: column;
}

/*--------------------
Chat Title
--------------------*/
.chat-title {
	flex: 0 1 45px;
	position: relative;
	z-index: 2;
	background: rgba(0, 0, 0, 0.2);
	color: #fff;
	text-transform: uppercase;
	text-align: left;
	padding: 10px 10px 10px 50px;
}
.chat-title h1, .chat-title h2 {
	font-weight: normal;
	font-size: 10px;
	margin: 0;
	padding: 0;
}
.chat-title h2 {
	color: rgba(255, 255, 255, 0.5);
	font-size: 8px;
	letter-spacing: 1px;
}
.chat-title .avatar {
	position: absolute;
	z-index: 1;
	top: 8px;
	left: 9px;
	border-radius: 30px;
	width: 30px;
	height: 30px;
	overflow: hidden;
	margin: 0;
	padding: 0;
	border: 2px solid rgba(255, 255, 255, 0.24);
}
.chat-title .avatar img {
	width: 100%;
	height: auto;
}

/*--------------------
Messages
--------------------*/
.messages {
	flex: 1 1 auto;
	color: rgba(255, 255, 255, 0.5);
	overflow: hidden;
	position: relative;
	width: 100%;
}
.messages .messages-content {
	position: absolute;
	top: 0;
	left: 0;
	height: 101%;
	width: 100%;
}
.messages .message {
	clear: both;
	float: left;
	padding: 6px 10px 7px;
	border-radius: 10px 10px 10px 0;
	background: rgba(0, 0, 0, 0.3);
	margin: 8px 0;
	font-size: 11px;
	line-height: 1.4;
	margin-left: 35px;
	position: relative;
	text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
}
.messages .message .timestamp {
	position: absolute;
	bottom: -15px;
	font-size: 9px;
	color: rgba(255, 255, 255, 0.3);
}
.messages .message::before {
	content: "";
	position: absolute;
	bottom: -6px;
	border-top: 6px solid rgba(0, 0, 0, 0.3);
	left: 0;
	border-right: 7px solid transparent;
}
.messages .message .avatar {
	position: absolute;
	z-index: 1;
	bottom: -15px;
	left: -35px;
	border-radius: 30px;
	width: 30px;
	height: 30px;
	overflow: hidden;
	margin: 0;
	padding: 0;
	border: 2px solid rgba(255, 255, 255, 0.24);
}
.messages .message .avatar img {
	width: 100%;
	height: auto;
}
.messages .message.message-personal {
	float: right;
	color: #fff;
	text-align: right;
	background: linear-gradient(120deg, #248A52, #257287);
	border-radius: 10px 10px 0 10px;
}
.messages .message.message-personal::before {
	left: auto;
	right: 0;
	border-right: none;
	border-left: 5px solid transparent;
	border-top: 4px solid #257287;
	bottom: -4px;
}
.messages .message:last-child {
	margin-bottom: 30px;
}
.messages .message.new {
	transform: scale(0);
	transform-origin: 0 0;
	-webkit-animation: bounce 500ms linear both;
					animation: bounce 500ms linear both;
}
.messages .message.loading::before {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	content: "";
	display: block;
	width: 3px;
	height: 3px;
	border-radius: 50%;
	background: rgba(255, 255, 255, 0.5);
	z-index: 2;
	margin-top: 4px;
	-webkit-animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
					animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
	border: none;
	-webkit-animation-delay: 0.15s;
					animation-delay: 0.15s;
}
.messages .message.loading span {
	display: block;
	font-size: 0;
	width: 20px;
	height: 10px;
	position: relative;
}
.messages .message.loading span::before {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	content: "";
	display: block;
	width: 3px;
	height: 3px;
	border-radius: 50%;
	background: rgba(255, 255, 255, 0.5);
	z-index: 2;
	margin-top: 4px;
	-webkit-animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
					animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
	margin-left: -7px;
}
.messages .message.loading span::after {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	content: "";
	display: block;
	width: 3px;
	height: 3px;
	border-radius: 50%;
	background: rgba(255, 255, 255, 0.5);
	z-index: 2;
	margin-top: 4px;
	-webkit-animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
					animation: ball 0.45s cubic-bezier(0, 0, 0.15, 1) alternate infinite;
	margin-left: 7px;
	-webkit-animation-delay: 0.3s;
					animation-delay: 0.3s;
}

/*--------------------
Message Box
--------------------*/
.message-box {
	flex: 0 1 40px;
	width: 100%;
	background: rgba(0, 0, 0, 0.3);
	padding: 10px;
	position: relative;
}
.message-box .message-input {
	background: none;
	border: none;
	outline: none !important;
	resize: none;
	color: rgba(255, 255, 255, 0.7);
	font-size: 11px;
	height: 17px;
	margin: 0;
	padding-right: 20px;
	width: 265px;
}
.message-box textarea:focus:-webkit-placeholder {
	color: transparent;
}
.message-box .message-submit {
	position: absolute;
	z-index: 1;
	top: 9px;
	right: 10px;
	color: #fff;
	border: none;
	background: #248A52;
	font-size: 10px;
	text-transform: uppercase;
	line-height: 1;
	padding: 6px 10px;
	border-radius: 10px;
	outline: none !important;
	transition: background 0.2s ease;
}
.message-box .message-submit:hover {
	background: #1D7745;
}

/*--------------------
Custom Srollbar
--------------------*/
.mCSB_scrollTools {
	margin: 1px -3px 1px 0;
	opacity: 0;
}

.mCSB_inside > .mCSB_container {
	margin-right: 0px;
	padding: 0 10px;
}

.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
	background-color: rgba(0, 0, 0, 0.5) !important;
}

/*--------------------
Bounce
--------------------*/
@-webkit-keyframes bounce {
	0% {
		transform: matrix3d(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	4.7% {
		transform: matrix3d(0.45, 0, 0, 0, 0, 0.45, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	9.41% {
		transform: matrix3d(0.883, 0, 0, 0, 0, 0.883, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	14.11% {
		transform: matrix3d(1.141, 0, 0, 0, 0, 1.141, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	18.72% {
		transform: matrix3d(1.212, 0, 0, 0, 0, 1.212, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	24.32% {
		transform: matrix3d(1.151, 0, 0, 0, 0, 1.151, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	29.93% {
		transform: matrix3d(1.048, 0, 0, 0, 0, 1.048, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	35.54% {
		transform: matrix3d(0.979, 0, 0, 0, 0, 0.979, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	41.04% {
		transform: matrix3d(0.961, 0, 0, 0, 0, 0.961, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	52.15% {
		transform: matrix3d(0.991, 0, 0, 0, 0, 0.991, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	63.26% {
		transform: matrix3d(1.007, 0, 0, 0, 0, 1.007, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	85.49% {
		transform: matrix3d(0.999, 0, 0, 0, 0, 0.999, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	100% {
		transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
}
@keyframes bounce {
	0% {
		transform: matrix3d(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	4.7% {
		transform: matrix3d(0.45, 0, 0, 0, 0, 0.45, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	9.41% {
		transform: matrix3d(0.883, 0, 0, 0, 0, 0.883, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	14.11% {
		transform: matrix3d(1.141, 0, 0, 0, 0, 1.141, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	18.72% {
		transform: matrix3d(1.212, 0, 0, 0, 0, 1.212, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	24.32% {
		transform: matrix3d(1.151, 0, 0, 0, 0, 1.151, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	29.93% {
		transform: matrix3d(1.048, 0, 0, 0, 0, 1.048, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	35.54% {
		transform: matrix3d(0.979, 0, 0, 0, 0, 0.979, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	41.04% {
		transform: matrix3d(0.961, 0, 0, 0, 0, 0.961, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	52.15% {
		transform: matrix3d(0.991, 0, 0, 0, 0, 0.991, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	63.26% {
		transform: matrix3d(1.007, 0, 0, 0, 0, 1.007, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	85.49% {
		transform: matrix3d(0.999, 0, 0, 0, 0, 0.999, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
	100% {
		transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	}
}
@-webkit-keyframes ball {
	from {
		transform: translateY(0) scaleY(0.8);
	}
	to {
		transform: translateY(-10px);
	}
}
@keyframes ball {
	from {
		transform: translateY(0) scaleY(0.8);
	}
	to {
		transform: translateY(-10px);
	}
}





.chat-wrapper {
	font: bold 11px/normal 'lucida grande', tahoma, verdana, arial, sans-serif;
    background: #00a6bb;
    padding: 20px;
    margin: 20px auto;
    box-shadow: 2px 2px 2px 0px #00000017;
	max-width:700px;
	min-width:500px;
}
#message-box {
    width: 97%;
    display: inline-block;
    height: 300px;
    background: #fff;
    box-shadow: inset 0px 0px 2px #00000017;
    overflow: auto;
    padding: 10px;
}
.user-panel{
    margin-top: 10px;
}
input[type=text]{
    border: none;
    padding: 5px 5px;
    box-shadow: 2px 2px 2px #0000001c;
}
input[type=text]#name{
    width:20%;
}
input[type=text]#message{
    width:60%;
}
button#send-message {
    border: none;
    padding: 5px 15px;
    background: #11e0fb;
    box-shadow: 2px 2px 2px #0000001c;
}

/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
</head>
<body>
<div class="chat">
	<div class="chat-title">
		<h1 id="id_name">Donquixote Doflamingo</h1>
		<h2 id="id_title">devops</h2>
		<figure class="avatar">
			<img src="<?php echo $img[$img_pick]?>" /></figure>
	</div>
	<div class="messages" id="mess" style="text-align:center;overflow-y: auto;">

<!-- <div id="message-box" class="messages-content"></div></div> -->

</div>
<div class="user-panel message-box">
<input type="text" class="message-input" name="name" id="name" placeholder="Name"/>
<input type="text" class="message-input" name="message" id="message" placeholder="Type your message here..." />
<button id="send-message" class="message-submit">Send</button>
</div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
function copy(e){

alert(e.innerHTML)
 }
</script>
<script language="javascript" type="text/javascript">
// document.getElementById("mss").onclick = function(){
// 	// copyText.select();
//   // copyText.setSelectionRange(0, 99999); /* For mobile devices */
// 	//
//   // document.execCommand("copy");
//
//   alert("Copied the text: " + document.getElementById("mss").value);
// }
	//create a new WebSocket object.
	// var msgBox = $('#message-box');
	var msgBox = $('#mess');
	var wsUri = "ws://192.168.4.203:9000/demo/server.php";
	websocket = new WebSocket(wsUri);

	websocket.onopen = function(ev) { // connection is open
		// msgBox.append('<div class="system_msg" style="color:#bbbbbb">Welcome to my "Demo WebSocket Chat box"!</div>'); //notify user
		msgBox.append('<spanstyle="color:#bbbbbb">Welcome to my "WebSocket Chat box"!</span>'); //notify user
// msgbox.append('<div class="message new"><figure class="avatar"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/156381/profile/profile-80.jpg"></figure>Hi there, Im Donquixote and you?<div class="timestamp">15:28</div></div>')

	}
	// Message received from server
	websocket.onmessage = function(ev) {
		var response 		= JSON.parse(ev.data); //PHP sends Json data

		var res_type 		= response.type; //message type
		var user_message 	= response.message; //message text
		var user_name 		= response.name; //user name
		var user_color 		= response.color; //color
		var ips 		= response.ip; //color
		var ava 		= response.ava; //color
		var ip = '<?php echo $_SERVER["REMOTE_ADDR"]; ?>'
		if (user_name) {
			var name = response.name;
		}else {
			var name = response.ip;
		}

		switch(res_type){
			case 'usermsg':
				// msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
				//msgBox.append('<div><span class="message new" style="color:' + user_color + '">' + user_name + '</span> : <span class="timestamp">' + user_message + '</span></div>');

				msgBox.append('<div class="message new"><figure class="avatar"><img src="'+ava+'"></figure><div id="mss" onclick="copy(this)">' + user_message + '</div><div class="timestamp" style="color:'+user_color+'">'+ name+'</div></div>');
				document.getElementById('id_name').innerHTML = name;
				document.getElementById('id_title').style.display = "none";

				break;
			case 'system':
				msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
				break;
		}
		msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message

	};

	websocket.onerror	= function(ev){ msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>'); };
	websocket.onclose 	= function(ev){ msgBox.append('<div class="system_msg">Connection Closed</div>'); };

	//Message send button
	$('#send-message').click(function(){
		send_message();
	});

	//User hits enter key
	$( "#message" ).on( "keydown", function( event ) {
	  if(event.which==13){
		  send_message();
	  }
	});

	//Send message
	function send_message(){
		var message_input = $('#message'); //user message text
		var name_input = $('#name'); //user name


		if(message_input.val() == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}

		//prepare json data
		var msg = {
			message: message_input.val(),
			name: name_input.val(),
			color : '<?php echo $colors[$color_pick]; ?>',
			ava : '<?php echo $img[$img_pick]; ?>'
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
		message_input.val(''); //reset message input
	}
</script>
</body>
</html>
