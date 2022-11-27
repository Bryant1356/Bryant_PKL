<?php
$title = 'home';
include '../components/config.php';
include '../components/meta.php';
include '../components/navbar.php';
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <video id="video" width="640" height="640" autoplay class="rounded-circle"></video>
                <!-- <button id="snap">Snap Photo</button> -->
                <input type="file" name="pict" id="image-input" onchange="readURL(this);" class="d-none" accept="image/*;capture=camera">
                <label for="pict" id="snap" class="fw-bold text-center text-bg-primary p-2">Snap Photo</label>
                <a href="#!" class="btn btn-success" onClick="start()">
                    Start Cam
                </a>
                <a href="#!" class="btn btn-danger" onClick="stop()">
                    Stop Cam
                </a>
                <canvas id="canvas" width="640" height="640" class="rounded-circle"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://navigator.getUserMedianavigator.mediaDevices.getUserMedia"></script> -->
<script>
    var stop = function() {
        var stream = video.srcObject;
        var tracks = stream.getTracks();
        for (var i = 0; i < tracks.length; i++) {
            var track = tracks[i];
            track.stop();
        }
        video.srcObject = null;
    }

    var start = function() {
        var video = document.getElementById('video'),
            vendorUrl = window.URL || window.webkitURL;
        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                }).catch(function(error) {
                    console.log("Something went wrong!");
                });
        }
    }

    var video = document.getElementById('video');

    // Get access to the camera!
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({
            video: true
        }).then(function(stream) {
            //video.src = window.URL.createObjectURL(stream);
            video.srcObject = stream;
            video.play();
        });
    }

    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');

    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, 0, 0, 640, 480);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#canvas').attr('src', e.target.result).width(150).height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>