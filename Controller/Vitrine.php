<?php

include_once 'Connection.php';

class Vitrine extends Connection{

    public function buscarVitrines($idUsuario){
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "SELECT * FROM Vitrine WHERE fk_id_usuario = $idUsuario;";
        
        if ($con->query($query) === FALSE){
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $result = $con->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $retorno = $row;
            }
        } else {
            echo "Sem resultados";
        }

        $connection->CloseCon($con);

        return $retorno;
    }

    public function criarVitrine($idUsuario, $nmVitrine){

        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "INSERT INTO Vitrine (nome_vitrine, fk_id_usuario) VALUES ('$nmVitrine', $idUsuario);";
        
        if ($con->query($query) === FALSE){
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    public function deletarVitrine($idVitrine){
        
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "DELETE FROM Vitrine WHERE id_vitrine = $idVitrine";
        
        if ($con->query($query) === FALSE){
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    public function updateVitrine($idVitrine, $nmVitrine){
        $connection = new Connection();
        $con = $connection->OpenCon();

        $query = "UPDATE Vitrine SET nome_vitrine = '$nmVitrine' where id_vitrine = $idVitrine;";
        
        if ($con->query($query) === FALSE){
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }
}