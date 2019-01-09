<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row" id="sortable_portlets">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption font-green-sharp">
							<i class="icon-share font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> 影像远程会诊</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col s12 l6 m6">
								<div class="col s12 m12">
									<div class="card">
										<div class="card-image" id="shareScreenView" style="width: 100%">
											<img id="backgroundscreen" src="<?=base_url()?>assets/pages/media/bg/8.jpg" id="demo1" alt="Jcrop Example" class="img-responsive">
											<span class="card-title">操作页面</span>
										</div>
										<div class="card-action">
										</div>
									</div>
								</div>
								<div class="col s12 m12" style="display:none;">
									<div class="card">
										<div class="card-image" id="shareScreenView1" style="width: 100%; display:none;">
											<img id="backgroundscreen1" src="<?=base_url()?>assets/pages/media/bg/8.jpg" id="demo1" alt="Jcrop Example" class="img-responsive">
											<span class="card-title">操作页面</span>
										</div>
										<div class="card-action">
											<?php if ($contact_info->req_doctor_name == $this->session->userdata('id')):?>
											<a class="btn-floating btn-large waves-effect waves-light blue" id="changeShareScreen">
												<i class="material-icons dp48">add</i>
											</a>
											<?php endif;?>
										</div>
									</div>
								</div>
							</div>
							<div class="col s12 l3 m6" id="addVideoRemoteScreen">
								<div class="col s12 m12 " id="firstVodeoScreen">
									<div class="card">
										<div class="card-image">
											<div id="video_size"></div>
										</div>
									</div>
								</div>
								<?php foreach ($memberInfo as $value): ?>
								<?php if ($value->id != $this->session->userdata('id')):?>
								<div class="col s12 m12 ">
									<div class="card">
										<div class="card-image" id="Videoconference<?=$value->usr_id?>">
											<img id="backgroundscreen<?=$value->usr_id?>" src="<?=base_url()?>assets/pages/media/bg/7.jpg" alt="Jcrop Example" class="img-responsive">
											<div id="video_size<?=$value->id?>"></div>
											<span class="card-title">
												<?=$value->usr_name?>
											</span>
										</div>
									</div>
								</div>
								<?php endif;?>
								<?php endforeach;?>
							</div>

							<div class="col s12 l3 m6">
								<div class="col s12">
									<div class="card-panel">
										<div class="portlet light ">
											<div class="portlet-title">
												<div class="caption">
													<span class="caption-subject font-dark bold uppercase">视频分享成员(
														<span id="roomNumber">0</span>/
														<?=count($memberInfo)?>)</span>
												</div>
											</div>
											<div class="portlet-body">
												<div class="slimScrollDiv">
													<div class="scroller" data-always-visible="1" data-rail-visible="0" data-initialized="1">
														<div class="collection">
															<?php foreach ($memberInfo as $value): ?>
															<a href="#" disable id="list<?=$value->usr_id?>" class="collection-item <?=$value->usr_id==$this->session->userdata('usr_id')?'active':''?>">
																<?=$value->usr_name?>
															</a>
															<?php endforeach;?>
														</div>
													</div>
												<div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 186.335px;"></div>
											<div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
										</div>
										<div class="portlet-title">
											<div class="caption">
												<span class="caption-subject font-dark bold uppercase">画面分享成员(
													<span id="roomNumber1">0</span>/
													<?=count($memberInfo)?>)</span>
											</div>
										</div>
										<div class="slimScrollDiv">
											<div class="scroller" data-always-visible="1" data-rail-visible="0" data-initialized="1">
												<div class="collection">
													<?php foreach ($memberInfo as $value): ?>
													<a href="#" disable id="list1<?=$value->usr_id?>" class="collection-item <?=$value->usr_id==$this->session->userdata('usr_id')?'active':''?>">
														<?=$value->usr_name?>
													</a>
													<?php endforeach;?>
												</div>
											</div>
											<div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 186.335px;"></div>
												<div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div>
												</div>
												<div style="text-align: center;" id="end_contact">
													<button>会诊结束</button>
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
	</div>d
</div>

<div class="fixed-action-btn horizontal click-to-toggle" style="padding-bottom: 1%;">
	<a id="chatting_open" class=" pull-right btn-floating btn-large waves-effect waves-light blue">
		<i class="fa fa-lg fa-wechat"></i>
	</a>
</div>
<script>
	window.enableAdapter = true; // enable adapter.js
	var room_id = '<?=$room_id?>' + 'room';
	var screen_room_id = '<?=$room_id?>' + 'screen'
	var usr_id = '<?=$this->session->userdata('id')?>';
	var usr_loginid = '<?=$this->session->userdata('usr_id')?>';
	var room_title = '<?=$contact_info->contact_title?>';
	var room_doc = '<?=$contact_info->req_doctor_name?>';
	var toggleCount = 0;
	var messageTimeSent = $('<div></div>');
	var isToggle = false;
	var MODERATOR_CHANNEL_ID = room_title; // channel-id
	var MODERATOR_SESSION_ID = room_id; // room-id
	var MODERATOR_ID = usr_loginid; // user-id
	var MODERATOR_SESSION = { // media-type
		audio: true,
		video: true
	};
	var MODERATOR_EXTRA = {

	};
	var index = 0;
	var room_manager = '';
	var room_manager_id = ' ';
	var userName = {};

	var idname = [];
	var isVideoEnd = false;

	<?php foreach ($memberInfo as $value): ?>
	idname.push('<?=$value->usr_id?>');
	userName.
	<?=$value->usr_id?> = '<?=$value->usr_name?>';
	if (!index) {
		room_manager = '<?=$value->usr_name?>';
		room_manager_id = '<?=$value->usr_id?>';
		console.log(room_manager);
		index++;
	}
	<?php endforeach;?>
	userName[room_id] = room_id;
	$(function () {
		$.ajax({
			url: '<?=base_url()?>' + 'Contact/start_contact',
			type: 'GET',
			dataType: 'json',
			data: {
				'contact_id': '<?=$contact_info->contact_id?>'
			},
			cache: false,
			success: function (data) {
				//window.location.href='<?=base_url()?>' + 'contact/my_contact';
			},
			error: function (request, textStatus, errorThrown) {
				alert('start_contact_error');
			}
		});
		$('#end_contact').click(function () {
			$.ajax({
				url: '<?=base_url()?>' + 'Contact/end_contact',
				type: 'GET',
				dataType: 'json',
				data: {
					'contact_id': '<?=$contact_info->contact_id?>',
					'booking_id': '<?=$contact_info->patient_id?>'
				},
				cache: false,
				success: function (data) {
					//alert(data.contact_id);
					window.location.href = '<?=base_url()?>' + 'contact/my_contact';
				},
				error: function (request, textStatus, errorThrown) {
					alert('end_contact_error', textStatus);
				}
			});
		});
		getChromeExtensionStatus(function (status) {
			if (status === 'installed-enabled') {}
			if (status === 'not-installed') {
				Materialize.toast('没有安装插件 请安装插件 ', 10000);
				return;
			}
			if (status === 'installed-disabled') {

			}
		});

		console.log("---------step1-----------", navigator);
		if (navigator.getUserMedia) {
			// Request the camera.
			console.log('Request the camera');
			navigator.getUserMedia(
				// Constraints
				{
					audio: true,
					video: true
				},
				// Success Callback
				function (localMediaStream) {
					console.log(usr_id, room_doc);
					if (usr_id == room_doc) {
						//방주인이 자기의 비데오 방을 만든다.
						connection.session = MODERATOR_SESSION;
						connection.userid = MODERATOR_ID;
						connection.extra = MODERATOR_EXTRA;
						MODERATOR_EXTRA.isCamera = true;
						connection.open(room_id, function () {
							console.log('방주인이 채팅방을 만든다.', room_id);
							showRoomURL(connection.sessionid);
						});

					} else {
						// 방주인이 아닌 경우 비데오 채팅방을 만든다.
						connection.session = MODERATOR_SESSION;
						connection.userid = MODERATOR_ID;
						connection.extra = MODERATOR_EXTRA;
						MODERATOR_EXTRA.isCamera = true;
						connection.checkPresence(room_id, function (isRoomExist, roomid) {
							if (isRoomExist === true) {
								connection.join(room_id, function () {
									console.log('방주인의 비데오 채팅방에 들어간다,', room_id);
								});
							} else {
								$.ajax({
									url: '<?=base_url()?>' + 'Contact/set_mem_status',
									type: 'GET',
									dataType: 'json',
									data: {
										'contact_id': '<?=$contact_info->contact_id?>'
									},
									cache: false,
									success: function (data) {
										//window.location.href='<?=base_url()?>' + 'contact/my_contact';
									},
									error: function (request, textStatus, errorThrown) {
										alert('set_mem_status_error');
									}
								});
								console.log('방이 존재하지 않습니다!');
								$.alert({
									title: '提示!',
									content: '会诊还没开始！',
									columnClass: 'small',
									buttons: {
										ok: function () {
											window.location.href = '<?=base_url()?>' + 'contact/my_contact';
										}
									}
								});
							}
						});
					}
				},
				// Error Callback
				function (err) {
					console.log('error callback');
					navigator.getUserMedia(
						// Constraints
						{
							audio: false,
							video: true
						},
						function (localMediaStream) {
							console.log('audio=false:localMediaStream');
							if (usr_id == room_doc) {
								console.log('audio=false:localMediaStream 방주인');
								//방주인이 자기의 비데오 방을 만든다.
								connection.session = {
									audio: false,
									video: true,
									oneway: true
								};
								connection.userid = MODERATOR_ID;
								connection.extra = MODERATOR_EXTRA;
								MODERATOR_EXTRA.isCamera = true;
								connection.open(room_id, function () {
									console.log('방주인이 채팅방을 만든다.', room_id);
									showRoomURL(connection.sessionid);
								});

							} else {
								// 방주인이 아닌 경우 비데오 채팅방을 만든다.
								console.log('audio=false:localMediaStream 손님');
								connection.session = {
									audio: false,
									video: true,
									oneway: true
								};
								connection.userid = MODERATOR_ID;
								connection.extra = MODERATOR_EXTRA;
								MODERATOR_EXTRA.isCamera = true;
								connection.checkPresence(room_id, function (isRoomExist, roomid) {
									if (isRoomExist === true) {
										connection.join(room_id, function () {
											console.log('방주인의 비데오 채팅방에 들어간다,', room_id);
										});
									} else {
										$.ajax({
											url: '<?=base_url()?>' + 'Contact/set_mem_status',
											type: 'GET',
											dataType: 'json',
											data: {
												'contact_id': '<?=$contact_info->contact_id?>'
											},
											cache: false,
											success: function (data) {
												//window.location.href='<?=base_url()?>' + 'contact/my_contact';
											},
											error: function (request, textStatus, errorThrown) {
												alert('set_mem_status_error');
											}
										});
										console.log('방이 존재하지 않습니다!');
										$.alert({
											title: '提示!',
											content: '会诊还没开始！',
											columnClass: 'small',
											buttons: {
												ok: function () {
													window.location.href = '<?=base_url()?>' + 'contact/my_contact';
												}
											}
										});
									}
								});
							}
						},
						function (err) {
							MODERATOR_SESSION = { // media-type
								audio: true,
								video: true,
								oneway: true
							};
							connection.session = MODERATOR_SESSION;
							connection.userid = MODERATOR_ID;
							MODERATOR_EXTRA.isCamera = false;
							connection.extra = MODERATOR_EXTRA;
							connection.join(room_id, function () {
								console.log('방주인의 비데오 채팅방에 들어간다,', room_id);
							});

							//카메라가 없다면
							Materialize.toast('没有拍摄头 请插入拍摄头 ', 10000);
							console.log('The following error occurred when trying to use getUserMedia: ' + err);
						}
					);
				}
			);

		} else {
			alert('Sorry, your browser does not support getUserMedia');
		}

		if (usr_id == room_doc) {
			shareScreen.open(screen_room_id, function () {
				showRoomURL(shareScreen.sessionid);
			});
		} else {

			shareScreen.checkPresence(screen_room_id, function (isRoomExist, roomid) {
				if (isRoomExist === true) {
					shareScreen.join(screen_room_id, function (data) {
						console.log('이것은 기본 화면 캅쳐에 조인하는 부분입니다.', room_id );
					});
				} else {
					console.log('방이 존재하지 않습니다!');
				}
			});
		}



		setInterval(function () {
			for(var x in idname){
				//$('#Videoconference' + idname[x]).show();
				$('#list' + idname[x]).removeClass('active');
			}

			$('#Videoconference' + room_manager_id).hide();
			$('#list' + room_manager_id).addClass('active');
			$('#Videoconference' + MODERATOR_ID).hide();
			$('#list' + MODERATOR_ID).addClass('active');
			var numberOfUsersInTheRoom = connection.getAllParticipants().length + 1;
			$('#roomNumber').html(numberOfUsersInTheRoom);
			for (var variable in connection.getAllParticipants()) {
				$('#Videoconference' +  connection.getAllParticipants()[variable]).hide();
				$('#list' + connection.getAllParticipants()[variable]).addClass('active');
			}
			<?php if($contact_info->req_doctor_name == $this->session->userdata('id')):?>
			var sendData = {
			    is2ndScreen: isToggle
			};
		       shareScreen.send(sendData);
		    <?php endif;?>
		}, 3000);



		$('#changeShareScreen').click(function () {
			shareScreen1.open(room_id + 'addon', function () {
				isToggle = true;
				showRoomURL(shareScreen.sessionid);
			});
		});
		$('#closeShareScreenView').click(function () {
			toggleCount++;
			if (toggleCount % 2 == 0) {
				$('#shareScreenView').css('display', 'none');
			} else {
				$('#shareScreenView').css('display', 'block');
			}
		});

		shareScreen.onmessage = appendDIV;
		var chatModelDisplay = '<div class ="chatScreen">' +
			'<div class="portlet-body col-md-12">' +
			'<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible1="1">' +
			'<ul class = "chats" id="chat-output">' +
			'</ul>' +
			'</div>' +
			'<div class="chat-form">' +
			'<div class="input-cont">' +
			'<input class="form-control" id = "chatInputField" onkeypress ="chatTyping(event)" type="text" placeholder="请输入聊天。。。" /> </div>' +
			'<div class="btn-cont" style="margin-top: -68px;">' +
			'<span class="arrow"> </span>' +
			'<button id = "chatSendClick" onclick = "sendmessage()" class="btn blue icn-only">' +
			'<i class="fa fa-check icon-white"></i>' +
			'</button>' +
			'</div>' +
			'</div>' +
			'</div>' +
			'</div>';
		var modal = new ax5.ui.modal({
			theme: "bootstrap",
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
							if (typeof (Storage) !== "undefined") {
								//alert("dffalksdhfls");
								localStorage.setItem("chatting_history", $('#chat-output').html());
								//alert(localStorage.getItem("chatting_history"));
							}
							modal.close();
						}
					}
				}
			}
		});

		$('#chatting_open').click(function () {
			modal.open({}, function () {
				this.$["body-frame"].html(chatModelDisplay);
				$('#chat-output').append(localStorage.getItem("chatting_history"));
			});
			modal.align({
				left: "right",
				top: "bottom"
			});

		});

		$('#chatInputField').keypress(function (event) {

		});
		try {
			setInterval(function () {
				if (typeof messageTimeSent === undefined) return;
				messageTimeSent.each(function () {
					var each = moment($(this).data('time'));
					$(this).text(each.fromNow());
				});
			}, 60000);

		} catch (e) {
			console.log(e);
		}
	});

	function chatTyping(event) {
		if (event.keyCode == 13) {
			var msg = $('#chatInputField').val();
			if (msg == '') return true;
			var username = '<?=$this->session->userdata('
			usr_name ')?>';
			var sendData = {
				username: username,
				msg: msg
			};
			shareScreen.send(sendData);
			appendDIV(sendData, 1);
			$('#chatInputField').val('');

		} else {
			return true;

		}
	}

	function sendmessage() {
		var msg = $('#chatInputField').val();
		if (msg == '') return true;
		var username = '<?=$this->session->userdata('
		usr_name ')?>';
		var sendData = {
			username: username,
			msg: msg
		};
		shareScreen.send(sendData);
		appendDIV(sendData, 1);
		$('#chatInputField').val('');

	}

	function appendDIV(event, isme) {
		var chatBuffer = "";
		var now = Date();
		if (isme) {
			chatBuffer = '<li class="out">' +
				'<img class="avatar" alt="" src="<?=base_url()?>/assets/layouts/layout/img/avatar2.jpg" />' +
				'<div class="message">' +
				'<span class="arrow"> </span>' +
				'<a href="javascript:;" class="name"> ' + event.username + '</a>' +
				'<span class="datetime"></span>' +
				'<span class="body">' + event.msg + '</span>' +
				'</div>' +
				'</li>';
		} else {
			if (event.data.is2ndScreen) {
				shareScreen1.join(room_id + 'addon', function (data) {
					console.log('this is jiondata', room_id + 'addon');

				});
				return;
			}
			if (!event.data.username) return;
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
		messageTimeSent.last().text(moment().format('h:mm:ss a'));
		var s = function () {
			var t = 0;
			return $('.chatScreen').find("li.out, li.in").each(function () {
				t += $(this).outerHeight()
			}), t
		};
		$('.chatScreen').find(".scroller").slimScroll({
			scrollTo: s()
		});
	}

	//----비데오 회의체계를 위한 콘넥션
	var connection = new RTCMultiConnection(MODERATOR_CHANNEL_ID);
	connection.socketURL = '<?=get_video_url()?>';
	connection.socketMessageEvent = 'video-conference';
	connection.sdpConstraints.mandatory = {
		OfferToReceiveAudio: true,
		OfferToReceiveVideo: true
	};

	connection.videosContainer = document.getElementById('addVideoRemoteScreen');
	connection.socketCustomEvent = 'custom-message';
	var socket = connection.getSocket();
	socket.emit(connection.socketCustomEvent, { test: true });
	socket.on(connection.socketCustomEvent, function(message) {
		//alert('message');
	});

	connection.onstream = function (event) {
		event.mediaElement.removeAttribute('src');
		event.mediaElement.removeAttribute('srcObject');
		var video = event.mediaElement;
		video.controls = true;
		if (event.type === 'local') {
			video.muted = true;
		}
		video.srcObject = event.stream;
		var titleName = "";
		if (event.userid == room_id) {
			titleName = room_manager;
		} else {
			titleName = (userName[event.userid]);
		}
		var mediaElement = getHTMLMediaElement(video, {
			title: titleName,
			buttons: ['mute-audio', 'full-screen', 'stop'],
			showOnMouseEnter: true
		});
		console.log('this is ', event);
		$(mediaElement).css('width', '');
		($(mediaElement).find('.media-container  div:last').css('padding', '0px'));
		connection.videosContainer.insertBefore(mediaElement, connection.videosContainer.childNodes[0]);
		setTimeout(function () {
			mediaElement.media.play();
		}, 5000);
		mediaElement.id = event.streamid;
	};

	connection.onstreamended = function (event) {
		if (event.userid == room_id) {
			//connection.checkPresence(room_id, function (isRoomExist, roomid) {
				//if (!isRoomExist) {
					$.alert({
						title: '提示!',
						content: '会诊已结束！',
						columnClass: 'small',
						buttons: {
							ok: function () {
								window.location.href = '<?=base_url()?>' + 'contact/my_contact';
							}
						}
					});
					// connection.disconnectWith(MODERATOR_ID);
					// connection.socket.disconnect();
				//}
			//});
		} else {
			$('#Videoconference' + event.userid).show();
			$('#list' + event.userid).removeClass('active');
			var mediaElement = document.getElementById(event.streamid);
			if (mediaElement) {
				mediaElement.parentNode.removeChild(mediaElement);
			}
		}
  	};


	// ---- 화면 공유를 위한 콘넥션
	var shareScreen = new RTCMultiConnection(MODERATOR_CHANNEL_ID);

	shareScreen.socketURL = '<?=get_video_url()?>';
	// comment-out below line if you do not have your own socket.io server
	shareScreen.socketMessageEvent = 'screen-sharing';

	shareScreen.userid = MODERATOR_ID + 'screen';
	shareScreen.sessionid = MODERATOR_ID + 'screen';



	shareScreen.session = {
		screen: true,
		data: true,
		oneway: true
	};
	shareScreen.sdpConstraints.mandatory = {
		OfferToReceiveAudio: false,
		OfferToReceiveVideo: false
	};
	shareScreen.videosContainer = document.getElementById('shareScreenView');
	shareScreen.onstream = function (event) {
		$('#backgroundscreen').hide();
		var shareScreeninstance = event.mediaElement;
		shareScreeninstance.style.cssText = 'width:100%';
		shareScreen.videosContainer.appendChild(event.mediaElement);
		event.mediaElement.play();
		setTimeout(function () {
			event.mediaElement.play();
		}, 5000);
	};
	// Using getScreenId.js to capture screen from any domain
	// You do NOT need to deploy Chrome Extension YOUR-Self!!
	shareScreen.getScreenConstraints = function (callback) {
		getScreenConstraints(function (error, screen_constraints) {
			if (!error) {
				screen_constraints = shareScreen.modifyScreenConstraints(screen_constraints);
				callback(error, screen_constraints);
				return;
			}
			//throw error;
		});
	};

	shareScreen.onstreamended = function (event) {
		if (event.userid == screen_room_id) {
			//shareScreen.disconnectWith(user_screen_id);
			//shareScreen.checkPresence(screen_room_id, function (isRoomExist, roomid) {
				//if (!isRoomExist) {
					$.alert({
						title: '提示!',
						content: '会诊已结束！',
						columnClass: 'small',
						buttons: {
							ok: function () {
								window.location.href = '<?=base_url()?>' + 'contact/my_contact';
							}
						}
					});
				//}
			//});
		// var user_screen_id = MODERATOR_ID + 'screen';
		// shareScreen.socket.disconnect();
		}
	};

	setInterval(data=>{
		for(var x in idname){
			$('#Videoconference' + idname[x]).show();
			$('#list1' + idname[x]).removeClass('active');
		}

		$('#Videoconference' + room_manager_id).hide();
		$('#list1' + room_manager_id).addClass('active');
		$('#Videoconference' + MODERATOR_ID).hide();
		$('#list1' + MODERATOR_ID).addClass('active');
		var numberOfUsersInTheRoom1 = shareScreen.getAllParticipants().length + 1;
		$('#roomNumber1').html(numberOfUsersInTheRoom1);
		var user_screen_id;
		for (var variable in shareScreen.getAllParticipants()) {
			user_screen_id = shareScreen.getAllParticipants()[variable].replace("screen", "")
			$('#Videoconference' + user_screen_id).hide();
			$('#list1' + user_screen_id).addClass('active');
		}

	}, 3000);


	var shareScreen1 = new RTCMultiConnection(MODERATOR_CHANNEL_ID);
	//by default, socket.io server is assumed to be deployed on your own URL
	shareScreen1.socketURL = '<?=get_video_url()?>';
	// comment-out below line if you do not have your own socket.io server
	shareScreen1.socketMessageEvent = 'screen-sharing';
	shareScreen1.session = {
		screen: true,
		oneway: true
	};
	shareScreen1.sdpConstraints.mandatory = {
		OfferToReceiveAudio: false,
		OfferToReceiveVideo: false
	};

	shareScreen1.videosContainer = document.getElementById('shareScreenView1');
	shareScreen1.onstream = function (event) {
		$('#backgroundscreen1').hide();
		var shareScreeninstance = event.mediaElement;
		shareScreeninstance.style.cssText = 'width:100%';
		shareScreen1.videosContainer.append(event.mediaElement);
		event.mediaElement.play();
		setTimeout(function () {
			event.mediaElement.play();
		}, 5000);
	};
	// Using getScreenId.js to capture screen from any domain
	// You do NOT need to deploy Chrome Extension YOUR-Self!!
	shareScreen1.getScreenConstraints = function (callback) {
		getScreenConstraints(function (error, screen_constraints) {
			if (!error) {
				screen_constraints = shareScreen.modifyScreenConstraints(screen_constraints);
				callback(error, screen_constraints);
				return;
			}
			throw error;
		});
	};

	function showRoomURL(roomid) {
		var roomHashURL = '' + roomid;
		Materialize.toast('这个房间号码是  ' + roomHashURL, 10000);
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
			connection.checkPresence(roomid, function (isRoomExist) {
				console.log('콘넥을 위한 기능단', roomid);
				if (isRoomExist) {
					connection.join(roomid);
					return;
				}
				setInterval(reCheckRoomPresence, 5000);
			});
		})();
	}
    function LockF5() {
        if (event.keyCode == 116) {
            event.keyCode = 0;
            return false;
        }
    }
	document.onkeydown = LockF5;

	var contact_mitting = io('<?=get_socket_url()?>');
	if(room_manager_id == '<?=$this->session->userdata('usr_id')?>'){
		contact_mitting.emit('contact_start', {contact_id:'<?=$contact_info->contact_id?>', usr_id:'<?=$this->session->userdata('usr_id')?>'});
	}

</script>
