<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Document</title>
    </head>
    <body>
        <div>
            <form action="ex01-parte2.php" method="get">
                <?php
                    $i = 1;
                        while ($i <= 5) {
                           echo "Valor $i: <input type='number' name='v$i' max='100' min='0' value='0'/><br/>";
                           $i++;
                        }
                ?>
                <input type="submit" value="Enviar" class="btn"/>
            </form>
        </div>
    </body>
</html>