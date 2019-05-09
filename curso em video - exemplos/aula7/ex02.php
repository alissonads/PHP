<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Document</title>
    </head>
    <body>
        <div>
            <form action="ex02-parte2.php" method="post">
                Inínio: <input type="number" name="ini" min="0" max="100"/><br/>
                Final: <input type="number" name="fim" min="0" max="100"/><br/>

                Incremento: <select name="inc">
                                <?php
                                    $i = 1;
                                    while ($i <= 5) {
                                        echo "<option value='$i'>$i</option>";
                                        $i++;
                                    }
                                    
                                ?>
                            </select>

                <input type="submit" value="Contar" class="btn"/>

            </form>
        </div>
    </body>
</html>