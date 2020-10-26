<?php

class Imagem extends Connection
{
    public function uploadImagem($idUsuario, $idProduto, $post)
    {
// throw new Exception($_FILES["fileToUpload"]["name"]);
        //$query = new Usuario('usuario');
        $produto = new Produto('produto');

        // Check if image file is a actual image or fake image

        $target_dir = "../imagesVitrine/";

        // Utilizando hash de id do usuario + email para nome da foto
        $nome = md5($idUsuario . $idProduto);

        // Separando a extensão do nome da imagem
        $extensao = substr(($_FILES["fileToUpload"]["name"]), -4);

        // Concatenando o nome hash com a extensao
        $nomeImagem = $nome . $extensao;

        // Alterando o nome original da imagem 
        $_FILES["fileToUpload"]["name"] = $nomeImagem;

        $target_file = $target_dir . basename(($_FILES["fileToUpload"]["name"]));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Se o usuário ja tiver imagem, irá excluír a antiga
        $dados_produto = $produto->buscarProdutosPorIdProduto($idProduto);
        foreach ($dados_produto as $produto) {
            if ($produto['caminho_foto_produto'] != null) {
                $this->removerImagem($dados_produto);
            }
        }

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            // echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            header('LOCATION: ../vitrine.php');
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $produto = new Produto('produto');
                $registros = $produto->uploadImageProduto($idProduto, basename($_FILES["fileToUpload"]["name"]));
                //var_dump(basename($_FILES["fileToUpload"]["name"]));
                //echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                header('LOCATION: ../vitrine.php');
            } else {
                //echo "Sorry, there was an error uploading your file.";
                header('LOCATION: ../vitrine.php');
            }
        }
    }

    // Remover imagem
    public function removerImagem($dados_produto)
    {
        // Buscar os dados do usuário
        //$produto = new Produto('produto');
        //$dados_produto = $produto->buscarProdutosPorIdProduto($idProduto);
        // Remover foto do usuario
        foreach ($dados_produto as $produto) {
            if (!unlink('../imagesVitrine/' . $produto['nm_caminho_foto'])) {
                echo ($produto['nm_caminho_foto'] . " não foi deletada devido a um erro inesperado.");
            } else {
                $produto->removeImageReference($_SESSION['id']);
                header('LOCATION: ../vitrine.php');
            }
        }
    }
}
