<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <h2>Guitar Wars - Administrador</h2>

        <p>Abaixo uma lista com todas os Guerreiros Guitar. 
           Use esta página para remove-los quando precisar.</p>

        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';

            //conecta-se ao banco de dados
            $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or die('Could not connect to the database server' . mysqli_connect_error());

            //obtém os dados das pontuações a partir do mysql
            $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
            $data = $dbc->query($query);

            echo '<div class="bodydata">';
            //loop através do array contendo os dados das pontuações,
            //formatando-os com HTML
            while ($row = $data->fetch_assoc()) {
                //Exibe os dados das pontuações
                echo '<div style="float:left; width:150px">'.
                          '<strong>' . $row['name'] . '</strong>' .
                     '</div>';
                echo '<div style="float:left; width:150px">'. $row['date'] . '</div>';
                echo '<div style="float:left; width:100px">'. $row['score'] . '</div>';
                /*
                  gera o link HTML para o script removescore.php, enviando a ele
                  informações a ser excluída através de um URL linkada para ser obtidos pelo
                  array $_GET.
                */
                //&amp; -> gera um & na posição em que está.
                echo '<div style="float:left; width:100px">'. 
                          '<a href="removescore.php?id=' . $row['id'] . 
                            '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . 
                            '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] .
                            '">Remover</a>' . 
                     '</div>';
            }

            echo '</div>';

            $dbc->close();
        ?>
    </body>
</html>