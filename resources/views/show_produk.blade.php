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
  <link href="{{ asset('public/landing/assets') }}/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <a href="index.html"><img src="{{ asset('public/landing/assets') }}/img/logokop.png" alt="" class="img-fluid" width="100px"></a>
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
          <h2>Detail Barang</h2>
          
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
              
              <img src="{{ asset('public/images') }}/{{ $Produk->foto }}" alt="">
              </div>
            </div>
            
            
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Informasi Barang</h3>
              <ul>
                <li><strong>{{ $Produk->nama_barang }}</strong></li>
                <li><strong>{{ $Produk->kategori->kategori }}</strong></li>
                <li><strong>Rp. {{number_format($Produk->harga_jual,2) }}</strong></li>
                <p>
                  <small class="text-black">
                    Cicilan 12x Rp. {{ number_format(($Produk->harga_jual/12),2) }} / bulan   
                  </small>             
                </p>
                <li><strong>
                  @switch($Produk->status)
                    @case('Ready Stock')
                      <span class="badge badge-pill badge-success">{{ $Produk->status }}</span>
                      @break
                    @case('PreOrder')
                      <span class="badge badge-pill badge-secondary">{{ $Produk->status }}</span>
                      <p>
                        <small class="text-secondary">
                        <i>PreOrder dalam {{ $Produk->estimasi }} Hari</i>
                      </small></p>
                      @break
                    @case('Out of Stock')
                      <span class="badge badge-pill badge-warning">{{ $Produk->status }}</span>
                      @break
                    @case('Discontinue')
                      <span class="badge badge-pill badge-danger">{{ $Produk->status }}</span>
                    @break
                    @default
                      
                  @endswitch
                  
                </strong></li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Deskripsi Barang</h2>
              <p>{{ $Produk->deskripsi }}
              </p>
              <a href="javascript: history.go(-1)" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  Kembali</a>
              <a href="{{ url('/anggota/purchasing') }}" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i>  Buat Pesanan</a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

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