<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Incremento</title>
    </head>
    <body>
        <div>
            <?php
                $atual = $_GET["aa"]; # vai pegar o ano atual na URL
                echo "O ano atual é $atual" . "<br/>";
                echo "O ano anterior é " . --$atual . "<br/>";
                echo "O ano anterior a " . $atual-- . " é $atual" . "<br/>";

                $atual = $_GET["aa"];
                echo "O ano atual é $atual" . "<br/>";
                echo "O proximo ano é " . ++$atual . "<br/>";
            ?>
        </div>
    </body>
</html>