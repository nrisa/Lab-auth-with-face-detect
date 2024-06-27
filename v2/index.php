<?php
    session_start();
    if (isset($_SESSION['error_message'])) {
        echo "<script>
            Swal.fire({
                title: 'Login Failed',
                text: '" . $_SESSION['error_message'] . "',
                icon: 'error'
            });
        </script>";
        unset($_SESSION['error_message']); // Hapus pesan kesalahan setelah ditampilkan
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Learning Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="vendor/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="vendor/login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="vendor/login/css/main.css">
    <link rel="stylesheet" href="vendor/node_modules/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendor/node_modules/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendor/css/style.css">
    <link href="vendor/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface"></script>
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('vendor/login/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <center><img src="vendor/images/Logo-Cover.png" alt="Logo" height="120" width="110"></center>
                <div style="position: fixed; top: -100px">
                    <video id="video" width="80" height="68" autoplay></video>
                    <canvas id="canvas" width="80" height="68"></canvas>
                </div>
                <form id="loginForm" method="post" action="process_login.php" class="login100-form validate-form">
                    <span class="login100-form-title p-b-49">
                        E-LEARNING LOGIN
                    </span>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Type your username" required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password" required>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="User type is required">
                        <span class="label-input100">User Level</span>
                        <select name="level" class="form-control" required style="background-color: #212121; border-radius: 7px; color: #fff; font-weight: bold;">
                            <option value="">-- Pilih Level --</option>
                            <option value="1">Guru</option>
                            <option value="2">Siswa</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>
                    <div class="text-right p-t-8 p-b-31">
                        <a href="https://wa.me/6282311801697">
                            Forgot password?
                        </a>
                    </div>
                    <div class="container-login100-form-btn m-b-23">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button id="loginBtn" type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="face_image" name="face_image">
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/login/vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/login/vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/login/vendor/select2/select2.min.js"></script>
    <script src="vendor/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/login/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/login/vendor/countdowntime/countdowntime.js"></script>
    <script src="vendor/login/js/main.js"></script>

    <script>
        async function detectFace() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            let faceDetected = false;

            const model = await blazeface.load();

            async function detect() {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const faces = await model.estimateFaces(canvas, false);

                if (faces.length > 0 && !faceDetected) {
                    faceDetected = true;
                    console.log('Face detected');
                    const face_image = canvas.toDataURL('image/png');
                    document.getElementById('face_image').value = face_image;
                    console.log("Detected face image: " + face_image); // Tambahkan log ini untuk memastikan gambar terdeteksi
                } else if (faces.length === 0 && faceDetected) {
                    faceDetected = false;
                    console.log('Face lost');
                    Swal.fire({
                        title: 'Wajah Tidak Terdeteksi',
                        text: 'Jangan ada objek yang menutupi wajah.',
                        icon: 'warning',
                        showConfirmButton: true
                    });
                }

                requestAnimationFrame(detect);
            }

            detect();
        }

        detectFace();

        navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: "user"
            },
            audio: false
        }).then(stream => {
            const video = document.getElementById('video');
            video.srcObject = stream;
        }).catch(err => {
            console.error("Error accessing webcam: ", err);
        });
    </script>
</body>
</html>
