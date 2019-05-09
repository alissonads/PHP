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
                # passagem por valor
                function teste($x){
                    $x = $x + 2;
                    echo "<p>O valor de X é $x</p>";
                }

                # passagem por referencia
                function teste2(&$x) {
                    $x += 2;
                    echo "<p>O valor de X é $x</p>";
                }

                $a = 3;
                echo "<p>O valor de a é $a</p>";
                teste2($a);
                echo "<p>O valor de a é $a</p>";
            ?>
        </div>
    </body>
</html>