<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Controle Remoto</title>
    </head>
    <body>
        <pre>
            <?php
                require_once 'ControleRemoto.php';

                $c = new ControleRemoto();
                $c->ligar();
                $c->ligarMudo();
                $c->abrirMenu();
                $c->fecharMenu();
                $c->desligarMudo();
                for($i = 0; $i < 10; $i++)
                    $c->maisVolume();
                $c->abrirMenu();
                $c->fecharMenu();
                $c->play();
                $c->desligar();
                $c->play();
                print_r($c)
            ?>
        </pre>
    </body>
</html>