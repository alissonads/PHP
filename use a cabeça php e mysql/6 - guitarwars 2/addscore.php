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
        <h2>Guitar Wars - Adicione sua pontuação</h2>

        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';
            require_once 'scripts/util.php';

            if (isset($_POST['submit'])) {
                $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or die('Could not connect to the database server' . mysqli_connect_error());
                /*
                  mysqli_real_escape_string -> faz escape de caracteres potencialmente perigosos,
                  para que eles não possam afetar como a consulta se executa.

                  trim -> remove os espaços que antes e depois que uma string possa ter.
                */
                $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
                $score = mysqli_real_escape_string($dbc, trim($_POST['score']));
                /*$_FILES é como o post um array composto com os dados do arquivo enviado*/
                $screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
                $screenshot_size = $_FILES['screenshot']['size'];

                if (!empty($name) && is_numeric($score) && !empty($screenshot)) {
                    
                    if (isImage($_FILES['screenshot']) &&
                        $screenshot_size > 0 && $screenshot_size <= MAX_FILE_SIZE) {
                        
                        if ($_FILES['screenshot']['error'] == 0) {
                            $target = UPLOAD_PATH . $screenshot;

                            /*move_uploaded_file move arquivos para lugares determinados
                            se bem sucedido retorna 1.
                            1° parametro o endereço que está atualmente;
                            2° o novo local com o enderço e o novo nome do arquivo
                            */
                            if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
                                
                                $query = "INSERT INTO guitarwars (date, name, score, screenshot)
                                        VALUES (NOW(), '$name', '$score', '$screenshot')";
            
                                $dbc->query($query)
                                    or die('Error querying database.');
            
                                echo '<p>- Obrigado por adicionar o seu recorde!</p>';
                                echo '<p><strong>Name: </strong>' . $name .'<br/>';
                                echo '<strong>Score: </strong>' . $score .'<br/>';
                                echo '<img src="' . UPLOAD_PATH . $screenshot . '" alt="Score image"/></p>';
                                echo '<p><a href="index.php">&lt;&lt; Voltar a listagem de pontuação</a></p>';

                                $name = '';
                                $score = '';
                                $screenshot = '';

                                $dbc->close();
                                
                                echo '<p>Dados adiconado com sucesso!</p>';
                            }
                            else {
                                echo '<p class="error">Desculpe, houve um problema com o arquivo que você tentou enviar.</p>';
                            }
                        }

                    }
                    else {
                        echo "<p class='error'>O arquivo precisa ser um gráfico GIF, JPEG ou PNG.
                              Com menos de ". (MAX_FILE_SIZE / 1024) . " KB de tamanho.</p>";
                    }

                    // tenta deletar o arquivo temporário
                    @unlink($_FILES['screenshot']['tmp_name']);
                }
                else {
                    echo '<p class="error">Por favor, entre com todas as informação para adicionar sua contagem de pontos.</p>';
                }
            }
        ?>

        <hr/>
        <!--enctype="multipart/form-data" -> este atributo permite o requerimento
            de upload de arquivos, ele afeta como os post são combinados e enviados
            na submissão-->
        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!--estabelece um tamanhom maximo para o arquivo neste caso 32kb-->
            <input type="hidden" name="max_file_size" value="<?php echo MAX_FILE_SIZE; ?>"/>
            <label for="name">Nome: </label>
            <input type="text" name="name" id="name" value="<?php if(!empty($name)) echo $name; ?>"/><br/><br/>
            <label for="score">Score: </label>
            <input type="number" name="score" id="score" value="<?php if(!empty($score)) echo $score; ?>"/><br/><br/>
            <label for="screenshot">Screen shot: </label>
            <input type="file" name="screenshot" id="screenshot"/>
            <hr/>
            <input type="submit" name="submit" value="Adicionar"/>
        </form>
    </body>
</html>