<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'im.php';
$img_pick = array_rand($img);
$colors = array('#007AFF','#FF7000','#FF7000','#15E25F','#CFC700','#CFC700','#CF1100','#CF00BE','#F00');
$color_pick = array_rand($colors);
?>

<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' >
<link rel="stylesheet" href="style.css">
<style type="text/css">

</style>
</head>
<body>
<div class="chat">
	<div class="chat-title">
		<h1 id="id_name"><?php echo $_SERVER["REMOTE_ADDR"]; ?></h1>
		<h2 id="id_title">devops</h2>
		<figure class="avatar">
			<img src="<?php echo $img[$img_pick]?>" /></figure>
	</div>
	<div class="messages" id="mess" style="text-align:center;overflow-y: auto;">

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
		var idname 		= response.idname; //color
		var ip = '<?php echo $_SERVER["REMOTE_ADDR"]; ?>'
		if (user_name) {
			var name = response.name;
		}else {
			var name = response.ip; //last update 08 07 2021 error in here send ip two
		}

		switch(res_type){
			case 'usermsg':
				// msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
				const nameinput=document.getElementById("name").value;
				if (nameinput) {
					document.getElementById('id_name').innerHTML = nameinput;
				}else {

					document.getElementById('id_name').innerHTML = ip;
				}
				//msgBox.append('<div><span class="message new" style="color:' + user_color + '">' + user_name + '</span> : <span class="timestamp">' + user_message + '</span></div>');

				msgBox.append('<div class="message new"><figure class="avatar"><img src="'+ava+'"></figure><div id="mss" onclick="copy(this)">' + user_message + '</div><div class="timestamp" style="color:'+user_color+'">'+ idname+'</div></div>');
				// document.getElementById('id_name').innerHTML = name;
				// document.getElementById('id_name').innerHTML = document.getElementById("name").value;
				// document.getElementById("name").style.display = "none";
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
		var idnamee = document.getElementById('id_name').textContent; //user name


		if(message_input.val() == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}

		//prepare json data
		var msg = {
			message: message_input.val(),
			name: name_input.val(),
			color : '<?php echo randomColour(); ?>',
			ava : '<?php echo $img[$img_pick]; ?>',
			idname : idnamee
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
		message_input.val(''); //reset message input
	}
</script>
</body>
</html>
