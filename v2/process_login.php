<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['face_image']) && !empty($_POST['face_image'])) {
        $face_image = $_POST['face_image'];

        // Log face image base64
        error_log("Received Face Image: " . substr($face_image, 0, 30)); // Log sebagian kecil data base64 untuk debugging

        // Dapatkan data user lainnya
        $email = isset($_POST['username']) ? mysqli_real_escape_string($con, trim($_POST['username'] ?? '')) : '';
        $pass = isset($_POST['password']) ? sha1(trim($_POST['password'] ?? '')) : '';
        $level = trim($_POST['level'] ?? '');

        // Tentukan query SQL berdasarkan level user
        $sql = "";
        $redirect_url = "";

        if ($level == '1') {
            $sql = "SELECT * FROM tb_guru WHERE email='$email' AND password='$pass' AND status='Y'";
            $redirect_url = 'Guru/index.php';
        } elseif ($level == '2') {
            $sql = "SELECT * FROM tb_siswa WHERE nis='$email' AND password='$pass' AND aktif='Y'";
            $redirect_url = 'Siswa/index.php';
        } elseif ($level == '3') {
            $sql = "SELECT * FROM tb_admin WHERE username='$email' AND password='$pass'";
            $redirect_url = 'Admin/index.php';
        }

        // Eksekusi query SQL jika ada
        if ($sql) {
            $login = mysqli_query($con, $sql);
            $data = mysqli_fetch_array($login);

            if ($data) {
                // Simpan data ke dalam session
                if ($level == '1') {
                    $_SESSION['Guru'] = $data['id_guru'];
                    $_SESSION['id_siswa'] = null;
                    $_SESSION['Admin'] = null;
                } elseif ($level == '2') {
                    $_SESSION['Siswa'] = $data['id_siswa'];
                    $_SESSION['id_siswa'] = $data['id_siswa'];
                    $_SESSION['Admin'] = null;
                } elseif ($level == '3') {
                    $_SESSION['Admin'] = $data['id_admin'];
                    $_SESSION['Guru'] = null;
                    $_SESSION['id_siswa'] = null;
                }

                // Simpan wajah ke file
                $face_image = str_replace('data:image/png;base64,', '', $face_image);
                $face_image = str_replace(' ', '+', $face_image);
                $face_data = base64_decode($face_image);
                $face_filename = 'faces/face.png';
                file_put_contents($face_filename, $face_data);
                
                // Pastikan data 'foto' ada dan bukan null
                $wajah_file = isset($data['foto']) ? 'vendor/images/img_Siswa/'.$data['foto'] : '';
                if ($wajah_file && file_exists($wajah_file)) {
                    // Salin file foto dari lokasi asli ke 'face/profil.png'
                    copy($wajah_file, "faces/profil.png");
                    echo "<img src=\"$face_filename\" height='124px'>";
                    echo "<img src='faces/profil.png' height='124px'><br>";

                    // Eksekusi skrip Python untuk verifikasi wajah
                    $pythonPath = "C:\\Users\\risan\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
                    $scriptPath = "compare_faces.py";
                    $command = escapeshellcmd("$pythonPath $scriptPath");
                    $output = shell_exec($command . " 2>&1");
                    var_dump($command);
                    echo "<br>";
                    var_dump($output);
                    error_log("Python Script Output: " . $output); // Log output skrip Python untuk debugging

                    if (trim($output) == 'Match') {
                        header("Location: $redirect_url");
                        exit;
                    } else {
                        echo "error";
                        echo "<script>alert('Face recognition failed. Please try again.'); window.location.href = 'index.php';</script>";
                    }
                } else {
                    echo "error";
                    echo "<script>alert('Face data not found in the database.'); window.location.href = 'index.php';</script>";
                }
            } else {
                echo "error";
                echo "<script>alert('Incorrect username or password. Please try again.'); window.location.href = 'index.php';</script>";
            }
        } else {
            echo "error";
            echo "<script>alert('Invalid user level.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "error";
        echo "<script>alert('Face recognition required.'); window.location.href = 'index.php';</script>";
    }
}
?>
