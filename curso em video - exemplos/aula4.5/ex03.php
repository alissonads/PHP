<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $txt = isset($_POST["t"])? $_POST["t"] : "Texto Generico";
            $tam = isset($_POST["tam"])? $_POST["tam"] : "12pt";
            $cor = isset($_POST["cor"])? $_POST["cor"] : "#000000";
        ?>

        <meta charset="UTF-8">
        <link rel="stylesheet" href="_css/estilo.css">
        <title>Document</title>

        <style>
            span.texto {
                font-size: <?php echo $tam; ?>;
                color: <?php echo $cor; ?>;
            }
        </style>
    </head>
    <body>
        <div>
            <?php
                echo "<span class='texto'>$txt</span>";
            ?>

            <br/><a href="ex03.html">VOLTAR</a>
        </div>
    </body>
</html>