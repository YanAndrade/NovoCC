<?php
session_start();
if (isset($_SESSION['id'], $_SESSION['nome']/*, $_SESSION['email']*/)) {
  header('LOCATION: acesso.php');
}
$nmNome = $_POST['nmNome'] ?? null;
$nmEmail = $_POST['nmEmail'] ?? null;
$nmSenha = $_POST['nmSenha'] ?? null;
$nmConfirmaSenha = $_POST['nmConfirmaSenha'] ?? null;

if (!is_null($nmNome)) {
  require __DIR__ . '/Controller/Usuario.php';
  try {
    if (strlen($nmSenha) >= 6 && strlen($nmSenha) >= 6) {
      if ($nmSenha == $nmConfirmaSenha) {
        if (preg_match('/^[a-zA-Z\s]+$/', $nmNome)) {
          $nmSenha = hash('md5', $nmSenha);
          $query = new Usuario('usuarios');
          $query->cadastrarUsuario($nmNome, $nmEmail, $nmSenha);
        } else {
          throw new exception('Nome invalido, só é permitido letras.');
        }
      } else {
        throw new exception('Senhas diferentes.');
      }
    } else {
      throw new exception('A senha precisa ter no mínimo 6 caracteres.');
    }
    header('LOCATION: index.php');
  } catch (Exception $e) {
    throw new Exception($e);
  }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" type="text/css" href="estiloCadastro.css">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Login</title>
</head>

<body>

  <div class="login">
    <img src="img/user.png" class="usuario" width="100" height="100" alt="">
    <h1>Cadastro</h1>

    <form method="POST">
      <p>Usuário</p>
      <input type="text" name="nmNome" placeholder="Insira o nome" require>
      <p>E-mail</p>
      <input type="text" name="nmEmail" placeholder="Insira o e-mail" require>
      <p>Senha</p>
      <input type="password" name="nmSenha" placeholder="Insira a senha" require>
      <p>Confirme a Senha</p>
      <input type="password" name="nmConfirmaSenha" placeholder="Confime a senha" require>
      <input type="submit" name="cadastrar" value="Cadastrar">
    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>