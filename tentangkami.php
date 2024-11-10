<?php
session_start();
include 'koneksi.php';
?>
<?php include 'header.php'; ?>

<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Tentang</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center text-uppercase">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item text-white active" aria-current="page">Tentang</li>
				</ol>
			</nav>
		</div>
	</div>
</div>


<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 pt-4" style="min-height: 400px;">
                <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                    <img class="position-absolute img-fluid w-100 h-100" src="assets_home/img/bg1.jpg" style="object-fit: cover;" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-primary text-uppercase">About Us</h6>
                <h1 class="mb-4">PT Sri Nusantara Abadi</h1>
                <p class="text-white">PT Sri Nusantara Abadi adalah platform e-commerce yang menyediakan bahan-bahan premium berkualitas tinggi untuk kebutuhan dapur dan industri kuliner. Kami menawarkan produk-produk pilihan seperti vanilla, biji kopi, berbagai jenis bumbu, dan produk olahan kelapa (coconut) dengan mutu yang terjamin. Melalui layanan yang cepat dan aman, kami berkomitmen untuk memberikan pengalaman belanja yang nyaman bagi pelanggan, dari koki profesional hingga para pecinta kuliner.

Di PT Sri Nusantara Abadi, kami percaya bahwa bahan baku yang berkualitas akan meningkatkan hasil masakan dan minuman Anda. Selamat datang di toko kami, tempat Anda menemukan bahan terbaik untuk kreasi rasa yang tak terlupakan.</p>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>