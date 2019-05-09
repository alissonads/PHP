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
                /* inclue scripts externos;
                   se eles não existirem continua a execução
                   normalmente, tentando executar as funções
                   do suposto script. Mostrando apenas um warning;

                   obs: se ouver o include e um script mais de 1 vez
                   ocorre multipla inclusão do script.
                */

                # include "funcoes.php";
                /* inclue scripts externos;
                   se eles não existirem trava a execução;

                   obs: se ouver o include e um script mais de 1 vez
                   ocorre multipla inclusão do script.
                */
                # require "funções.php";

                /* se já não estiver incluso. Inclua o Script
                   o restante é o mesmo do include
                */
                include_once "funcoes.php";

                /* se já não estiver incluso. Inclua o Script
                   o restante é o mesmo do require
                */
                # require_once "funções.php";

                require "teste.php";
                require "teste.php";
                ola();
                mostrarValor(10);
                echo "<p>Finalizando Programa</p>";
            ?>
        </div>
    </body>
</html>