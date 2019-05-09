<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Document</title>
    </head>
    <body>
        <div>
            <?php
                $ds = isset($_GET["ds"])? $_GET["ds"] : 0;

                switch($ds){
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                        echo "Levanta e vai estudar!";
                        break;
                    case 1:
                    case 7:
                        echo "Dia de descanço!";
                        break;
                    default:
                        echo "Dia da semana invalido.";

                }

            ?>

            <br/><a href="javascript:history.go(-1)" class="btn">VOLTAR</a>
        </div>
    </body>
</html>