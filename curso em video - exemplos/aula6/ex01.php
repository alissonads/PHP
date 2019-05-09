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
                $num = isset($_POST["num"])? $_POST["num"] : 0;
                $op = isset($_POST["oper"])? $_POST["oper"] : 0;

                switch($op){
                    case 0:
                        echo "O dobro de $num é " . ($num * 2) . "<br/>";
                    break;
                    case 1:
                        echo $num . "³ é " . ($num ^ 3) . "<br/>";
                    break;
                    case 2:
                        echo "A raiz quadrada de $num é " . (number_format(sqrt($num), 3)) . "<br/>";
                    break;
                }

            ?>

            <a href="ex01.html">VOLTAR</a>
        </div>
    </body>
</html>