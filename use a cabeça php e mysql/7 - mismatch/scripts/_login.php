<?php
    require_once 'connectvars.php';

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Mismatch"');
        exit('<h3>Mismatch<h3>Desculpe, você deve digitar seu nome e senha para 
              fazer o login e acessar esta página. 
              Se não for registrado, por favor <a href="signup.php">registre-se</a>.');
    }

    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
                or die('Could not connect to the database server ' . 
                        mysqli_connect_error());

    $user_username = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
    $user_password = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

    $query = "SELECT user_id, username FROM mismatch_user 
              WHERE username = '$user_username' 
              AND password = SHA('$user_password')";
    
    /*if ($result = $dbc->prepare($query)) {
        $result->execute();
        $result->bind_result($user_id, $username);
        $result->close();
    }
    else {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Mismatch"');
        exit('<h3>Mismatch<h3>Desculpe, você deve digitar seu nome e senha para 
              fazer o login e acessar esta página. 
              Se não for registrado, por favor <a href="signup.php">registre-se</a>.');
    }*/

    $data = $dbc->query($query)
        or die('Error querying database.');

    if ($data->num_rows == 1) {
        $row = $data->fetch_assoc();
    
        $user_id = $row['user_id'];
        $username = $row['username'];
    }
    else {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Mismatch"');
        exit('<h3>Mismatch<h3>Desculpe, você deve digitar seu nome e senha para 
              fazer o login e acessar esta página. 
              Se não for registrado, por favor <a href="signup.php">registre-se</a>.');
    }
    echo '<p class="login">' . $username . ' você está logado(a).</p>';
?>