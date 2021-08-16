<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Landing page for autosubasta app">
  <meta name="author" content="RN2">
  <link rel="icon" type="image/png" sizes="96x96" href="/favicon.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon.png">

  <title>PHOTOMANAGER
   </title>

  <!-- Font Awesome Icons -->
  {{-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> --}}
  <link rel="stylesheet" href="{{ asset('landingpage/vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}">
  <!-- Google Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'> --}}

  <!-- Plugin CSS -->
  {{-- <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="{{ asset('landingpage/vendor/magnific-popup/magnific-popup.css') }}">
  <!-- Theme CSS - Includes Bootstrap -->
  {{-- <link href="css/creative.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="{{ asset('landingpage/creative.css') }}">

</head>

<body id="page-top">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="{{url('home')}}">PHOTOMANAGER</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Ofertas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger"  href="{{url('login')}}">Entrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger"  href="{{url('registro')}}">Registrarse</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead" style="background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url({{ asset('/landingpage/img/bg-masthead.jpg') }}");">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Subasta de autos seminuevos</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">En AUTOSUBASTA RN2 le damos acceso exclusivo a autos calificados para tu inventario.</p>
          <a class="btn btn-primary btn-xl js-scroll-trigger" href="{{url('login')}}">Pujar Ahora</a>
        </div>
      </div>
    </div>
  </header>

  <!-- About Section -->
  <section class="page-section bg-primary" id="about">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
          <h2 class="text-white mt-0" style="font-size:3rem;">En RN2 somos tu mejor opción en el mundo automotriz</h2>
          <h4 class="text-white mt-0" style="font-size:2rem;">Contamos con más de 30 años de experiencia</h4>
          <hr class="divider light my-4">
          <h5 class="text-white-50 mb-4" style="font-size:1.50rem">Somos la única agencia especializada en brindar productos y servicios integrales en el mercado de autos <b>nuevos</b>y <b>seminuevos</b>.</h5>
          {{-- <hr class="divider light my-4"> --}}
          <a class="btn btn-light btn-xl js-scroll-trigger" href="{{url('home')}}">Entrar a la APP</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="page-section" id="services">
    <div class="container">
      <h2 class="text-center mt-0">Además contamos con excelentes servicios.</h2>
      <hr class="divider my-4">
      <div class="row">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            {{-- style="width:72px; height:72px" --}}
            {{-- <i class="fas fa-4x fa-cart-arrow-down text-primary mb-4"></i> --}}
            <img class="img-fluid" src="{{ asset('landingpage/img/iconos/compra.jpg') }}" alt="ico" style="width:110px; height:110px" >
            <h3 class="h4 mb-2">COMPRAR</h3>
            <p class="text-muted mb-0">COMPRA SEMINUEVOS EN LA <b>AGENCIA, CERTIFICADOS</b> Y CON <b>GARANTÍA</b></p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <img class="img-fluid" src="{{ asset('landingpage/img/iconos/venta.jpg') }}" alt="ico" style="width:110px; height:110px" >
            <h3 class="h4 mb-2">VENDER</h3>
            <p class="text-muted mb-0">VENDE TU AUTO <b>FÁCIL</b>, <b>RÁPIDO</b> Y AL MEJOR <b>PRECIO</b></p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <img class="img-fluid" src="{{ asset('landingpage/img/iconos/prestamo.jpg') }}" alt="ico" style="width:110px; height:110px" >
            <h3 class="h4 mb-2">EMPEÑAR</h3>
            <p class="text-muted mb-0">TE <b>PRESTAMOS</b> DINERO POR TU AUTO CON LAS <b>MEJORES CONDICIONES</b></p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <img class="img-fluid" src="{{ asset('landingpage/img/iconos/renta.jpg') }}" alt="ico" style="width:110px; height:110px" >
            <h3 class="h4 mb-2">RENTAR</h3>
            <p class="text-muted mb-0"><b>TODOS LOS VEHÍCULOS</b> AL ALCANCE DE UN CLICK.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

 
  

  <!-- Portfolio Section -->
  {{-- {{dd($ofertas[0])}} --}}
  <section id="portfolio">
    <div class="container-fluid p-0">
      <div class="row no-gutters">
       
        
      </div>
    </div>
  </section>
<!-- Services Section -->
<section class="page-section" id="services">
  <div class="container">
    <h2 class="text-center mt-0">Comienza a abastecer tu Inventario</h2>
    <hr class="divider my-4">
    <div class="row">
      <div class="col-lg-3 col-md-6 text-center">
        <div class="mt-5">
          <i class="fas fa-4x fa-arrow-right text-primary mb-4"></i>
          <h3 class="h4 mb-2">Afíliate Con Nosotros</h3>
          <p class="text-muted mb-0">Al solicitar tu registro, deberás llenar el formulario con tu información básica (ver aviso de privacidad), y uno de nuestros ejecutivos se pondrá en contacto contigo para continuar con tu registro.
            </p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="mt-5">
          <i class="fas fa-4x fa-arrow-right text-primary mb-4"></i>
          <h3 class="h4 mb-2">Puja y Compra</h3>
          <p class="text-muted mb-0">Accede desde tu dispositivo móvil o desde tu computadora, (nunca lo hagas desde una computadora publica), participa en las subastas que, generados diariamente, revisa las fichas técnicas, coloca tus pujas y reserva tus autos.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="mt-5">
          <i class="fas fa-4x fa-arrow-right text-primary mb-4"></i>
          <h3 class="h4 mb-2">Ven A Nuestro Almacén Por Tus Autos</h3>
          <p class="text-muted mb-0">Si eres el ganador, el sistema te informará de ello y te enviará un correo para las instrucciones de pago, ven a nuestro almacén y disfruta del auto que has comprado, que además cuenta con garantía y certificado de inspección en más de 240 puntos, incluyendo su revisión documental.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="mt-5">
          <i class="fas fa-4x fa-plus text-primary mb-4"></i>
          <h3 class="h4 mb-2">Ya estas listo para ser uno de nuestros clientes</h3>
          
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- Call to Action Section -->
  <section class="page-section bg-dark text-white">
    <div class="container text-center">
      <h2 class="mb-4">Usa nuestra app</h2>
      <a class="btn btn-light btn-xl" href="{{url('login')}}">Entrar!</a>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Contactanos!</h2>
          <hr class="divider my-4">
          <p class="text-muted mb-5">Cualquier duda o sugerencia sobre los servicios que prestamos, no demore en acudir a nosotros!</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div>+53 58467340</div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in anchor text AND the link below! -->
          <a class="d-block" href="mailto: playeralfa22@gmail.com"> playeralfa22@gmail.com</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2020 - RN2</div>
    </div>
  </footer>
  <script src="{{ asset('/landingpage/vendor/jquery/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"type="text/javascript"></script>
  <script src="{{ asset('/landingpage/vendor/jquery-easing/jquery.easing.min.js') }}"type="text/javascript"></script>
  <script src="{{ asset('/landingpage/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"type="text/javascript"></script>
  <script src="{{ asset('/landingpage/js/creative.min.js') }}"type="text/javascript"></script>
<script type="text/javascript">

$(function(){
  let name_app = "PHOTOMANAGER";
  let email_app = "playeralfa22@gmail.com";
  let telef_app ="+53 58467340";
  let logo_app = "{{ asset('upload_documentos/logo.png') }}";

  localStorage.setItem('name_app',name_app);
  localStorage.setItem('telef_app',telef_app);
  localStorage.setItem('logo_app',logo_app);
  localStorage.setItem('email_app',email_app);
 
})
</script>

</body>

</html>
