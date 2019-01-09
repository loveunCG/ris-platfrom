<script src="<?=base_url()?>assets/global/scripts/socket.io.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/Vchat/dev/getHTMLMediaElement.css">
<link rel="stylesheet" href="<?=base_url()?>assets/Vchat/css/stylesheet.css">
<script src="<?=base_url()?>assets/Vchat/dist/RTCMultiConnection.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/Vchat/dev/adapter.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/Vchat/dev/getHTMLMediaElement.js" type="text/javascript"></script>
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-md-12">

				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption font-green-sharp">
							<i class="icon-share font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> 影像远程会诊</span>
						</div>
						<div class="actions">
							<div class="btn-group btn-group-devided" data-toggle="buttons">
								<label class="btn btn-circle btn-transparent grey-salsa active">
									<input type="radio" name="options" class="toggle" id="option1">Today</label>
								<label class="btn btn-circle btn-transparent grey-salsa">
									<input type="radio" name="options" class="toggle" id="option2">Week</label>
								<label class="btn btn-circle btn-transparent grey-salsa">
									<input type="radio" name="options" class="toggle" id="option2">Month</label>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<section class="make-center">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-large btn-icon-only default" class="" id="open-room">
									<i class="fa fa-user"></i>
								</a>
								<a href="javascript:;" id="join-room" class="btn btn-icon-only red">
									<i class="fa fa-edit"></i>
								</a>
								<button href="javascript:;" id="chatting_open" class="btn btn-circle btn-icon-only yellow">
									<i class="fa fa-lg fa-wechat"></i>
								</button>
							</div>
							<input type="hidden" id="room-id" value="<?=$room_id?>" size=20>
							<div id="room-urls" class="alert-success" style="text-align: center;display: none;background: #F1EDED;margin: 15px -10px;border: 1px solid rgb(189, 189, 189);border-left: 0;border-right: 0;"></div>
							<div class="row">
								<div class="col-md-12">
									<div id="videos-container"></div>
								</div>
							</div>
						</section>
					</div>
				</div>

			</div>

		</div>


	</div>
</div>
<input type="hidden" id="is_roomJoin" value="<?=$is_roomJoin?>">
<input type="hidden" id="user_name" value="<?=$this->session->userdata('usr_name')?>">
<script>
	window.enableAdapter = true; // enable adapter.js
	// ......................................................
	// .......................UI Code........................
	// ......................................................
	$(function () {
		if ($('#is_roomJoin').val() == 'true') {
			connection.open($('#room-id').val(), function () {
				showRoomURL(connection.sessionid);
			});

		} else {
			connection.join($('#room-id').val());
		}

		connection.onmessage = appendDIV;
		var chatModelDisplay = '<div class ="chatScreen">' +
			'<div class="portlet-body col-md-12">' +
			'<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible1="1">' +
			'<ul class = "chats" id="chat-output">' +
			'</ul>' +
			'</div>' +
			'<div class="chat-form">\n' +
			'<div class="input-cont">\n' +
			'<input class="form-control" id = "chatInputField" onkeypress ="chatTyping(event)" type="text" placeholder="Type a message here..." /> </div>' +
			'<div class="btn-cont">\n' +
			'<span class="arrow"> </span>\n' +
			'<button href="#" id = "chatSendClick" onclick = "sendmessage()" class="btn blue icn-only">' +
			'<i class="fa fa-check icon-white"></i>' +
			'</button>' +
			'</div>' +
			'</div>' +
			'</div>' +
			'</div>';

		var modal = new ax5.ui.modal({
			theme: "material",
			fullScreen: function () {
				return ($(window).width() < 600);
			},
			header: {
				title: '<i class="fa fa-weixin"></i>  聊天',
				btns: {
					minimize: {
						label: '<i class="fa fa-minus-circle" aria-hidden="true"></i>',
						onClick: function () {
							modal.minimize();
						}
					},
					restore: {
						label: '<i class="fa fa-plus-circle" aria-hidden="true"></i>',
						onClick: function () {
							modal.restore();
						}
					},
					close: {
						label: '<i class="fa fa-times-circle" aria-hidden="true"></i>',
						onClick: function () {
							modal.close();
						}
					}
				}
			}
		});

		$('#chatting_open').click(function () {
			modal.open({}, function () {				
				this.$["body-frame"].html(chatModelDisplay);
			});
			modal.align({
				left: "right",
				top: "bottom"
			});

		});

		$('#chatInputField').keypress(function (event) {
			
		});

		
		setInterval(function() {
			messageTimeSent.each(function() {
				var each = moment($(this).data('time'));
				$(this).text(each.fromNow());
			});

		}, 60000);
	
	});

	function chatTyping(event){
		if(event.keyCode == 13){
			var msg = $('#chatInputField').val();
		if (msg == '') return true;
		var username = '<?=$this->session->userdata('usr_name')?>';
		var sendData = {
			username: username,
			msg: msg
		};
		connection.send(sendData);
		appendDIV(sendData, 1);
		$('#chatInputField').val('');

		}else{
			return true;

		}
	

	}
	


	function sendmessage() {
		var msg = $('#chatInputField').val();
		if (msg == '') return true;
		var username = '<?=$this->session->userdata('usr_name ')?>';
		var sendData = {
			username: username,
			msg: msg
		};
		connection.send(sendData);
		appendDIV(sendData, 1);
		$('#chatInputField').val('');

	}


	function appendDIV(event, isme) {
		var chatBuffer = "";
		var now = Date();
		if (isme) {
			chatBuffer = '<li class="out">\n' +
				'<img class="avatar" alt="" src="<?=base_url()?>/assets/layouts/layout/img/avatar2.jpg" />' +
				'<div class="message">' +
				'<span class="arrow"> </span>\n' +
				'<a href="javascript:;" class="name"> ' + event.username + '</a>' +
				'<span class="datetime"></span>' +
				'<span class="body">' + event.msg + '</span>' +
				'</div>\n' +
				'</li>';
		} else {
			chatBuffer = '<li class="in">' +
				'<img class="avatar" alt="" src="<?=base_url()?>/assets/layouts/layout/img/avatar1.jpg" />' +
				'<div class="message">' +
				'<span class="arrow"> </span>' +
				'<a href="javascript:;" class="name"> ' + event.data.username + '</a>' +
				'<span class="datetime"></span>' +
				'<span class="body">' + event.data.msg + ' </span>' +
				'</div>' +
				'</li>';

		}
		$('#chat-output').append(chatBuffer);
		messageTimeSent = $(".datetime");
        messageTimeSent.last().text(now);
        var s = function() {
            var t = 0;
            return $('.chatScreen').find("li.out, li.in").each(function() {
                t += $(this).outerHeight()
            }), t
        };
        $('.chatScreen').find(".scroller").slimScroll({
            scrollTo: s()
		});	
		

	}


	document.getElementById('join-room').onclick = function () {
		disableInputButtons();
		connection.join(document.getElementById('room-id').value);
	};
	var connection = new RTCMultiConnection();

	// by default, socket.io server is assumed to be deployed on your own URL
	connection.socketURL = 'http://localhost:9001/';

	// comment-out below line if you do not have your own socket.io server
	// connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

	connection.socketMessageEvent = 'video-conference-demo';

	connection.session = {
		audio: true,
		video: true,
		data: true
	};
	connection.sdpConstraints.mandatory = {
		OfferToReceiveAudio: true,
		OfferToReceiveVideo: true
	};
	connection.videosContainer = document.getElementById('videos-container');
	connection.onstream = function (event) {
		event.mediaElement.removeAttribute('src');
		event.mediaElement.removeAttribute('srcObject');
		var video = document.createElement('video');
		video.controls = true;
		if (event.type === 'local') {
			video.muted = true;
		}
		video.srcObject = event.stream;

		var width = parseInt(connection.videosContainer.clientWidth / 2) - 20;
		var mediaElement = getHTMLMediaElement(video, {
			title: event.userid,
			buttons: ['full-screen'],
			width: width,
			showOnMouseEnter: false
		});

		connection.videosContainer.appendChild(mediaElement);

		setTimeout(function () {
			mediaElement.media.play();
		}, 5000);

		mediaElement.id = event.streamid;
	};

	connection.onstreamended = function (event) {
		var mediaElement = document.getElementById(event.streamid);
		if (mediaElement) {
			mediaElement.parentNode.removeChild(mediaElement);
		}
	};

	// function disableInputButtons() {
	// 	document.getElementById('open-or-join-room').disabled = true;
	// 	document.getElementById('open-room').disabled = true;
	// 	document.getElementById('join-room').disabled = true;
	// 	document.getElementById('room-id').disabled = true;
	// }

	// ......................................................
	// ......................Handling Room-ID................
	// ......................................................

	function showRoomURL(roomid) {
		var roomHashURL = '#' + roomid;
		var roomQueryStringURL = '?roomid=' + roomid;
		var html = '<h2>Unique URL for your room:</h2><br>';

		html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
		html += '<br>';
		html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';

		var roomURLsDiv = document.getElementById('room-urls');
		roomURLsDiv.innerHTML = html;

		roomURLsDiv.style.display = 'block';
	}

	(function () {
		var params = {},
			r = /([^&=]+)=?([^&]*)/g;

		function d(s) {
			return decodeURIComponent(s.replace(/\+/g, ' '));
		}
		var match, search = window.location.search;
		while (match = r.exec(search.substring(1)))
			params[d(match[1])] = d(match[2]);
		window.params = params;
	})();

	var roomid = '';
	if (localStorage.getItem(connection.socketMessageEvent)) {
		roomid = localStorage.getItem(connection.socketMessageEvent);
	} else {
		roomid = connection.token();
	}
	// document.getElementById('room-id').value = roomid;
	// document.getElementById('room-id').onkeyup = function () {
	// 	localStorage.setItem(connection.socketMessageEvent, this.value);
	// };

	var hashString = location.hash.replace('#', '');
	if (hashString.length && hashString.indexOf('comment-') == 0) {
		hashString = '';
	}

	var roomid = params.roomid;
	if (!roomid && hashString.length) {
		roomid = hashString;
	}

	if (roomid && roomid.length) {
		document.getElementById('room-id').value = roomid;
		localStorage.setItem(connection.socketMessageEvent, roomid);

		// auto-join-room
		(function reCheckRoomPresence() {
			connection.checkPresence(roomid, function (isRoomExist) {
				if (isRoomExist) {
					connection.join(roomid);
					return;
				}

				setTimeout(reCheckRoomPresence, 5000);
			});
		})();

		disableInputButtons();
	}

</script>
