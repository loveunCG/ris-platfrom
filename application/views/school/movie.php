<!-- <link href="<?=base_url()?>assets/video/video-js.css" rel="stylesheet">
<link href="<?=base_url()?>assets/video/videojs-playlist-ui.vertical.css" rel="stylesheet">   -->

<!-- If you'd like to support IE8 -->
<!-- <script src="<?=base_url()?>assets/video/videojs-ie8.min.js"></script> -->
<style>


.container {
  width: 100%;
  padding: 0 40px;
  max-width: 1300px;
  margin: 0 auto;
  clear: both;
}

.container::after {
  content: "";
  display: block;
  clear: both;
}
 body::-webkit-scrollbar {
 width: 4px;
}
 body::-webkit-scrollbar-thumb {
 background-color: #555;
}

body { min-height: 100vh; }

.container {
  width: 80%;
  margin: 0 auto;
}
@media (max-width: 768px) {

.container { width: 100%; }
}

h1 { margin:150px auto 30px auto; text-align:center;}

#videoContainer {
  width: 57vw;
  height: 65vh;
  background: #39a072;
  margin: 0px auto;
  border-radius: 5px;
  box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

#videoContainer.fullScreen {
  width: 100vw !important;
  height: 100vh !important;
}

#videoContainer.small .intensityBar { width: 50px !important; }

#videoContainer.small .playButton {
  margin: 0 !important;
  margin-right: 5px !important;
}

#videoContainer.small .timer { display: none !important; }

#videoContainer.small .playPause, #videoContainer.small .volume .icon, #videoContainer.small .scale .icon {
  width: 15px !important;
  height: 15px !important;
}

#videoContainer.small .progressBar { height: 6px !important; }

#videoContainer.small .overlay .button {
  width: 50px !important;
  height: 50px !important;
}

#videoContainer.small .time { display: none !important; }

#videoContainer .overlay {
  width: 100%;
  height: 100%;
  background: radial-gradient(circle, rgba(77, 191, 140, 0.9), rgba(41, 115, 82, 0.9));
  position: absolute;
  top: 0;
  left: 0;
  z-index: 999;
  border-radius: 5px;
}

#videoContainer .overlay .button {
  width: 80px;
  height: 80px;
  position: absolute;
  top: 50%;
  left: 50%;
  background: url(play-button.svg);
  background-size: 100% 100%;
  transform: translate(-50%, calc(-50% - 30px));
  cursor: pointer;
  transition: width 0.2s, height 0.2s;
}

#videoContainer .overlay .button:hover {
  width: 90px;
  height: 90px;
}

#videoContainer #video {
  width: 100%;
  height: calc(100% - 60px);
  position: relative;
  top: 0;
  left: 0;
  overflow: hidden;
  border-radius: 5px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

#videoContainer #video video {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 5px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

#videoContainer #controls {
  width: 100%;
  height: 60px;
  background: #4dbf8c;
  position: absolute;
  right: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom-right-radius: 5px;
  border-bottom-left-radius: 5px;
  z-index: 9999;
}

#videoContainer #controls .playButton {
  width: 70px;
  height: 100%;
  background: #4dbf8c;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 20px;
  cursor: pointer;
  transition: all 0.4s;
  border-bottom-left-radius: 5px;
}

#videoContainer #controls .playButton:hover { background: #41b682; }

#videoContainer #controls .playButton .playPause {
  width: 25px;
  height: 25px;
  background: url(play.svg);
  background-size: 100% 100%;
}

#videoContainer #controls .ProgressContainer {
  color: #fff;
  width: calc(100% - 100px);
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  position: relative;
}

#videoContainer #controls .ProgressContainer .progressBar {
  width: 100%;
  height: 8px;
  background: #39a072;
  border-radius: 20px;
  cursor: pointer;
  overflow: hidden;
}

#videoContainer #controls .ProgressContainer .progressBar:hover + .time {
  opacity: 1;
  transform: translateY(0);
}

#videoContainer #controls .ProgressContainer .progressBar .progress {
  width: 0%;
  height: 100%;
  background: #fff;
  border-radius: 20px;
}

#videoContainer #controls .ProgressContainer .timer {
  margin: 0 10px;
  font-family: Arial, sans-serif;
  font-weight: 300;
  font-size: 12px;
  font-weight: 300;
  color: #2c7a57;
  letter-spacing: 1px;
}

#videoContainer #controls .ProgressContainer .time {
  width: 80px;
  height: 25px;
  background: #2c7a57;
  position: absolute;
  top: -20px;
  left: 0;
  border-radius: 5px;
  color: #fff;
  font-family: Arial, sans-serif;
  text-align: center;
  line-height: 25px;
  font-size: 12px;
  letter-spacing: 1px;
  opacity: 0;
  transform: translateY(10px);
  transition: transform 0.3s, opacity 0.3s;
}

#videoContainer #controls .ProgressContainer .time::after {
  content: "";
  display: block;
  width: 0;
  height: 0;
  position: absolute;
  top: 25px;
  left: 33px;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-top: 6px solid #2c7a57;
}

#videoContainer #controls .volume {
  width: 150px;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  position: relative;
}

#videoContainer #controls .volume .icon {
  width: 25px;
  height: 25px;
  background: url(volume.svg);
  background-size: 100% 100%;
  cursor: pointer;
  margin-right: 10px;
}

#videoContainer #controls .volume .intensityBar {
  width: 100px;
  height: 4px;
  background: #39a072;
  border-radius: 20px;
  max-width: 100px;
  overflow: hidden;
  transform-origin: right center;
  cursor: pointer;
  transition: all 0.5s;
}

#videoContainer #controls .volume .intensityBar .intensity {
  width: 50%;
  height: 100%;
  background: #fff;
}

#videoContainer #controls .scale {
  width: 70px;
  height: 100%;
  background: #4dbf8c;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 5px;
  cursor: pointer;
  transition: all 0.4s;
  border-bottom-right-radius: 5px;
}

#videoContainer #controls .scale:hover { background: #40b27f; }

#videoContainer #controls .scale .icon {
  width: 25px;
  height: 25px;
  background-size: 100% 100%;
  background: url(expand.svg);
  background-size: 100% 100%;
}
</style>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet portlet-sortable box blue-chambray ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-magnifier"></i>
                            <span class="caption-subject font-green sbold uppercase">讨论交流区 </span>
                        </div>
                    </div>
                    <input type="hidden" name="" id="movie_id" value="<?php echo $movie_info->lession_id; ?>">
                    <input type="hidden" name="" id="sub_url" value="<?=base_url()?>school/send_message">
                    <input type="hidden" name="" id="doctor_name" value="<?php echo $this->session->userdata('usr_name'); ?>">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                    <div id="videoContainer">
                                      <div class="overlay">
                                        <div class="button"></div>
                                      </div>
                                      <div id="video">
                                        <video src="<?=base_url()?><?php echo $movie_info->url; ?>"> </video>
                                      </div>
                                      <div id="controls">
                                        <div class="playButton">
                                          <div class="playPause"></div>
                                        </div>
                                        <div class="ProgressContainer">
                                          <div class="timer intialTime"> 00:00 </div>
                                          <div class="progressBar">
                                            <div class="progress"></div>
                                          </div>
                                          <div class="time"> 00:00 </div>
                                          <div class="timer fullTime"> 00:00 </div>
                                        </div>
                                        <div class="volume">
                                          <div class="icon"></div>
                                          <div class="intensityBar">
                                            <div class="intensity"></div>
                                          </div>
                                        </div>
                                        <div class="scale">
                                          <div class="icon"></div>
                                        </div>
                                      </div>
                                    </div> 

<!--                     <div class="input-group" style="text-align:left">
                        <input type="text" class="form-control" name="username1" id="username1_input">
                        <span class="input-group-btn">
                            <a href="javascript:send_message();" class="btn green" id="username1_checker" data-original-title="" title="" aria-describedby="popover624672">
                                <i class="fa fa-check"></i> send </a>
                        </span>
                    </div>     -->                                                            
                            </div>
                        <div class="col-lg-4 col-md-12 col-sm-6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bubble font-hide hide"></i>
                                        <span class="caption-subject font-hide bold uppercase">消息区</span>
                                    </div>
<!--                                     <div class="actions">
                                        <div class="portlet-input input-inline">
                                            <div class="input-icon right">
                                                <i class="icon-magnifier"></i>
                                                <input type="text" class="form-control input-circle" placeholder="search..."> </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="portlet-body" id="chats">
                                    <div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="chats">
                                        <?php foreach ($post_info as $value) { ?>
                                            <li class="in">
                                                <img class="avatar" alt="" src="<?=base_url()?>assets/layouts/layout/img/avatar1.jpg" />
                                                <div class="message">
                                                    <span class="arrow"> </span>
                                                    <a href="javascript:;" class="name"><?php echo $value->usr_name; ?></a>
                                                    <span class="datetime"> at <?php echo $value->post_time; ?></span>
                                                    <span class="body"> <?php echo $value->post_content; ?></span>
                                                </div>
                                            </li>
                                        <?php } ?>

                                        </ul>
                                    </div>
                                    <div class="chat-form">
                                        <div class="input-cont">
                                            <input class="form-control" type="text" placeholder="Type a message here..." /> </div>
                                        <div class="btn-cont">
                                            <span class="arrow"> </span>
                                            <a href="" class="btn blue icn-only">
                                                <i class="fa fa-check icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                            
                        </div>

                                             
                    </div>                
                </div>
            </div>
        </div>        
    </div>
    <!-- END CONTENT BODY -->
  </div>

<script src="http://code.jquery.com/jquery-3.1.1.slim.min.js"></script> 
<script>
$(document).ready(function () {

    'use strict';

    var play_pause     = $('.playButton'),
        container      = $('#videoContainer'),
        playIcon       = $('.playButton .playPause'),
        video          = $('video'),
        play           = $('.play'),
        volume         = $('.volume .icon'),
        volumeIntesity = $('.volume .intensityBar'),
        intensity      = $('.intensity'),
        progressBar    = $('.progressBar'),
        progress       = $('.progressBar .progress'),
        timer          = $('.intialTime'),
        vidDuration    = $('.fullTime'),
        expandButton   = $('.scale .icon'),
        overlayScreen  = $('.overlay'),
        timeState      = $('.time'),
        overlayButton  = $('.overlay .button'),
        update;


    $(window).resize(function () { resizeVid(); });

    resizeVid();

    updateplayer();

    play_pause.add(video).click(function () { playVid(); });

    progressBar.click(function () {skip(); });

    progressBar.mousemove(function () { timeState.text(getTimeState()); });

    volume.click(function () { toggleMute(); });

    volumeIntesity.click(function () { changeVolume(); });

    expandButton.click(function () { fullScreen(); });

    overlayButton.click(function () { playVid();});
  
    vidDuration.text(getFormatedFullTime());


    function playVid() {
        if (video.get(0).paused) {
            video.get(0).play();
            playIcon.css({
               'background': 'url(../../assets/video/pause.svg)',
               'background-size': '100% 100%'
            });
            overlayScreen.hide();
            update = setInterval(updateplayer, 1);

        } else {
            video.get(0).pause();
            playIcon.css({
               'background': 'url(../../assets/video/play.svg)',
               'background-size': '100% 100%'
            });
            overlayScreen.show();
            clearInterval(update);
        }
    }
  
    function updateplayer() {
        var percentage = (video[0].currentTime / video[0].duration) * 100;
        progress.css({'width': percentage + '%'});
        timer.text(getFormatedTime());
        vidDuration.text(getFormatedFullTime());

        if (video[0].ended) {
            playIcon.css({
               'background': 'url(../../assets/video/play.svg)',
               'background-size': '100% 100%'
            });
            overlayScreen.show();
            overlayButton.css({
               'background': 'url(../../assets/video/replay.svg)',
               'background-size': '100% 100%'
            });
        } else if (video[0].paused) {
            overlayButton.css({
               'background': 'url(../../assets/video/play-button.svg)',
               'background-size': '100% 100%'
            });
        }
    }

    function getTimeState() {

      var mouseX = event.pageX - progressBar.offset().left,
          width  = progressBar.outerWidth();

       var currentSeconeds = Math.round((mouseX / width) * video[0].duration);
       var currentMinutes  = Math.floor(currentSeconeds/60);

       if (currentMinutes > 0) {
          currentSeconeds -= currentMinutes * 60;
       }
       if (currentSeconeds.toString().length === 1) {
           currentSeconeds = "0" + currentSeconeds;
        }
        if (currentMinutes.toString().length === 1) {
            currentMinutes = "0" + currentMinutes;
        }

        timeState.css('left', (mouseX / width) * progressBar.width() + 18 + 'px');

        return currentMinutes + ':' + currentSeconeds;

    }

    function skip() {
        var mouseX = event.pageX - progressBar.offset().left,
            width  = progressBar.outerWidth();
       video[0].currentTime = (mouseX / width) * video[0].duration;
       updateplayer();
    }

    function getFormatedFullTime() {

         var totalSeconeds = Math.round(video[0].duration);
         var totalMinutes  = Math.floor(totalSeconeds/60);
         if (totalMinutes > 0) {
            totalSeconeds -= totalMinutes * 60;
         }
         if (totalSeconeds.toString().length === 1) {
             totalSeconeds = "0" + totalSeconeds;
          }
          if (totalMinutes.toString().length === 1) {
              totalMinutes = "0" + totalMinutes;
          }
        return totalMinutes + ':' + totalSeconeds;
    }

     function getFormatedTime() {
         var seconeds = Math.round(video[0].currentTime);
         var minutes  = Math.floor(seconeds / 60);

          if (minutes > 0) {
            seconeds -= minutes * 60;
         }
         if (seconeds.toString().length === 1) {
             seconeds = "0" + seconeds;
          }
          if (minutes.toString().length === 1) {
              minutes = "0" + minutes;
          }
         return minutes + ':' + seconeds;
     }

    function toggleMute() {
        if (!video[0].muted) {
           video[0].muted = true;
           volume.css({
              'background': 'url(../../assets/video/mute.svg)',
              'background-size': '100% 100%'
           });
           intensity.hide();
        } else {
           video[0].muted = false;
           volume.css({
              'background': 'url(../../assets/video/volume.svg)',
              'background-size': '100% 100%'
           });
           intensity.show();
        }
    }

    function changeVolume() {
       var mouseX = event.pageX - volumeIntesity.offset().left,
           width  = volumeIntesity.outerWidth();

       video[0].volume = (mouseX / width);
       intensity.css('width', (mouseX / width) * width + 'px');
       video[0].muted = false;
       volume.css({
          'background': 'url(../../assets/video/volume.svg)',
          'background-size': '100% 100%'
       });
       intensity.show();
    }

    function fullScreen() {
        if (video[0].requestFullscreen) {
           video[0].requestFullscreen();
        } else if (video[0].webkitRequestFullscreen) {
           video[0].webkitRequestFullscreen();
        } else if (video[0].mozRequestFullscreen) {
           video[0].mozRequestFullscreen();
        } else if (video[0].msRequestFullscreen) {
           video[0].msRequestFullscreen();
        } else {
           video.dblclick(function () { fullScreen(); });
        }

    }

    function resizeVid() {
       if (container.width() < 600) {
          container.addClass('small');
       } else {
          container.removeClass('small');
       }
    }

    // $(window).keypress(function (e) {
    //    if (e.keyCode === 0 || e.keyCode === 32) {
    //       e.preventDefault()
    //       playVid();
    //    }
    // });
  



});


  function send_message(){
    alert ("dddd");
  }
</script>  

