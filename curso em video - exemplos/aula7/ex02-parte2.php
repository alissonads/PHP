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
                $inicio = isset($_POST["ini"])? $_POST["ini"] : 0;
                $fim = isset($_POST["fim"])? $_POST["fim"] : 10;
                $incremento = isset($_POST["inc"])? $_POST["inc"] : 1;
                
                if($inicio > $fim) {
                    $incremento *= -1;
                    while($inicio >= $fim)
                    {
                        echo "$inicio ";
                        $inicio += $incremento;
                    }
                }
                else
                    while($inicio <= $fim)
                    {
                        echo "$inicio ";
                        $inicio += $incremento;
                    }

            ?>

            <br/><a href="javascript:history.go(-1)" class="btn">VOLTAR</a>
        </div>
    </body>
</html>