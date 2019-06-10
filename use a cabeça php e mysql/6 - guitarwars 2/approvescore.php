<?php /*não deve ter espaço antes da tag php*/
    require_once 'scripts/authorize.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <h2>Guitar Wars - Aprovar Pontuação</h2>

        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';

            if (isset($_GET['id']) && isset($_GET['date']) && 
                isset($_GET['name']) && isset($_GET['score'])) {
                // pega os dados do get que vei junto no pacote da url
                // do link na página admin.php
                $id = $_GET['id'];
                $date = $_GET['date'];
                $name = $_GET['name'];
                $score = $_GET['score'];
                $screenshot = $_GET['screenshot'];
            } 
            elseif(isset($_POST['id']) && isset($_POST['name']) && 
                   isset($_POST['score'])){
                //pega os dados do post desta página
                $id = $_POST['id'];
                $name = $_POST['name'];
                $score = $_POST['score'];
            }
            else {
                echo '<p class="error">Desculpe, pontuação não foi especificada para a aprovação.</p>';
            }

            if(isset($_POST['submit'])) {
                if ($_POST['confirm'] == 'Yes') {
                    //conecta-se ao banco de dados
                    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                                or die('Could not connect to the database server' . mysqli_connect_error());

                    //obtém os dados das pontuações a partir do mysql
                    $query = "UPDATE guitarwars SET approved = 1 WHERE id = $id";
                    $dbc->query($query);
                    $dbc->close();
                    echo "<p>A pontuação $score de $name foi aprovada com sucesso.</p>";
                }
                else {
                    echo '<p class="error">Desculpe, houve um problema para aprovar a pontuação.</p>';
                }
            }
            elseif (isset($id) && isset($name) && 
                    isset($date) && isset($score)) {

                echo '<p>Você tem certeza que quer adicionar a pontuação seguinte?</p>';
                echo '<p><strong>Nome: </strong>' . $name . 
                        '<br/><strong>Data: </strong>' . $date .
                        '<br/><strong>Score: </strong>' . $score . '</p>';

        ?>

        <form action="approvescore.php" method="post">
            <img src="<?php echo UPLOAD_PATH . $screenshot; ?>" width="160" alt="Score image /"> <br/>
            <input type="radio" name="confirm" value="Yes"/> Sim
            <input type="radio" name="confirm" value="No" checked="checked"/> Não <br/><br/>
            <input type="submit" name="submit" value="Adicionar"/>
            <!--campos escondidos
                são usados para armazenarem dados para que sejam
                enviados como parte da requisição POST.-->
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" name="name" value="<?php echo $name; ?>"/>
            <input type="hidden" name="score" value="<?php echo $score; ?>"/>
        </form>
        <br/>

        <?php } ?>

        <a href="admin.php">&lt;&lt; Voltar para a página do administrador</a>
    </body>
</html>


