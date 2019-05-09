<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Document</title>
    </head>
    <body>
        <pre>
        <?php
            require_once "ContaBanco.php";

            $conta = new ContaBanco();
            print_r($conta);

            $conta->abrirConta("Alisson Diego", "CP");
            print_r($conta);

            $conta->depositar(500);
            print_r($conta);

            $conta->pagarMensalidade();
            $conta->sacar(630);
            //$conta->pagarMensalidade();
            print_r($conta);

            print $conta->fecharConta();
            print_r($conta);

            print ($conta->sacar(630))? "" : "Sem Saldo <br/>";
        ?>
        </pre>
    </body>
</html>