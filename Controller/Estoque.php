<?php

include_once 'Connection.php';

class Estoque extends Connection
{

    public function selectProdutosEstoque($idUsuario)
    {
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "SELECT * FROM Estoque WHERE fk_id_usuario = $idUsuario;";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $result = $con->query($query);

        $connection->CloseCon($con);

        return $result;
    }

    public function adcionarItemEstoque($nmProduto, $qtTamanhoP, $qtTamanhoM, $qtTamanhoG, $qtTamanhoGG, $idUsuario)
    {

        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "INSERT INTO Estoque(nome_produto, qt_tamanho_p, qt_tamanho_m, qt_tamanho_g, qt_tamanho_gg, fk_id_usuario) VALUES ('$nmProduto', $qtTamanhoP, $qtTamanhoM, $qtTamanhoG, $qtTamanhoGG, $idUsuario);";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    public function alterarItemEstoque($nmProduto, $qtTamanhoP, $qtTamanhoM, $qtTamanhoG, $qtTamanhoGG, $idProduto)
    {
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "UPDATE Estoque SET nome_produto = '$nmProduto', qt_tamanho_p = $qtTamanhoP, qt_tamanho_m = $qtTamanhoM, qt_tamanho_g = $qtTamanhoG, qt_tamanho_gg = $qtTamanhoGG where id_produto = $idProduto;";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    public function removerItemEstoque($idProduto)
    {
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "DELETE FROM Estoque WHERE id_produto = $idProduto;";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }
}
