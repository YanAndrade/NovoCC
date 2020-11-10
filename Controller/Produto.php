<?php

include_once 'Connection.php';

class Produto extends Connection
{

    public function buscarProdutos($idUsuario)
    {
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "SELECT * FROM Produto WHERE fk_id_usuario = $idUsuario;";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $result = $con->query($query);

        // if ($result->num_rows > 0) {
        //     while($row = $result->fetch_assoc()) {
        //         $retorno = $row;
        //     }
        // } else {
        //     echo "Sem resultados";
        // }

        $connection->CloseCon($con);

        return $result;
    }

    public function buscarProdutosPorIdProduto($idProduto)
    {
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "SELECT * FROM Produto WHERE id_produto = $idProduto;";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $result = $con->query($query);

        // if ($result->num_rows > 0) {
        //     while($row = $result->fetch_assoc()) {
        //         $retorno = $row;
        //     }
        // } else {
        //     echo "Sem resultados";
        // }

        $connection->CloseCon($con);

        return $result;
    }

    public function registrarProduto($nmProduto, $tipoTecido, $origem, $descricao, $nmCaminhoFoto, $idUsuario)
    {

        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "INSERT INTO Produto (nome_produto, tecido_produto, origem_produto, descricao_produto, caminho_foto_produto, fk_id_usuario) VALUES ('$nmProduto', '$tipoTecido', '$origem', '$descricao', '$nmCaminhoFoto', $idUsuario);";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    public function deletarProduto($idProduto)
    {

        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "DELETE FROM Produto WHERE id_produto = $idProduto;";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    public function updateProduto($idProduto, $nmProduto, $tecido, $origem, $descricao, $caminhoFoto)
    {
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "UPDATE Produto SET nome_produto = '$nmProduto', tecido_produto = '$tecido', origem_produto = '$origem', descricao_produto = '$descricao', caminho_foto_produto = '$caminhoFoto' where id_produto = $idProduto;";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    // Metodos de imagem

    public function uploadImageProduto($idProduto, $caminhoFoto)
    {

        $connection = new connection();
        $con = $connection->OpenCon();
        // Deleta todos os jogadores e rankings dessa conta
        // Deleta a conta
        $sql = "UPDATE Produto set caminho_foto_produto = '$caminhoFoto' where id_produto = $idProduto";
        mysqli_query($con, $sql);
        $connection->CloseCon($con);
    }

    public function removeImageReference($id)
    {

        $connection = new connection();
        $con = $connection->OpenCon();
        // Deleta todos os jogadores e artilharias dessa conta

        // Deleta a conta
        $sql = "UPDATE Produto set caminho_foto_produto = null where id_produto = $id";
        mysqli_query($con, $sql);
        $connection->CloseCon($con);
    }
}
