<?php

require __DIR__ . "/Controller/Session.php";

require __DIR__ . "/Controller/Estoque.php";

$op = $_POST['op'] ?? null;

$estoque = new Estoque('estoque');

$itensEstoque = $estoque->selectProdutosEstoque($_SESSION['id']);

if (isset($op)) {
    $idProduto = $_POST['idProduto'] ?? null;
    $nmProduto = $_POST['nmProduto'] ?? null;
    $qtTamanhoP = $_POST['qtTamanhoP'] ?? null;
    $qtTamanhoM = $_POST['qtTamanhoM'] ?? null;
    $qtTamanhoG = $_POST['qtTamanhoG'] ?? null;
    $qtTamanhoGG = $_POST['qtTamanhoGG'] ?? null;

    $estoque = new Estoque('estoque');
    if ($op == "Cadastrar") {
        $estoque->adcionarItemEstoque($nmProduto, $qtTamanhoP, $qtTamanhoM, $qtTamanhoG, $qtTamanhoGG, $_SESSION['id']);
    } else if ($op == "Editar") {
        $estoque->alterarItemEstoque($nmProduto, $qtTamanhoP, $qtTamanhoM, $qtTamanhoG, $qtTamanhoGG, $idProduto);
    } else if ($op == "Excluir") {
        $estoque->removerItemEstoque($idProduto);
    }
    header('LOCATION: estoque.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="estiloEstoque.css" type="text/css">
    <link rel="stylesheet" href="fontes/font-awesome.min.css">

    <script src="https://kit.fontawesome.com/54f9cce8ca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">

</head>

<body>

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

    <form method="POST" id="tt">
        <input type="text" name="nmProduto" id="add" placeholder="Nome do produto">
        <input type="number" name="qtTamanhoP" id="add" placeholder="Quantidade P">
        <input type="number" name="qtTamanhoM" id="add" placeholder="Quantidade M">
        <input type="number" name="qtTamanhoG" id="add" placeholder="Quantidade G">
        <input type="number" name="qtTamanhoGG"  id="add" placeholder="Quantidade GG">
        <input type="submit" class="btn btn-primary" name="op" id="enviar" value="Cadastrar">
    </form>

    <table class="table" id="tb">
        <thead>
            <tr id="tr">
                <th id="th1" scope="col">Nome</th>
                <th id="th2" scope="col">P</th>
                <th id="th3" scope="col">M</th>
                <th id="th4" scope="col">G</th>
                <th id="th5" scope="col">GG</th>
                <th id="th6" scope="col">Editar</th>
                <th id="th7" scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itensEstoque as $itens) { ?>
                <tr>
                    <td><?= $itens['nome_produto'] ?></td>
                    <td><?= $itens['qt_tamanho_p'] ?></td>
                    <td><?= $itens['qt_tamanho_m'] ?></td>
                    <td><?= $itens['qt_tamanho_g'] ?></td>
                    <td><?= $itens['qt_tamanho_gg'] ?></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateItem<?= $itens['id_produto'] ?>">Editar</button></td>
                    <td><input type="submit" class="btn btn-danger" data-toggle="modal" data-target="#DeleteItem<?= $itens['id_produto'] ?>" value="Excluir"></td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="UpdateItem<?= $itens['id_produto'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalCentralizado">Descreva o Produto:</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputNome" name="nmProduto" placeholder="Digite o nome do Produto" value="<?= $itens['nome_produto'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Qt. P</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inputNome" name="qtTamanhoP" placeholder="Digite o tipo do tecido do Produto" value="<?= $itens['qt_tamanho_p'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Qt. M</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inputNome" name="qtTamanhoM" placeholder="Digite a origem do Produto" value="<?= $itens['qt_tamanho_m'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Qt. G</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inputNome" name="qtTamanhoG" placeholder="Digite a estampa do Produto" value="<?= $itens['qt_tamanho_g'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Qt. GG</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inputNome" name="qtTamanhoGG" placeholder="Digite a estampa do Produto" value="<?= $itens['qt_tamanho_gg'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <input type="hidden" name="idProduto" value="<?= $itens['id_produto'] ?>">
                                    <!-- <input type="submit" class="btn btn-danger" name="op" value="Excluir"> -->
                                    <input type="submit" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#DeleteItem<?= $itens['id_produto'] ?>" value="Excluir">
                                    <input type="submit" class="btn btn-primary" name="op" value="Editar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal End -->

                <!-- Modal Delete -->
                <div class="modal fade" id="DeleteItem<?= $itens['id_produto'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalCentralizado">Excluir Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <label>Deseja excluir esse item?</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <input type="hidden" name="idProduto" value="<?= $itens['id_produto'] ?>">
                                        <input type="submit" class="btn btn-danger" name="op" value="Excluir">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Delete End -->
            <?php } ?>
        </tbody>
    </table>
</body>

</html>