<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Atribuição</title>
    </head>
    <body>
        <div>
            <?php
                $preco = $_GET["p"];
                echo "O preço do produto é R$ $preco<br/>";

                $preco -= $preco * 10 / 100;
                echo "O novo preço com 10% de desconto é R$" . number_format($preco, 2, ",", ".") . "<br/>"
            ?>
        </div>
    </body>
</html>