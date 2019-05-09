<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Document</title>
    </head>
    <body>
        <div>
            <form action="ex03-parte2.php" method="post">
                Número: <select name="num">
                            <?php
                                $i = 1;
                                do{
                                    echo "<option value='$i'>$i</option>";
                                    $i++;
                                }while($i <= 10);
                            ?>
                        </select>
                <input type="submit" value="Tabuada"/>
            </form>
        </div>
    </body>
</html>