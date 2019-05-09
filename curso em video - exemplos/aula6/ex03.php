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
                $estado = isset($_POST["estado"])? $_POST["estado"] : "[Estado não informado]";

                switch ($estado) {
                    case 16:
                    case 20:
                    case 24:
                        echo "Você mora na região <span class='foco'>Sul</span> <br/>";
                        break;
                    case 12:
                    case 13:
                    case 19:
                    case 25:
                        echo "Você mora na região <span class='foco'>Suldeste</span> <br/>";
                        break;
                    case 7:
                    case 9:
                    case 11:
                        echo "Você mora na região <span class='foco'>Centro-Oeste</span> <br/>";
                        break;
                    case 2:
                    case 5:
                    case 6:
                    case 8:
                    case 10:
                    case 15:
                    case 17:
                    case 26:
                        echo "Você mora na região <span class='foco'>Nordeste</span> <br/>";
                        break;
                    case 1:
                    case 3:
                    case 4:
                    case 14:
                    case 18:
                    case 21:
                    case 22:
                    case 23:
                    case 27:
                        echo "Você mora na região <span class='foco'>Norte</span> <br/>";
                        break;
                    default:
                        echo "<span class='foco'>Estado não selecionado</span>";
                }

            ?>

            <br/><br/><a href="javascript:history.go(-1)" class="btn">VOLTAR</a>
        </div>
    </body>
</html>