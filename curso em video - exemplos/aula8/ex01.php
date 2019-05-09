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
                # multiplos parametros
                function soma() {
                    # pega todos os argumentos passados
                    $p = func_get_args();
                    # pega o tatoal de argumentos passados
                    $total = func_num_args();
                    $s = 0;

                    for($i = 0; $i < $total; $i++) {
                        $s += $p[$i];
                    }

                    return $s;
                }

                $r = soma(5, 2, 3, 10, 1, 4);

                echo $r;
            ?>
        </div>
    </body>
</html>