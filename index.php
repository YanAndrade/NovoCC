<?php
session_start();
if (isset($_SESSION['id'], $_SESSION['nome']/*, $_SESSION['email']*/)) {
  header('LOCATION: acesso.php');
}
$nmNome = $_POST['nmNome'] ?? null;
$nmSenha = $_POST['nmSenha'] ?? null;

if (!is_null($nmNome)) {
  try {
    require_once __DIR__ . '/Controller/Usuario.php';

    $query = new Usuario('usuarios');
    $select = $query->loginUsuario($nmNome);

    if ((hash('md5', $nmSenha) == $select["nm_senha"])) {

      $id = $select["id_usuario"];
      $dados_usuario = $query->selectUsuario($id);
      $dado = mysqli_fetch_assoc($dados_usuario);

      session_start();
      $_SESSION['id'] = $select['id_usuario'];
      $_SESSION['nome'] = $select['nm_usuario'];
      //$_SESSION['email'] = $select['nm_email'];
      header('LOCATION: acesso.php');
    } else {
      throw new exception('Falha ao efetuar login');
    }
  } catch (Exception $e) {
    echo 'Falha ao efetuar login!';
  }
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" type="text/css" href="estilologin.css">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Login</title>
</head>

<body>

  <div class="login">
    <img src="img/user.png" class="usuario" width="100" height="100" alt="">
    <h1>Login</h1>

    <form method="POST">
      <p>Usuário</p>
      <input type="text" name="nmNome" placeholder="Insira o nome">
      <p>Senha</p>
      <input type="password" name="nmSenha" placeholder="Insira a senha">
      <input type="submit" name="login" value="Login">

      |
      <a href="cadastro.php">Cadastre-se</a>

    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>