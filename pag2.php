<!DOCTYPE html>
<html>

<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!--Import materialize.css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">

  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="js/jquery.mask.min.js"></script>
  <script src="js/mascara.js"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
    crossorigin="anonymous"></script>

  <meta charset="UTF-8">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>JEE-RJ Campo Grande</title>
</head>


<body id="home" class="scrollspy">


  <!-- Nav -->
  <div class="navbar-fixed">
    <nav class="blue darken-4">
      <div class="container">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo">JEE-RJ Campo Grande</a>
          <a href="#" data-target="mobile-nav" class="sidenav-trigger">
            <i class="material-icons">menu</i>
          </a>

        </div>
      </div>
    </nav>
  </div>


<section id="texto"  class="mag_t-7">
  <div class="container">
    <div class="row">
      <div class="col s12">

      <h1 class="teal-text text-darken-3 center-align
">CADASTRO REALIZADO COM SUCESSO!</h1>

        <p>Ao clicar no botão abaixo, você será direcionado para o site do pagseguro para realizar o seu pagamento.</p>

        <div class="center-align" style="border: 1px solid #0D47A1; width: 500px; padding: 5%; margin: 5% auto;">


      <h2>Valor: R$ 16,00</h2>
      <p style="font-size:0.8em;">para pagamento no boleto, será acrescido R$1,00 de taxa</p>


      <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
      <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
      <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
      <input type="hidden" name="code" value="F20286C8FFFFA9DFF486FF87A5F7D0BF" />
      <input type="hidden" name="iot" value="button" />
      <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-laranja-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
      </form>
      <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->



        </div>


      </div>

    </div>
  </div>
</section>




  <!-- Footer -->
  <footer class="section blue darken-4 white-text center">
    <p class="flow-text">JEE-RJ CG &copy; 2018 </p>
  </footer>

  <!--JavaScript at end of body for optimized loading-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

  <script>
    // Sidenav
    const sideNav = document.querySelector('.sidenav');
    M.Sidenav.init(sideNav, {});

    // Slider
    const slider = document.querySelector('.slider');
    M.Slider.init(slider, {
      indicators: false,
      height: 500,
      transition: 500,
      interval: 6000
    });

    // Autocomplete
    const ac = document.querySelector('.autocomplete');
    M.Autocomplete.init(ac, {
      data: {
        "Aruba": null,
        "Cancun Mexico": null,
        "Hawaii": null,
        "Florida": null,
        "California": null,
        "Jamacia": null,
        "Europe": null,
      }
    });

    // Material Boxed
    const mb = document.querySelectorAll('.materialboxed');
    M.Materialbox.init(mb, {});

    // ScrollSpy
    const ss = document.querySelectorAll('.scrollspy');
    M.ScrollSpy.init(ss, {});

  </script>
</body>

</html>