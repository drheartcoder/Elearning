<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Basic demo of FlashWavRecorder</title>
    <!-- <script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/jquery.js"></script> -->
    <script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/swfobject.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/recorder.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/basic.js"></script>
    <link type="text/css" rel="stylesheet" href="{{url('/')}}/js/front/flash-recording/css/basic.css">
    <style>

        /* Styles for recorder buttons */
        .recorder button, .recorder .upload, .level {
            border: 1px solid #686868;
            height: 30px;
            background-color: white;
            display: inline-block;
            vertical-align: bottom;
            margin: 2px;
            box-sizing: border-box;
            border-radius: 4px;
        }

        /* Styles for level indicator - required! */
        .level {
            width: 30px;
            height: 30px;
            position: relative;
        }
        .progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #b10000;
        }
        .upload {
            padding-top: 2px;
        }

    </style>
</head>
<body>

<div class="container">
    <h1><span class="basic">Basic demo of</span><span class="project-name">FlashWavRecorder</span></h1>
    <section class="recorder-container">

        <!-- Recorder control buttons -->
        <div class="recorder">
            <button class="start-recording" onclick="FWRecorder.record('audio', 'audio.wav');">
                <img src="{{url('/')}}/js/front/flash-recording/images/record.png" alt="Record">
            </button>
            <div class="level">
                <div class="progress"></div>
            </div>
            <button class="stop-recording" onclick="FWRecorder.stopRecording('audio');">
                <img src="{{url('/')}}/js/front/flash-recording/images/stop.png" alt="Stop Recording"/>
            </button>
            <button class="start-playing" onclick="FWRecorder.playBack('audio');" title="Play">
                <img src="{{url('/')}}/js/front/flash-recording/images/play.png" alt="Play"/>
            </button>
            <div class="upload" style="display: inline-block">
                <div id="flashcontent">
                    <p>Your browser must have JavaScript enabled and the Adobe Flash Player installed.</p>
                </div>
            </div>
        </div>

        <!-- Hidden form for easy specifying the upload request parameters -->
        <form id="uploadForm" name="uploadForm" action="{{url('/')}}/js/front/flash-recording/upload.php">
            <input name="authenticity_token" value="xxxxx" type="hidden">
            <input name="upload_file[parent_id]" value="1" type="hidden">
            <input name="format" value="json" type="hidden">
        </form>
    </section>
</div>

</body>
</html>