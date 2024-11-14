<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Koperasi Untung Bareng</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('public/landing/assets') }}/img/favicon.png" rel="icon">
  <link href="{{ asset('public/landing/assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('public/landing/assets') }}/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('public/landing/assets') }}/css/style_kub.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <a href="{{ url('/') }}"><img src="{{ asset('public/landing/assets') }}/img/logokop.png" alt="" class="img-fluid"
            width="100px"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Untungnya Apa?</a></li>
          <li><a class="nav-link scrollto" href="#category">Produk</a></li>
          <li><a class="nav-link scrollto " href="#why-us">Tentang KUB</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          <li><a href="{{ url('/login') }}" class="nav-link">Masuk</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="hero-info" data-aos="zoom-in" data-aos-delay="100">
        <h2>KOPERASI KARYAWAN <br>
          UNTUNG BARENG
          </h2>
        <div>
          <a href="{{ url('/registrasi_anggota') }}" target="_blank" class="btn-get-started scrollto">DAFTAR</a>
          <a href="{{ url('/login') }}" target="_blank" class="btn-get-started scrollto">MASUK</a>
        </div>
      </div>
      <span class="arrow-down"></span>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 col-sm-12 about-box">
            <h2>UNTUNGNYA <br> <span class="what-size">APA?</span></h2>
            <img class="whats-img" src="{{ asset('public/landing/assets/images/layer_10.png') }}" alt="">
          </div>
          <div class="col-lg-6 col-sm-12 about-box">
            <h4>JADI ANGGOTA KUB</h4>

            <div class="box-keypoint">
              <div class="box">
                <img src="{{ asset('public/landing/assets/images/vector_smart_object.png') }}" alt="">
                <span>Beli Barang atau
                  Jasa Lebih Murah
                  dan Bisa Dicicil</span>
              </div>

              <div class="box">
                <img src="{{ asset('public/landing/assets/images/vector_smart_object_2.png') }}" alt="">
                <span>Bisa Pinjam Uang
                  Bunganya Ringan</span>
              </div>

              <div class="box">
                <img src="{{ asset('public/landing/assets/images/vector_smart_object_3.png') }}" alt="">
                <span>Ada Sisa Hasil Usaha</span>
              </div>
            </div>
          </div>
        </div>

        {{--  <span class="arrow-down-about"></span>  --}}
      </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Category Section ======= -->
    <section id="category">
      <div data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 col-sm-12 box-category"
              style="background-image:url({{ asset('public/landing/assets/images/layer_14.png') }})">
          <a href="{{ url('category/2') }}">

              <h3>ELEKTRONIK</h3>
          </a>
            </div>
              <div class="col-lg-6 col-sm-12 box-category"
              style="background-image: url({{ asset('public/landing/assets/images/layer_16.png') }})">
          <a href="{{ url('category/1') }}">

              <h3>BAHAN POKOK</h3>
          </a>
            </div>
          
            <div class="col-lg-6 col-sm-12 box-category"
              style="background-image: url({{ asset('public/landing/assets/images/layer_15.png') }})">
          <a href="{{ url('category/4') }}">

              <h3>SEPEDA MOTOR</h3>
          </a>
            </div>
          </a>
            <div class="col-lg-6 col-sm-12 box-category"
              style="background-image: url({{ asset('public/landing/assets/images/layer_17.png') }})">
          <a href="{{ url('category/3') }}">
            <h3>FURNITURE</h3>
          </a>
            </div>
        </div>
      </div>
    </section><!-- End Category Section -->
    
    <!-- ======= Why Us Section ======= -->
    
      <section id="why-us">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h3>Visi dan Misi</h3>
          <p>Mensejahterakan dan membantu mengembangkan taraf perekonomian para karyawan yang menjadi anggota koperasi.</p>
        </header>

        <div class="row row-eq-height justify-content-center">
          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="100">
              <i class="bi bi-calendar4-week"></i>
              <div class="card-body">
                <h5 class="card-title">Koperasi Profesional</h5>
                <br>
                <p class="card-text">Mewujudkan Koperasi yang sehat dan pengurus yang profesional.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="200">
              <i class="bi bi-people"></i>
              <div class="card-body">
                <h5 class="card-title">Layanan Anggota</h5>
                <br>
                <p class="card-text">Menyediakan produk dan jasa yang lengkap sesuai dengan kebutuhan Karyawan.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="300">
              <i class="bi bi-reception-4"></i>
              <div class="card-body">
                <h5 class="card-title">Ekonomi Karyawan</h5>
                <br>
                <p class="card-text">Menjaga dan meningkatkan pertumbuhan pendapatan Karyawan.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- End Portfolio Section -->
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="section-bg">
      <div class="container" data-aso="zoom-in">

        <header class="section-header">
          <h3>Struktur Organisasi</h3>
        </header>
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <img src="{{ asset('public/landing/assets') }}/img/struktur.png" class="img-fluid" alt="" height="700px">
          </div>
        </div>
        
        <br>
        <header class="section-header">
          <h3>Alur Pembelian dan Pinjaman</h3>
        </header>

        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ asset('public/landing/assets') }}/img/flow_pembelian_new.png" class="img-fluid" alt="">
                    <p>
                      Alur Pembelian Barang Konsumsi Kebutuhan Rumah Tangga
                    </p>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ asset('public/landing/assets') }}/img/flow_pinjaman.png" class="img-fluid" alt="">
                    <p align="center">
                      Alur Simpan Pinjam
                    </p>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ asset('public/landing/assets') }}/img/flow_pembelian_po.png" class="img-fluid" alt="">
                    <p>
                      Alur Pembelian Barang PO (Pre Order)
                    </p>
                  </div>
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>

          </div>
        </div>

      </div>
    </section>
    

    <!-- ======= Contact Section ======= -->
    <section id="contact">
      <div class="container-fluid" data-aos="fade-up">

        <div class="section-header">
          <h3>Hubungi Kami</h3>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="map mb-4 mb-lg-0">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1607795013565!2d106.79921467357585!3d-6.242530861123995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1693f0c4d55%3A0xac2b45a87d48b59c!2sPantarei%20Communications!5e0!3m2!1sid!2sid!4v1687902286374!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 340px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-5 info">
                <i class="bi bi-geo-alt"></i>
                <p>{{ companySetting('alm_koperasi') }}</p>
              </div>
              <div class="col-md-4 info">
                <i class="bi bi-envelope"></i>
                <p><a href="#" class="__cf_email__" data-cfemail="dcb5b2bab39cb9a4bdb1acb0b9f2bfb3b1">{{ companySetting('email_koperasi') }}</a></p>
              </div>
            </div>

            <div class="form">
              <form action="#" method="post" role="form" class="php-email-form">
                <div class="row">
                  <div class="form-group col-lg-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama" required>
                  </div>
                  <div class="form-group col-lg-6 mt-3 mt-lg-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Pesan" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit" title="Send Message"><i class="bi bi-send"></i> Kirim Pesan</button></div>
              </form>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container">
      <div class="copyright">
        <strong>Copyright &copy;PINC Group</strong>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('public/landing/assets') }}/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{ asset('public/landing/assets') }}/vendor/aos/aos.js"></script>
  <script src="{{ asset('public/landing/assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('public/landing/assets') }}/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('public/landing/assets') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('public/landing/assets') }}/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('public/landing/assets') }}/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('public/landing/assets') }}/js/main.js"></script>

</body>

</html>