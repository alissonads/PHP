<?php
    // inicia o cabeçalho da página
    $page_title = 'Cadastre-se';
    require_once 'scripts/header.php';

    require_once 'scripts/appvars.php';
    require_once 'scripts/connectvars.php';
    require_once 'scripts/util.php';

    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
                or die('Could not connect to the database server ' . 
                        mysqli_connect_error());

    if (isset($_POST['submit'])) {
        // Obtém dados do perfil a partir do post
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

        if (!empty($username) && !empty($password) && 
            !empty($password2) && ($password == $password2)) {
            // Certifica-se de que ninguém já tenha se registrado com o mesmo nome
            $query = "SELECT * FROM mismatch_user
                      WHERE username = '$username'";
                    
            $data = $dbc->query($query)
                        or die('Error querying database. ' . mysqli_connect_error());
                    
            if ($data->num_rows == 0) {
                // O nome do usuário é único, inserir os dados no banco
                $query = "INSERT INTO mismatch_user 
                          (username, password, join_date)
                          VALUES('$username', SHA('$password'), NOW())";
                        
                $dbc->query($query)
                    or die('Error querying database. ' . mysqli_connect_error());

                // Corfirma o sucesso com o usuário
                echo '<p>A sua conta foi criada com sucesso. Agora você pode fazer login e
                         <a href="editprofile.php">editar seu perfil</a>.</p>';
                        
                $dbc->close();
                exit();
            }
            else {
                // Já existe uma conta com este nome. Exibir mensagem de erro.
                echo '<p class="error">Já existe uma conta com este nome de usuário. 
                        Por favor, escolha outro nome<p>';
                $username = '';
            }
        }
        else {
            echo '<p class="error">Você deve digitar todos os dados de login, 
                    incluindo a senha</p>';
        }
    }

    $dbc->close();
?>

    <p>Por favor, digite seu nome de usuário e senha desejados para se cadastrar no Mismatch.</p>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>Informações de Registro</legend>

            <label for="username">Nome de Usuário: </label>
            <input type="text" name="username" id="username" value="<?php echo $username ?? ''; ?>"/><br/><br/>
            <label for="password">Senha: </label>
            <input type="password" name="password" id="password"/><br/><br/>
            <label for="password2">Confirmação de Senha: </label>
            <input type="password" name="password2" id="password2"/>
        </fieldset><br/>

        <input type="submit" name="submit" value="Cadastrar"/>
    </form>

<?php
    require_once 'scripts/footer.php';
?>