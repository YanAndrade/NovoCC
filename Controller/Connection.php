<?php

class Connection
{

    public static function OpenCon()
    {

        $con = mysqli_init();
        //mysqli_ssl_set($con, NULL, NULL, "BaltimoreCyberTrustRoot.crt.pem", NULL, NULL); 
        mysqli_real_connect($con, "localhost", "root", "", "db_projeto", 3306);

        return $con;
    }

    function CloseCon($con)
    {
        $con->close();
    }
}

// Conecction webhost
// <?php

// class Connection {

//     public static function OpenCon() {

//         $con = mysqli_init(); 
//         //mysqli_ssl_set($con, NULL, NULL, "BaltimoreCyberTrustRoot.crt.pem", NULL, NULL); 
//         mysqli_real_connect($con, "localhost", "id14243245_root", "UwdkP2t4tg6*Dq]b", "id14243245_db_projeto", 3306);

//         return $con;
//     }

//     function CloseCon($con){
//         $con->close();
//     }

// }
