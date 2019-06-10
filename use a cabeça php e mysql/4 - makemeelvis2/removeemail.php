<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Make Me Elvis - Remove Email</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <img src="img/blankface.jpg" width="161" height="350" alt="" style="float:right"/>
        <img src="img/elvislogo.gif" name="elvislogo" width="229" height="32" border="0" alt="Make Me Elvis"/>

        <p>Por favor selecione o endereço de e-mail para ser apagado da lista de e-mails e clique Remover.</p>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
                $host = 'localhost';
                $name = 'root';
                $password = '';
                $dbname = 'elvis_store';

                $dbc = new mysqli($host, $name, $password, $dbname) 
                        or die('Could not connect to the database server ' . 
                                mysqli_connect_error());

                if (isset($_POST['submit'])) {
                    $todelete = $_POST['todelete'] ?? '';

                    if(!empty($todelete)) {
                        foreach ($todelete as $delete_id) {
                            $query = "DELETE FROM email_list WHERE id = $delete_id";
                            $result = $dbc->query($query) 
                                        or die('Error querying database.');
                        }
                                        
                        echo "Cliente(s) removido(s) com sucesso.<br/>";
                    }
                    else {
                        echo '<span class="error">Selecione um endereço de e-mail.</span><br/>';
                    }
                }
                
                $query = "SELECT * FROM email_list";

                $result = $dbc->query($query) 
                            or die('Error querying database.');
                
                /*
                    Coloca os valores de cada linha dentro de $row;
                    Gera Um checkbox para cada id 
                */
                while ($row = $result->fetch_assoc()) {
                    /*
                      todelete[] o  conchetes no final do nome 
                      gera um array dentro do $_POST com os ids.
                      para acessar pode-se utilizar um foreach
                      ou $_POST[todelete][0]
                    */
                    echo '<input type="checkbox" name="todelete[]" value="' . $row['id'] . '"/>' .
                        $row['first_name'] . ' ' .$row['last_name'] . ' - ' . $row['email'] . '<br/>';
                }

                $dbc->close();
            ?>
            <input type="submit" name="submit" value="Remover">
        </form>
    </body>
</html>