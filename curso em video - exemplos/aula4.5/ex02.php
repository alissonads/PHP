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
                $nome = isset($_POST["nome"])? $_POST["nome"] : "[NÃO INFORMADO]"; 
                $ano = isset($_POST["ano"])? $_POST["ano"] : 0;
                $sexo = isset($_POST["sexo"])? $_POST["sexo"] : "[SEM SEXO]";
                $idade = date("Y") - $ano;

                echo "$nome é $sexo e tem $idade anos <br/>";
            ?>

            <a href="ex02.html">VOLTAR</a>
        </div>
    </body>
</html>