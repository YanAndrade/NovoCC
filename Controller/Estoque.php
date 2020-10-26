<?php

include_once 'Connection.php';

class Estoque extends Connection{
// TODO
    public function criarEstoque($nmProduto, $tipoTecido, $origem, $descricao, $nmCaminhoFoto, $idVitrine){
        
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "INSERT INTO Produto (nome_produto, tecido_produto, origem_produto, descricao_produto, caminho_foto_produto, fk_id_vitrine) VALUES ('$nmProduto', '$tipoTecido', '$origem', '$descricao', '$nmCaminhoFoto', $idVitrine);";
        
        if ($con->query($query) === FALSE){
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);

    }
}