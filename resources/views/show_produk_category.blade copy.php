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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('public/landing/assets') }}/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('public/landing/assets') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('public/landing/assets') }}/css/style_kub.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <a href="{{ url('/') }}"><img src="{{ asset('public/landing/assets') }}/img/logokop.png" alt="" class="img-fluid"
            width="100px"></a>
      </div>

      {{--  <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Visi Misi</a></li>
          <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Catalog</a></li>
          <li><a class="nav-link scrollto" href="#team">Organisasi</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          <li><a href="{{ url('/login') }}" class="nav-link">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>  --}}

    </div>
  </header>
  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <ol>
            <li><a href="{{ url('/') }}"><< Kembali ke Beranda</a></li>
          </ol>
          {{--  <h2>Detail Barang</h2>  --}}
          
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio" class="clearfix">
      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h3 class="section-title">CATALOG PRODUK {{ strtoupper($NamaKategori) }}</h3>
        </header>

       {{--  <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Semua</li>
              <li data-filter=".filter-app">Eletronik & Gadget</li>
              <li data-filter=".filter-card">Sembako</li>
              <li data-filter=".filter-web">Furniture</li>
            </ul>
          </div>
        </div>  --}}
        <br>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          @foreach ($Produk as $p)
            <div class="col-lg-4 col-md-6 portfolio-item">
              <div class="portfolio-wrap">
                <img src="{{ asset('public/images') }}/{{ $p->foto }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4><a href="{{ url('/detail/'.$p->id) }}">{{ $p->nama_barang }}</a></h4>
                  <p>{{ $p->Kategori->kategori }}</p>
                  <p>Rp {{ number_format($p->harga_jual,2) }}</p>
                  @if ($p->cicilan=='Y')
                  <p>
                    <small class="text-white">
                      Cicilan 12x Rp. {{ number_format(($p->harga_jual/12),2) }} / bulan
                  </small>
                  </p>
                  @endif
                <div>                    
                    <a href="{{ url('/detail/'.$p->id) }}" class="link-details" title="More Details"><i class="bi bi-arrow-up-right-square"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- End Portfolio Details Section -->

  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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