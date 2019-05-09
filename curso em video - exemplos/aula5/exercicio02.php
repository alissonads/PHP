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
                $nota1 = isset($_POST["n1"])? $_POST["n1"] : 0;
                $nota2 = isset($_POST["n2"])? $_POST["n2"] : 0;
                $media = ($nota1 + $nota2) / 2;

                echo "A média entre $nota1 e $nota2 é igual a $media<br/>";

                if($media < 4) 
                    $sit = "REPROVADO";
                elseif($media >= 4 && $media < 7)
                    $sit = "RECUPERAÇÂO";
                else
                    $sit = "APROVADO";

                echo "Situação do aluno: $sit <br/>";

                /*echo '<form action="exercicio02.html">
                          <input type="submit" value="Voltar" class="btn"/>
                      </form>';
                */
            ?>
            <a href="exercicio02.html">Voltar</a>
            <!--<form method="post" action="exercicio02.html">
                <input type="submit" value="Voltar" class="btn"/>
            </form>-->
        </div>
    </body>
</html>