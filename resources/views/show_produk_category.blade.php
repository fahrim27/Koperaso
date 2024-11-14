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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{ asset('public/landing') }}/css/style.css">
    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'>


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
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio" class="clearfix">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h4 align="center" class="section-title">CATALOG PRODUK {{ strtoupper($NamaKategori) }}</h4>
          <small><i>*) Harga akan segera diperbarui dan harga dapat berubah sewaktu-waktu tanpa pemberitahuan</i></small>
        </header>
        <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
          <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            @foreach ($Produk as $p)
              <div class="col hp">
                <div class="card h-100 shadow-sm">
                  <a href="{{ url('/detail/'.$p->id) }}">
                    <img src="{{ asset('public/images') }}/{{ $p->foto }}" class="card-img-top" alt="product.title" />
                  </a>
                  {{--  <div class="label-top shadow-sm">
                    <a class="text-white" href="#">msi</a>
                  </div>  --}}
                  <div class="card-body">
                    <div class="clearfix mb-3">
                      <span class="float-start badge rounded-pill bg-info">Rp {{ number_format($p->harga_jual,2) }}</span>
          
                      
                      @if ($p->cicilan=='Y')                        
                        <p><small class="float-start"><a class="small text-muted text-small">Cicilan 12x Rp. {{ number_format(($p->harga_jual/12),2) }} / bulan</a></small></p> 
                      @endif
                    </div>
                    <h5 class="card-title font-weight-reguler">
                      <a href="{{ url('/detail/'.$p->id) }}">{{ $p->nama_barang }}</a>
                    </h5>
          
                    <div class="d-grid gap-2 my-4">
          
                      <a href="{{ url('/anggota/purchasing/addnew/'.$p->id) }}" class="btn btn-primary bold-btn">Buat Pesanan</a>
          
                    </div>
                    {{--  <div class="clearfix mb-1">          
                      <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>          
                      <span class="float-end">                        
                      <i class="far fa-heart" style="cursor: pointer"></i>          
                      </span>
                    </div>  --}}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
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
