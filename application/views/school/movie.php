<link rel="stylesheet" href="<?=base_url()?>assets/Vchat/dev/getHTMLMediaElement.css">
<link rel="stylesheet" href="<?=base_url()?>assets/Vchat/css/stylesheet.css">
<script src="<?=base_url()?>assets/global/scripts/socket.io.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/Vchat/dist/RTCMultiConnection.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/Vchat/dev/adapter.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/Vchat/dev/getHTMLMediaElement.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<h3 class="page-title">
			<?=$menutitle?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="/">
						<?=$menutitle?>
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<span>在线课程</span>
				</li>
			</ul>
		</div>
	<div class="row" id="sortable_portlets">
			<div class="col-md-12">
				<div class="portlet portlet-sortable box blue-madison ">
					<div class="portlet-title">
						<div class="caption">
							<span class="glyphicon glyphicon-list-alt"> </span>
							<span class="caption-subject font-light sbold uppercase">在线课程 </span>
						</div>
					</div>
					<input type="hidden" name="" id="movie_id" value="<?php echo $movie_info->lession_id; ?>">
					<input type="hidden" name="" id="sub_url" value="<?=base_url()?>school/send_message">
					<input type="hidden" name="" id="doctor_name" value="<?php echo $this->session->userdata('usr_name'); ?>">
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								<div class="note note-success display" id="openroomnote">
									<h4 class="block">课程标题：
										<?=$movie_info->lession_title?>
									</h4>
									<p> 该课程已开了 现在加入的人数：
										<span id="room_num_dis"></span>
									</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-offset-1 col-lg-6 column sortable">
								<div class="portlet portlet-sortable blue box bg-inverse">
									<div class="portlet-title">
										<div class="caption">
											<span class="glyphicon glyphicon-film"> </span>
											<span class="caption-subject bold font-light-haze uppercase"> 教程直播 </span>
											<span class="caption-helper"></span>
										</div>
										<div class="actions">
										</div>
									</div>
									<div class="portlet-body ">

										<div class="row">
											<div class="col-md-12">
												<img id="backgroundscreen" src="<?=base_url()?>assets/pages/media/bg/4.jpg" id="demo1" alt="Jcrop Example" class="img-responsive">
												<div id="videos-container"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-offset-1 col-lg-3 col-md-12 col-sm-6">
								<div class="portlet blue box ">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-bubble font-light"></i>
											<span class="caption-subject font-light bold uppercase">消息区</span>
										</div>
									</div>
									<div class="portlet-body" id="chatScreen">
										<div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
											<ul class="chats" id="chat-output">

											</ul>
										</div>
										<div class="chat-form">
											<div class="input-cont">
												<input class="form-control" type="text" id="chatInputField" onkeypress="chatTyping(event)" placeholder="请输入您的意见。。。。" /> </div>
											<div class="btn-cont">
												<span class="arrow"> </span>
												<button type="button" onclick="sendmessage()" class="btn blue icn-only">
													<i class="fa fa-check icon-white"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="room-id" value="<?=$this->session->userdata('id')?>">
<script>
	var room_id = '<?=$movie_info->lession_doctor?>';
	var usr_id = '<?=$this->session->userdata('id')?>';
	var notificationSocket = io('<?=get_socket_url()?>');
	var roomData = {
		usr_id: '<?=$movie_info->lession_doctor?>',
		lession_id: '<?=$movie_info->lession_id?>'
	};
	window.enableAdapter = true; // enable adapter.js
	$(function() {
		if (navigator.getUserMedia) {
			// Request the camera.
			navigator.getUserMedia(
				// Constraints
				{
					audio: true,
					video: true
				},
				// Success Callback
				function(localMediaStream) {
					if (room_id == usr_id) {
						try {
							connection.open(room_id, function(data) {
								notificationSocket.emit('openLessionRoom', roomData);
							});
						} catch (e) {

						}

					} else {
						connection.sdpConstraints.mandatory = {
							OfferToReceiveAudio: true,
							OfferToReceiveVideo: true
						};
						connection.join(room_id, function() {
							console.log('이것은 조인 부문입니다.');
						});

					}
				},
				// Error Callback
				function(err) {
					// Log the error to the console.
					if (room_id == usr_id) {
						$.alert('你不能直播 请输入拍摄头')
					}
					console.log('The following error occurred when trying to use getUserMedia: ' + err);
				}
			);

		} else {

			if (room_id == usr_id) {
				try {
					connection.open(room_id, function() {
						showRoomURL(connection.sessionid);
					});
				} catch (e) {

				}

			} else {
				connection.sdpConstraints.mandatory = {
					OfferToReceiveAudio: true,
					OfferToReceiveVideo: true
				};
				connection.join(room_id);

			}
			// alert('Sorry, your browser does not support getUserMedia');
		}

		if (room_id != usr_id) {
			connection.sdpConstraints.mandatory = {
				OfferToReceiveAudio: true,
				OfferToReceiveVideo: true
			};
			connection.join(room_id);

		}

		setInterval(function() {
			var numberOfUsersInTheRoom = connection.getAllParticipants().length;
			console.log('this is ', connection.getAllParticipants())
			$('#room_num_dis').html(numberOfUsersInTheRoom);
			connection.checkPresence(room_id, function(isRoomExist) {});
		}, 5000);
		$("body").on("click", ".message .name", function(e) {
			var textarea = $('#chatInputField');
			e.preventDefault();
			var t = $(this).text();
			textarea.val("@" + t + ":");
			App.scrollTo(textarea);
		})

	});

	function chatTyping(event) {
		if (event.keyCode == 13) {
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
		} else {
			return true;
		}
	}

	// ......................................................
	// ..................RTCMultiConnection Code.............
	// ......................................................

	var connection = new RTCMultiConnection(room_id);
	connection.socketURL = '<?=get_video_url()?>';
	connection.socketMessageEvent = 'video-broadcast';
	connection.onmessage = appendDIV;
	connection.session = {
		audio: true,
		video: true,
		oneway: true,
		data: true
	};
	connection.sdpConstraints.mandatory = {
		OfferToReceiveAudio: false,
		OfferToReceiveVideo: false
	};
	connection.videosContainer = document.getElementById('videos-container');
	connection.onstream = function(event) {
		$('#backgroundscreen').hide();
		event.mediaElement.removeAttribute('src');
		event.mediaElement.removeAttribute('srcObject');
		var video = document.createElement('video');
		video.controls = true;
		if (event.type === 'local') {
			video.muted = true;
		}
		video.srcObject = event.stream;
		var mediaElement = getHTMLMediaElement(video, {
			title: event.userid,
			buttons: ['mute-audio', 'full-screen', 'stop'],
			showOnMouseEnter: false
		});
		console.log($(mediaElement).css("width", ""));
		connection.videosContainer.appendChild(mediaElement);
		mediaElement.id = event.streamid;
		setTimeout(function() {
			mediaElement.media.play();
		}, 5000);
	};

	connection.onstreamended = function(event) {
		var mediaElement = document.getElementById(event.streamid);
		if (mediaElement) {
			mediaElement.parentNode.removeChild(mediaElement);
		}
	};

	// ......................................................
	// ......................Handling Room-ID................
	// ......................................................

	function showRoomURL(roomid) {
		var roomHashURL = '#' + roomid;
	}

	var layoutImgPath = 'layouts/layout/img/';
	getLayoutImgPath = function() {
		return App.getAssetsPath() + layoutImgPath;
	};

	function sendmessage() {
		var msg = $('#chatInputField').val();
		if (msg == '') return true;
		var username = '<?=$this->session->userdata('
		usr_name ')?>';
		var sendData = {
			username: username,
			msg: msg
		};
		connection.send(sendData);
		appendDIV(sendData, 1);
		$('#chatInputField').val('');

	}

	function appendDIV(event, isme) {
		var who = '';
		var usr_name = '';
		var avatar = '';
		var msg = '';
		if (isme) {
			who = 'out';
			avatar = 'avatar1.jpg';
			usr_name = event.username;
			msg = event.msg;
		} else {
			if (event.data.usr_id) return;
			who = 'in';
			avatar = 'avatar2.jpg';
			usr_name = event.data.username;
			msg = event.data.msg;

		}
		var r = [];
		r += '<li class="' + who + '">',
			r += '<img class="avatar" alt="" src="' + '<?=base_url()?>/assets/layouts/layout/img/' + avatar + '"/>',
			r += '<div class="message">',
			r += '<span class="arrow"></span>',
			r += '<a href="#" class="name">' + usr_name + '</a>&nbsp;',
			r += '<span class="datetime">at ' + moment().format('h:mm:ss a') + "</span>",
			r += '<span class="body">',
			r += msg,
			r += "</span>",
			r += "</div>",
			r += "</li>";
		var li = $(r);
		$('#chat-output').append(li);
		var s = function() {
			var t = 0;
			return $('#chatScreen').find("li.out, li.in").each(function() {
				t += $(this).outerHeight()
			}), t
		};
		$('#chatScreen').find(".scroller").slimScroll({
			scrollTo: s()
		});
	}

	(function() {
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
	document.getElementById('room-id').value = roomid;
	document.getElementById('room-id').onkeyup = function() {
		localStorage.setItem(connection.socketMessageEvent, this.value);
	};
	var hashString = location.hash.replace('#', '');
	if (hashString.length && hashString.indexOf('comment-') == 0) {
		hashString = '';
	}
	var roomid = params.roomid;
	if (!roomid && hashString.length) {
		roomid = hashString;
	}
	if (roomid && roomid.length) {
		localStorage.setItem(connection.socketMessageEvent, roomid);
		// auto-join-room
		(function reCheckRoomPresence() {
			connection.checkPresence(roomid, function(isRoomExist) {
				if (isRoomExist) {
					connection.sdpConstraints.mandatory = {
						OfferToReceiveAudio: true,
						OfferToReceiveVideo: true
					};
					connection.join(roomid);
					return;
				}
				setTimeout(reCheckRoomPresence, 5000);
			});
		})();
	}
</script>
