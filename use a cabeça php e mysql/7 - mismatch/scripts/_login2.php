<?php
    require_once 'scripts/connectvars.php';

    $error_msg = '';

    //Se o usuário não estiver logado, tenta fazer o login
    if (!isset($_COOKIE['user_id'])) {
        if (isset($_POST['submit'])) {
            // Conecta-se ao banco de dados
            $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
                    or die('Could not connect to the database server ' . 
                            mysqli_connect_error());

            // Obtém os dados de login digitados pelo usuário
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            if (!empty($user_username) && !empty($user_password)) {
                // Procura o nome e a senha no banco de dados
                $query = "SELECT user_id, username
                          FROM mismatch_user
                          WHERE username = '$user_username'
                          AND password = SHA('$user_password')";
                
                $data = $dbc->query($query)
                            or die('Error querying database.');

                if ($data->num_rows == 1) {
                    echo 'Entrou<br/>';echo "$user_username $user_password<br/>";
                    /* 
                      O login foi bem sucedido, 
                      portanto definir os cookies de id e nome
                      do usuário e redirecionar para a home page.
                    */
                    $row = $data->fetch_assoc();

                    setcookie('user_id', $row['user_id']);
                    setcookie('username', $row['username']);
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . 
                                 dirname($_SERVER['PHP_SELF']) . '/index.php';
                    header('Location: ' . $home_url);
                }
                else {
                    // O nome/senha estão incorretos, portanto definir uma mensagem de erro
                    $error_msg = 'Desculpe, você deve digitar um nome de usuário e 
                                  senha válidos para fazer login.';
                    
                }
            }
            else {
                $error = 'Desculpe, você deve digitar seu nome de usuário e senha para fazer o login';
            }
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mismatch - Log In</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h3>Mismatch - Log In</h3>

        <?php
            // Se o cookie estiver vazio, exibir mensagem de erro (se houver) 
            // e o formulário de login; caso contrario, continuar login
            if (empty($_COOKIE['user_id'])) {
                echo "<p class='error'>$error_msg</p>";
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>
                <legend>Log In</legend>

                <label for="username">Nome de Usuário: </label>
                <input type="text" name="username" id="username" value="<?php echo $user_username ?? ''; ?>"/><br/><br/>
                <label for="password">Senha: </label>
                <input type="password" name="password" id="password"/>
            </fieldset><br/>
            <input type="submit" name="submit" value="Login"/>
        </form>

        <?php
            }
            else {
                // Confirma o login bem-sucedido
                echo '<p class="error">Você está logado como ' . $_COOKIE['username'] . '</p>';
            }
        ?>
    </body>
</html>
