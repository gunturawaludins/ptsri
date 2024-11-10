<?php
session_start();
include 'koneksi.php';
// if (!isset($_SESSION['pendaftaran'])) {
//     header("Location: daftar.php");
//     exit;
// }
?>
<?php include 'header.php'; ?>

<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" style="background-color: #a3a3a3;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Verifikasi OTP</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="contact-section">
    <div class="container">
        <div class="d-none d-sm-block mb-5 pb-4">
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-contact contact_form" method="post">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-title">Verifikasi OTP</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input name="otp" type="text" placeholder="Masukkan Kode OTP" class="form-control" maxlength="6" pattern="\d{6}" required>
                                <small>Masukkan 6 digit kode OTP yang telah dikirimkan ke email Anda.</small><br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="verifikasi" class="button button-contactForm btn-block boxed-btn">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['verifikasi'])) {
    $otp_input = $_POST['otp'];
    $pendaftaran = $_SESSION['pendaftaran'];

    // Cek apakah OTP valid dan belum kadaluarsa
    if ($otp_input == $pendaftaran['otp'] && date("Y-m-d H:i:s") < $pendaftaran['otp_expiry']) {
        // Simpan data ke database
        $koneksi->query("INSERT INTO pengguna (nama, email, password, alamat, telepon, fotoprofil, level) 
                         VALUES('{$pendaftaran['nama']}', '{$pendaftaran['email']}', '{$pendaftaran['password']}', '{$pendaftaran['alamat']}', '{$pendaftaran['telepon']}', 'Untitled.png', 'Pelanggan')");

        // Hapus sesi
        unset($_SESSION['pendaftaran']);

        echo "<script>alert('Pendaftaran berhasil. Selamat datang!')</script>";
        echo "<script>location='login.php';</script>";
    } else {
        echo "<script>alert('Kode OTP tidak valid atau sudah kadaluarsa. Silakan daftar ulang atau coba lagi.')</script>";
        
    }
}
?>
<?php include 'footer.php'; ?>