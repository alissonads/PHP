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
                $valor = isset($_GET["v"])? $_GET["v"] : 0;
                echo "A raiz de $valor é igual a " . (number_format(sqrt($valor), 3)) . "<br/>";
            ?>

            <a href="ex01.html">VOLTAR</a>
        </div>
    </body>
</html>