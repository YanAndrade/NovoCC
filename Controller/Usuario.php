<?php

include_once 'Connection.php';

class Usuario extends Connection
{

    public function cadastrarUsuario($nmUsuario, $nmEmail, $nmSenha)
    {

        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "INSERT INTO Usuario(nm_usuario, nm_email, nm_senha) VALUES ('$nmUsuario', '$nmEmail', '$nmSenha');";

        // if ($con->query($query) === FALSE){
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        $con->query($query);

        $connection->CloseCon($con);
    }

    public function loginUsuario($nmNome)
    {

        // TODO
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "SELECT id_usuario, nm_usuario, nm_senha FROM Usuario WHERE nm_usuario = '$nmNome';";

        // if ($con->query($query) === FALSE){
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        $result = $con->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $retorno = $row;
            }
        } else {
            echo "Sem resultados";
        }

        $connection->CloseCon($con);

        return $retorno;
    }

    public function selectUsuario($id)
    {
        // Consulta todas as informações do usuario para efetuar o login
        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "SELECT * FROM usuario WHERE id_usuario = $id";

        $result = mysqli_query($con, $query);

        $connection->CloseCon($con);

        return $result;
    }

}
