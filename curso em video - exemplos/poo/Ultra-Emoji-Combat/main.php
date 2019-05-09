<?php
    require_once 'Luta.php';

    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="";
    $dbname="combate";
    
    $con = new mysqli($host, $user, $password, $dbname, $port, $socket) 
            or die ('Could not connect to the database server ' . mysqli_connect_error());
    if ($con->connect_error) {
        die ('Could not connect to the database server ' . mysqli_connect_error());
    }

    $l = array();
    $query = "select id, nome, nascimento, peso, altura, 
                     nacionalidade, vitorias, empates, derrotas from lutador";

    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($id, $nome, $nasc, $peso, $alt, 
                           $nac, $vit, $emp, $der);

        $date = explode('-', date('Y-m-d'));

        while ($stmt->fetch()) {
            $nascimento = explode('-', $nasc);
            
            $idade = $date[0] - $nascimento[0];
            
            if(($date[1] == $nascimento[1] && 
                $date[2] < $nascimento[2]) ||
               ($date[1] < $nascimento[1])   ) {
                   $idade--;
            }
            

            $l[$id-1] = new Lutador($nome, $idade, $peso, $alt, $nac, $vit, $emp, $der);
        }
        $stmt->close();
    }

    /*$query = "select * from lutador";
    $stmt = $con->query($query);

    if($stmt->num_rows > 0) {
        while ($row = $stmt->fetch_assoc()) {
            print '<hr>';
            foreach ($row as $key => $value) {
                print $key . ': ' . $value . "<br/>";
            }
           print '</hr>';
        }
    }*/

    $con->close();
    
    $uec01 = new Luta();
    $uec01->marcarLuta($l[4], $l[5]);
    $uec01->lutar();

    if ($uec01->isAprovada()) {
        $l[0]->status();
        $l[1]->status();
    }
