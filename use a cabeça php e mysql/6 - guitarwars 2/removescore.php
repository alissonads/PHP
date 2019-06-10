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
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h2>Guitar Wars - Remove uma Pontuação</h2>
        
        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';
            
            if (isset($_GET['id']) && isset($_GET['date']) && 
                isset($_GET['name']) && isset($_GET['score']) &&
                isset($_GET['screenshot'])) {
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
                echo '<p class="error">Desculpe, pontuação não foi especificada para ser removida.</p>';
            }

            if (isset($_POST['submit'])) {
                if($_POST['confirm'] == 'Yes') {
                    // deleta a imagem
                    @unlink(UPLOAD_PATH . $screenshot);

                    //conecta-se ao banco de dados
                    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die('Could not connect to the database server' . mysqli_connect_error());

                    //faz a requisição de deletar
                    $query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";
                    $dbc->query($query)
                        or die('Error querying database.');

                    $dbc->close();

                    // confirma com sucesso 
                    echo '<p>A pontuação ' . $score . ' referente a ' . $name . ' foi removida com sucesso.</p>';
                }
                else {
                    echo '<p class="error">A pontuação não foi removida.</p>';
                }
            }
            elseif (isset($id) && isset($date) && 
                    isset($name) && isset($score)) {

                echo '<p>Você tem certeza que quer apagar pontuação seguinte?</p>';
                echo '<p><strong>Nome: </strong>' . $name . 
                        '<br/><strong>Data: </strong>' . $date .
                        '<br/><strong>Score: </strong>' . $score . '</p>';
        ?>

        <form action="removescore.php" method="post">
            <input type="radio" name="confirm" value="Yes"/> Sim
            <input type="radio" name="confirm" value="No" checked="checked"/> Não <br/><br/>
            <input type="submit" name="submit" value="Deletar"/>
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