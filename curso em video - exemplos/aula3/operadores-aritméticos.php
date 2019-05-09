<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Operações Aritméticas</title>
    </head>
    <body>
        <div>
            <?php
                /*
                Pega o valores digitados pelo usuario na url.
                ex: http://localhost:8080/aula3/operadores-aritm%C3%A9ticos.php? a=10&b=2
                a=10&b=2 são os valores digitados no final da url;
                da forma como é digitado o parametro na url deve ser digitada no $_Get["parametro"]
                */
                $n1 = $_GET["a"];
                $n2 = $_GET["b"];
                $s = $n1 + $n2;
                $m = ($n1 + $n2) / 2;

                echo "<h2>Valores Recebidos: $n1 e $n2</h2>";

                echo "$n1 + $n2 = $s<br/>";
                echo "$n1 - $n2 = ".($n1 - $n2).'<br/>';
                echo "$n1 * $n2 = " . ($n1 * $n2) . '<br/>';
                echo "$n1 / $n2 = " . ($n1 / $n2) . '<br/>';
                echo "$n1 % $n2 = " . ($n1 % $n2) . '<br/>';
                echo "A média entre $n1 e $n2 é $m <br/>"
            ?>
        </div>
    </body>
</html>