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
                $n = isset($_POST["num"])? $_POST["num"] : 0;
                $i = 1;

                echo "<p>Mostrando a Tabuada do $n</p>";
                do{
                    echo "$n x $i = " . ($n * $i) . "<br/>";
                    $i++;
                }while($i <= 10);

            ?>
            <p><a href="ex03.php" class="btn">Voltar</a></p>
        </div>
    </body>
</html>