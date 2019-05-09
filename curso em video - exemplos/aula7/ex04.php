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
                $n = isset($_GET["num"])? $_GET["num"] : 1;
                $c = 0;

                print "<h3>Analisando o número $n...</h3>";
                print "Valores múltiplos: ";
                for($i = 1; $i <= $n; $i++) {
                    if($n % $i == 0) {
                        $c++;
                        print "$i ";
                    }
                }

                print "<p>Resultado: $n <span class='foco'>" . (($c == 2)? "É PRIMO!" : "NÃO É PRIMO!") . "</span></p>"
            ?>

            <a href="javascript:history.go(-1)" class="btn">Voltar</a>
        </div>
    </body>
</html>