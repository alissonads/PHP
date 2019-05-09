<?php
    // Verifica se se já existe um sesão
    // senão inicializa uma nova sesão gerando um id para as páginas
    session_start();

    // inicializa as variávei de sessão
    if (!isset($_SESSION['user_id'])) {
        if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
            $_SESSION['user_id'] = $_COOKIE['user_id'];
            $_SESSION['username'] = $_COOKIE['username'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Mismatch - Where opposites attract!</title>
    </head>
    <body>
        <h3>Mismatch - Os opostos se atraem!</h3>

        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';

            // Gera o menu de navegação
            if (isset($_SESSION['username'])) {
                echo '&#10084; <a href="viewprofile.php">Ver Perfil</a><br/>';
                echo '&#10084; <a href="editprofile.php">Editar Perfil</a><br/>';
                echo '&#10084; <a href="logout.php">Sair ('. $_SESSION['username'] .')</a>';
            }
            else {
                echo '&#10084; <a href="login.php">Entrar</a><br/>';
                echo '&#10084; <a href="signup.php">Cadastrar-se</a>';
            }

            $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
                    or die('Could not connect to the database server ' . 
                            mysqli_connect_error());

            $query = "SELECT user_id, first_name, last_name, picture
                      FROM mismatch_user
                      WHERE first_name IS NOT NULL ORDER BY join_date DESC LIMIT 5";

            $data = $dbc->query($query)
                        or die('Error querying database.');

            echo '<h4>Latest members:</h4>';

            echo '<div style="width:160px; min-height:200px; padding:5px" >';
            while ($row = $data->fetch_assoc()) {
                echo '<div style="min-height:90px; padding:5px">';
                if (is_file(UPLOAD_PATH . $row['picture']) && 
                    filesize(UPLOAD_PATH . $row['picture']) > 0) {
                    
                    echo '<div style="float:left"><img src="' . UPLOAD_PATH . $row['picture'] . '"
                                                   alt="' . $row['first_name'] . '"/></div>';
                }
                else {
                    echo '<div style="float:left"><img src="' . UPLOAD_PATH . 'nopic.jpg' . '"
                                                   alt="' . $row['first_name'] . '"/></div>';
                }

                if (isset($_SESSION['user_id'])) {
                    echo '<div class="name">
                            <a href="viewprofile.php?user_id=' . $row['user_id'] . '">' 
                            . $row['first_name'] . 
                         '</div>';
                }
                else {
                    echo '<div class="name">' . $row['first_name'] .'</div>';
                }
                echo '</div>';
            }
            echo '</div>';

            $dbc->close();
        ?>

    </body>
</html>