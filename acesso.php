<?php
  require __DIR__ . "/Controller/Session.php";
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="estiloAcesso.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Acesso</title>
  </head>
  <body>

<!----------------------------------------Navbar------------------------------------------>

<header class="header">  
  <nav class="navbar navbar-default fixed-top">
    <div class="container">
      <a class="navbar-brand" id="icon" href="acesso.php">
        Clothing Control
      </a>
      <button type="button" class="btn btn-light" >
        <a class="navbar-brand" id="sair" href="logout.php">
          Sair
        </a>
      </button>
    </div>
  </nav>

<!---------------------------------------------Atletas---+------------------------------------------------->
<section class="testimonials"> 

      <div>
      <p id="bem">Bem vindo <br> <?= $_SESSION['nome']; ?> </p>
      </div>

            <div class="conatiner">
                <div class="wrap">
                    
                    <div class="box one">
                        <div class="date">
                        </div>
                        <h1>VITRINE</h1>
                        <button class="btn1">
                          <a href="vitrine.php" id="ic">Acessar</a>
                        </button>
                </div>
                    
                <div class="box two">
                    <div class="date">
                    </div>
                    <H1>ESTOQUE</H1>
                    <button class="btn1">
                      <a href="estoque.php" id="ic">Acessar</a>
                    </button>
                </div>
            </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>