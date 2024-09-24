/*    reloadDetectRTC();
    function reloadDetectRTC() {
        DetectRTC.load(onDetectRTCLoaded);
    }

    function onDetectRTCLoaded() {
        if(DetectRTC.hasMicrophone==true)
        {
            if(DetectRTC.isWebsiteHasMicrophonePermissions==false){
                alert("Please allow microphone in your browser setting to start program");
                return false;
            }
        }
        else
        {
            alert("You cannot start program. Because no microphone detected to your system.");
            window.location.href = SITE_URL+"/student/dashboard";
        }
    }*/
    /* Script for Audio Horn Play Pause */
    $('#hornButton').removeClass('stop-pause');
    $('#hornButton').removeClass('stop-playing');
    $('.questionCls').val('');
    
    if(is_answer=='no')
    {
        playHorn();
    }
    /* height calculate script */
        if($(".game-img-section").height() != 'undefined')
        { $(".game-fill-text-section").css('height', $(".game-img-section").height()); }

    /* Timer script start*/
    $(function(){
        if((sessionStorage.getItem('remaining_minutes_'+storage_id)!=null && sessionStorage.getItem('remaining_minutes_'+storage_id)!=undefined) && (sessionStorage.getItem('remaining_seconds_'+storage_id)!=null && sessionStorage.getItem('remaining_seconds_'+storage_id)!=undefined) && is_answer=='no')
        {
            t_minutes   = (isNaN(sessionStorage.getItem('remaining_minutes_'+storage_id))) ? 0 : sessionStorage.getItem('remaining_minutes_'+storage_id);
            t_seconds   = (isNaN(sessionStorage.getItem('remaining_seconds_'+storage_id))) ? 0 : sessionStorage.getItem('remaining_seconds_'+storage_id);
        }
        /*hours           = parseInt(hours);*/
        t_minutes       = parseInt(t_minutes);
        t_seconds       = parseInt(t_seconds);
        var script_url = SITE_URL+"/js/front/jquery.countdownTimer.js";
        $.getScript( script_url, function() {
            $('#hm_timer_'+uniqid).countdowntimer({
                method       : "init",
                minutes      : t_minutes,
                seconds      : t_seconds,
                timeUp       : timeisUp,
                displayFormat: "MS",
                tickInterval : 1,
                size         : "md"
            });
        });
        /*$(document).ready(function(){
        });*/
    });
    /* Timer script ends*/

    /* Script for Audio Horn Play Pause starts */
    var isPlaying = false;
    function playHorn()
    {
        var horn      = document.getElementById("horn");
        var isPlaying = false;
        $('#hornButton').addClass('stop-playing');
        horn.play();
    }

    horn.onended = function() {
      $('#hornButton').removeClass('stop-pause');
      $('#hornButton').removeClass('stop-playing');
    };

    horn.onplaying = function() {
      isPlaying = true;
      $('#hornButton').removeClass('stop-pause');
      $('#hornButton').addClass('stop-playing');
    };
    horn.onpause = function() {
      isPlaying = false;
      $('#hornButton').removeClass('stop-playing');
      $('#hornButton').addClass('stop-pause');
    };
    
    function togglePlay() {
      if (isPlaying) {
        horn.pause();
      } else {
        horn.play();
      }
    };
    /* Script for Audio Horn Play Pause ends */

    /* Recording the Sound Start */
    var browser = function() {
    if (browser.prototype._cachedResult)
        return browser.prototype._cachedResult;

    // Opera 8.0+
    var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

    // Firefox 1.0+
    var isFirefox = typeof InstallTrigger !== 'undefined';

    // Safari 3.0+ "[object HTMLElementConstructor]" 
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);

    // Internet Explorer 6-11
    var isIE = /*@cc_on!@*/false || !!document.documentMode;

    // Edge 20+
    var isEdge = !isIE && !!window.StyleMedia;

    // Chrome 1+
    var isChrome = !!window.chrome && !!window.chrome.webstore;

    // Blink engine detection
    var isBlink = (isChrome || isOpera) && !!window.CSS;

    return browser.prototype._cachedResult =
        isOpera ? 'Opera' :
        isFirefox ? 'Firefox' :
        isSafari ? 'Safari' :
        isChrome ? 'Chrome' :
        isIE ? 'IE' :
        isEdge ? 'Edge' :
        isBlink ? 'Blink' :
        "Don't know";
    };

    if(browser() == 'IE')
    {   
        sessionStorage.setItem('isRecorded_'+storage_id,'no');
        sessionStorage.setItem('isRecordingStart_'+storage_id,'no');
        $('#recordButton').on('click', function() {
            $('#wrong_answer_msg_box').hide();
            $('#right_answer_msg_box').hide();
            $('#answer_not_recorded_msg_box').hide();
            horn.pause();
            $('#flash_record').click();
            $('#recordButton').removeClass('stop-playing ');
            $('#recordButton').removeClass('start-recording ');
            $('#recordButton').addClass('start-recording ');
            sessionStorage.setItem('isRecordingStart_'+storage_id,'yes');
            $('#answer_not_recorded_msg_box').hide();
        }).on('mouseup mouseleave', function(e) {
            if(sessionStorage.getItem('isRecordingStart_'+storage_id)=='yes')
            {
                $('#flash_record_play').click();
                $('#recordButton').removeClass('start-recording ');
                $('#recordButton').addClass('stop-playing ');
                sessionStorage.setItem('isRecorded_'+storage_id,'yes');
                checkFinalAnswer();
            }
        });
    }
    else
    {
        sessionStorage.setItem('isRecorded_'+storage_id,'no');
        sessionStorage.setItem('isRecordingStart_'+storage_id,'no');
        $('#recordButton').on('click', function() {
            $('#wrong_answer_msg_box').hide();
            $('#right_answer_msg_box').hide();
            $('#answer_not_recorded_msg_box').hide();
            horn.pause();
            $('#record').click();
            $('#recordButton').removeClass('stop-playing ');
            $('#recordButton').removeClass('start-recording ');
            $('#recordButton').addClass('start-recording ');
            sessionStorage.setItem('isRecordingStart_'+storage_id,'yes');
            $('#answer_not_recorded_msg_box').hide();
                Fr.voice.stopRecordingAfter(120000, function(){
                    $('#play').click();
                    $('#recordButton').removeClass('stop-playing ');
                    $('#recordButton').removeClass('start-recording ');
                    $('#recordButton').addClass('start-recording ');
                    sessionStorage.setItem('isRecorded_'+storage_id,'yes');
                    checkFinalAnswer();
                        /*Fr.voice.export(function(blob){
                        var file       = new File([blob], 'student_audio_'+question_id+'.wav');
                        var fileName   = 'Student_Recording.wav';
                        var fileObject = new File([blob], fileName, {
                                            type: 'audio/wav'
                                        });
                        formData.append('audio_file', fileObject);
                        formData.append('audio_filename', fileObject.name); 
                    }, "blob");*/
                });

        }).on('mouseup mouseleave', function(e) {
            if(sessionStorage.getItem('isRecordingStart_'+storage_id)=='yes')
            {
                $('#play').click();
                $('#recordButton').removeClass('start-recording ');
                $('#recordButton').addClass('stop-playing ');
                sessionStorage.setItem('isRecorded_'+storage_id,'yes');
                checkFinalAnswer();
            }
            /*if(sessionStorage.getItem('isRecordingStart_'+storage_id)=='yes')
            {
                Fr.voice.export(function(blob){
                    var file       = new File([blob], 'student_audio_'+question_id+'.wav');
                    var fileName   = 'Student_Recording.wav';
                    var fileObject = new File([blob], fileName, {
                                        type: 'audio/wav'
                                    });
                    formData.append('audio_file', fileObject);
                    formData.append('audio_filename', fileObject.name); 
                    sessionStorage.setItem('isRecorded_'+storage_id,'yes');
                    sessionStorage.setItem('isRecordingStart_'+storage_id,'no');
                }, "blob");
            }*/
        });
    }
    /* Recording the Sound End */