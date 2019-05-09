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
                $ano = isset($_GET["ano"])? $_GET["ano"] : 1900;
                $idade = date("Y") - $ano;
                echo "Ano atual: " . date("Y") . "<br/>";
                echo "Você nasceu em $ano e tem $idade anos! <br/>";

                if($idade < 16) 
                    $v = "não pode votar";
                elseif(($idade >= 16 && $idade < 18) || ($idade >= 65))
                    $v = "o voto é opcional";
                else
                    $v = "o voto é obrigatório";

                echo "Com essa idade $v!"
            ?>
        </div>
    </body>
</html>