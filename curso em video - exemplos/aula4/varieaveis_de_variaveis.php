<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Incremento</title>
    </head>
    <body>
        <div>
            <?php
                $site = "cursoemvideo";
                /*
                    Por causa do $ a mais o que está dentro de $site
                    se torna uma outra variavel.
                    E $$site = "cursoPHP"; é a mesma coisa que
                    $cursoemvideo = "cursoPHP";

                    E para acessar o conteudo pode ser
                    echo $$site;
                    como
                    echo $cursoemvideo;
                */
                $$site = "cursoPHP";
                echo "O conteudo da variável site é $site . <br/>";
                echo "A variável $site contida na variável site é $cursoemvideo";
            ?>
        </div>
    </body>
</html>