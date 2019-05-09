<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Operações Aritméticas</title>
        <style>
            h2 {
                font: 15 pt Arial;
                color: #171559;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div>
            <?php
                $v1 = $_GET["x"];
                $v2 = $_GET["y"];

                echo "<h2>Valores Recebidos $v1 e $v2</h2>";
                echo "O valor absoluto de $v2 é " . abs($v2)  . "<br/>";
                echo "O valor de $v1 <sup>$v2</sup> é " . pow($v1, $v2)  . "<br/>";
                echo "A raiz de $v1 é " . sqrt($v1) . "<br/>";
                echo "O valor de $v2 arredondado é " . round($v2) . "<br/>";
                echo "A parte inteira de $v2 é " . intval($v2) . "<br/>";
                /*
                formata o numero no formato desejado pelo programador;
                parametros:
                1° -> valor a ser formatado;
                2° -> quantas casas decimais após o ponto ou a virgula (ou o caracter que quiser);
                3° -> identifica se o separador será ponto ou virgula nesse caso virgula.
                      opcional pode deixar sem valor
                4° -> identifica o separador de milhar (caracter que euiser).
                number_format($v1, 2, ",", ".");
                */
                echo "O valor de $v1 em moeda é R$" . number_format($v1, 2, ",", ".");

            ?>
        </div>
    </body>
</html>