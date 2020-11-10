<?php
require __DIR__ . "/Controller/Session.php";

require __DIR__ . "/Controller/Produto.php";
// require __DIR__ . "/Controller/Imagem.php";

$nmProduto = $_POST['nmProduto'] ?? null;
$tecido = $_POST['tecido'] ?? null;
$origem = $_POST['origem'] ?? null;
$descProduto = $_POST['descProduto'] ?? null;
$nmCaminhoFoto = $_POST['foto'] ?? null;
$op = $_POST['op'] ?? null;

if (isset($op)) {
    if ($op == "Salvar") {
        $idProduto = $_POST['idProduto'];
        $query = new Produto('produtos');
        $query->updateProduto($idProduto, $nmProduto, $tecido, $origem, $descProduto, $nmCaminhoFoto);
        $nmRankings = $_POST['nmRankings'] ?? null;

        // salvando imagem
        // $uploadImagem = new Imagem('Imagem');
        // throw new Exception($_FILES["fileToUpload"]["name"]);
        // $uploadImagem->uploadImagem($_SESSION['id'], $idProduto, $_POST);

        // salvando imagem - segunda forma
        //include __DIR__ . "/Controller/imageUpload.php";

        header('LOCATION: vitrine.php');
    } else if ($op == "Excluir") {
        $idProduto = $_POST['idProduto'];
        $query = new Produto('produtos');
        $query->deletarProduto($idProduto);
        $nmRankings = $_POST['nmRankings'] ?? null;
        header('LOCATION: vitrine.php');
    } else if ($op == "Enviar") {
        $query = new Produto('produtos');
        $query->registrarProduto($nmProduto, $tecido, $origem, $descProduto, $nmCaminhoFoto, $_SESSION['id']);
        header('LOCATION: vitrine.php');
    }
}

// if (isset($nmProduto)) {
//     $query = new Produto('produtos');
//     $query->registrarProduto($nmProduto, $tecido, $origem, $descProduto, $nmCaminhoFoto, $_SESSION['id']);
//     header('LOCATION: vitrine.php');
// }

$query = new Produto('produtos');
$produtos = $query->buscarProdutos($_SESSION['id']);

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="estiloVitrine.css" type="text/css">
    <link rel="stylesheet" href="fontes/font-awesome.min.css">

    <script src="https://kit.fontawesome.com/54f9cce8ca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">



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


        <!---------------------------------------Botão Adicionar------------------------------------------------------>
        <br>
        <br>
        <br>
        <br>
        <!---------------------------------------Card------------------------------------------------------------>

        <form method="POST" id="fm">
            <input type="text" name="nmProduto" id="add" placeholder="Nome do produto">
            <input type="text" name="tecido" id="add" placeholder="Tecido">
            <input type="text" name="origem" id="add" placeholder="Origem">
            <input type="text" name="descProduto" id="add" placeholder="Descrição">
            <input type="submit" name="op" id="enviar" value="Enviar">
        </form>

        <hr>

        <div class="container-fluid">
            <div class="row">
                <?php
                foreach ($produtos as $produto) { ?>

                    <div class="col-sm">
                        <div class="card mx-auto" id="card-atleta">
                            <!-- original -->
                            <!-- <img class="card-img-top" src="img/roupa1.jpg" alt="Imagem de capa do card"> -->

                            <!--  alterado -->
                            <?php if ($produto['caminho_foto_produto'] != null) { ?>
                                <button type="button" data-toggle="modal" data-target="#UploadImageModal<?= $produto['id_produto'] ?>"><img src="../imagesVitrine/<?= $produto['caminho_foto_produto'] ?>" style=" height:170px;
    width:auto;/*maintain aspect ratio*/
    max-width:180px;"></button>
                            <?php } else { ?>
                                <!-- TODO style mockado para manter padrão de tamanho da imagem, passar para CSS -->
                                <button type="button" data-toggle="modal" data-target="#UploadImageModal<?= $produto['id_produto'] ?>"><img src="/img/roupa1.jpg" style=" height:170px;
    width:auto;/*maintain aspect ratio*/
    max-width:180px;"></button>
                            <?php } ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= $produto['nome_produto'] ?></h5>
                                <!-- Botão para acionar modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExemploModalCentralizado<?= $produto['id_produto'] ?>">
                                    Descrição
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="ExemploModalCentralizado<?= $produto['id_produto'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado">Descreva o Produto:</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- TODO ou salva a imagem individualmente do form, ou manda a lógica de salvar tudo para o arquivo .php que salva a imagem -->
                                <!-- <form action="/Controller/imageUpload.php" method="post" enctype="multipart/form-data">
            Selecione uma imagem de perfil:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Salvar imagem" name="submit">
        </form> -->
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <!-- <div class="form-group">
                                            <h5 class="modal-title" id="TituloModalCentralizado">Selecione a foto do Produto:</h5>
                                            <label for="exampleFormControlFile1"></label>
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                        </div> -->
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-form-label">Nome</label>
                                            <div class="col-sm-10">
                                                <input type="" class="form-control" id="inputNome" name="nmProduto" placeholder="Digite o nome do Produto" value="<?= $produto['nome_produto'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-form-label">Tecido</label>
                                            <div class="col-sm-10">
                                                <input type="" class="form-control" id="inputNome" name="tecido" placeholder="Digite o tipo do tecido do Produto" value="<?= $produto['tecido_produto'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-form-label">Origem</label>
                                            <div class="col-sm-10">
                                                <input type="" class="form-control" id="inputNome" name="origem" placeholder="Digite a origem do Produto" value="<?= $produto['origem_produto'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-form-label">Descrição</label>
                                            <div class="col-sm-10">
                                                <input type="" class="form-control" id="inputNome" name="descProduto" placeholder="Digite a estampa do Produto" value="<?= $produto['descricao_produto'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <input type="hidden" name="idProduto" value="<?= $produto['id_produto'] ?>">
                                        <input type="submit" class="btn btn-danger" name="op" value="Excluir">
                                        <input type="submit" class="btn btn-primary" name="op" value="Salvar">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Image Modal Start -->
                    <div class="modal fade" id="UploadImageModal<?= $produto['id_produto'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado">Mudar foto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../Controller/imageUpload.php" method="post" enctype="multipart/form-data">
                                        Selecione uma imagem de perfil:
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                        <input type="hidden" value="<?= $produto['id_produto'] ?>" name="idProduto">
                                        <input type="submit" value="Salvar imagem" name="submit">

                                        <!-- Exibe o botao de remover imagem caso o usuario ja tenha uma imagem -->
                                        <?php if ($produto['caminho_foto_produto'] != null) { ?>
                                            <input type="submit" value="Remover imagem" name="remove">
                                        <?php } ?>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Upload Image Modal End -->

                <?php } ?>
            </div>
        </div>
</body>

</html>