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
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';

            // Garantir que o usuário esteja logado
            if (!isset($_SESSION['user_id'])) {
                echo '<p class="login">
                          Por favor, faça 
                          <a href="login.php">Login</a>
                          para acessar esta página.
                      </p>';
                exit();
            }
            else {
                echo '<p class="login">' .
                          $_SESSION['username'] . 
                          ' está online -  
                          <a href="logout.php">Sair</a>.
                      </p>';
            }

            $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
                    or die('Could not connect to the database server ' . 
                            mysqli_connect_error());
            
            if (!isset($_GET['user_id'])) {
                $query = "SELECT username, first_name, last_name, gender, 
                                 birthdate, city, state, picture
                          FROM mismatch_user 
                          WHERE user_id = '" . $_SESSION['user_id'] . "'";
            } else {
                $query = "SELECT username, first_name, last_name, gender, 
                                 birthdate, city, state, picture
                          FROM mismatch_user 
                          WHERE user_id = '" . $_GET['user_id'] ."'";
            }

            $data = $dbc->query($query)
                        or die('Error querying database.');

            if ($data->num_rows == 1) {
                $row = $data->fetch_assoc();

                echo '<div style="width:280px">';
                if (!empty($row['username'])) {
                    echo '<div class="label" style="float:left; min-width:145px">Username: </div>';
                    echo '<div style="float:left; width:80px">' . $row['username'] .'</div>';
                }
                if (!empty($row['first_name'])) {
                    echo '<div class="label" style="float:left; min-width:145px">Nome: </div>';
                    echo '<div style="float:left; width:80px">' . $row['first_name'] .'</div>';
                }
                if (!empty($row['last_name'])) {
                    echo '<div class="label" style="float:left; min-width:145px">Sobrenome: </div>';
                    echo '<div style="float:left; width:80px">' . $row['last_name'] .'</div>';
                }
                if (!empty($row['gender'])) {
                    echo '<div class="label" style="float:left; min-width:145px">Sexo: </div>
                          <div style="float:left; width:80px">';
                    if ($row['gender'] == 'M') {
                        echo ' Male';
                    }
                    elseif ($row['gender'] == 'F') {
                        echo 'Female';
                    }
                    else {
                        echo '?';
                    }
                    echo '</div>';
                }
                if (!empty($row['birthdate'])) {
                    if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
                        echo '<div class="label" style="float:left; min-width:145px">Data de Nascimento: </div>';
                        echo '<div style="float:left; width:80px">' . $row['birthdate'] .'</div>';
                    }
                    else {
                        list($year, $month, $day) = explode('-', $row['birthdate']);
                        echo '<div class="label" style="float:left; min-width:145px">Ano de Nascimento: </div>';
                        echo '<div style="float:left; width:80px">' . $year .'</div>';
                    }
                }
                if (!empty($row['city']) || !empty($row['state'])) {
                    echo '<div class="label" style="float:left; min-width:145px">Local: </div>';
                    echo '<div style="float:left; width:100px">' . $row['city'] . ', ' .
                            $row['state'] .'</div>';
                }
                if (!empty($row['picture'])) {
                    echo '<div class="label" style="float:left; min-width:145px">Foto de Perfil: </div>';
                    echo '<div style="min-width:80px"> <img src="' . UPLOAD_PATH . $row['picture'] . 
                         '" alt="Profile Picture"/></div>';
                }
                echo '</div><br/><br/>';

                if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
                    echo '<p><a href="editprofile.php">Editar Perfil</a>.</p>';
                }
            }
            else {
                echo '<p class="error">Desculpe, houve um problema ao acessar seu perfil.</p>';
            }
            
            $dbc->close();
        ?>
    </body>
</html>