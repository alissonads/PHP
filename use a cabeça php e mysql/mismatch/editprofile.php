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
        <title>Mismatch - Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h3>Mismatch - Edit Seu Perfil</h3>

        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';
            require_once 'scripts/util.php';

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

            if (isset($_POST['submit'])) {
                $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
                $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
                $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
                $birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));
                $city = mysqli_real_escape_string($dbc, trim($_POST['city']));
                $state = mysqli_real_escape_string($dbc, trim($_POST['state']));
                $old_picture = mysqli_real_escape_string($dbc, trim($_POST['old_picture']));
                $new_picture = mysqli_real_escape_string($dbc, trim($_FILES['new_picture']['name']));
                //$new_picture_type = $_FILES['new_picture']['type'];
                $new_picture_size = $_FILES['new_picture']['size'];

                list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);
                $error = false;

                if (!empty($new_picture)) {
                    if (isImage($_FILES['new_picture']) && 
                        $new_picture_size > 0 &&
                        $new_picture_size <= MAX_FILE_SIZE &&
                        $new_picture_width <= MAX_IMG_WIDTH &&
                        $new_picture_height <= MAX_IMG_HEIGHT) {
                            
                        if ($_FILES['file']['error'] == 0) {
                            
                            $target = UPLOAD_PATH . basename($new_picture);

                            if (move_uploaded_file( $_FILES['new_picture']['tmp_name'], $target)) {
                                
                                if (!empty($old_picture) && ($oud_picture != $new_picture)) {
                                    @unlink(UPLOAD_PATH . $old_picture);
                                }
                            }
                            else {
                                
                                @unlink($_FILES['new_picture']['tmp_name']);
                                $error = true;
                                echo '<p class="error">Desculpe, houve um problema com o arquivo que você tentou enviar.</p>';
                            }
                        }
                    }
                    else {
                        @unlink($_FILES['new_picture']['tmp_name']);
                        $error = true;
                        echo '<p class="error">O arquivo precisa ser um gráfico GIF, JPEG ou PNG.
                               Com menos de '. (MAX_FILE_SIZE / 1024) . ' KB de tamanho.' .
                               'Com dimensôes menores que ' . MAX_IMG_HEIGHT . 'X' . MAX_IMG_HEIGHT .
                               ' pixels</p>';
                    }
                }

                if (!$error) {
                    if (!empty($first_name) && !empty($last_name) && !empty($gender) &&
                        !empty($birthdate) && !empty($city) && !empty($state)) {
                            
                        if (!empty($new_picture)) {
                            
                            $query = "UPDATE mismatch_user 
                                      SET first_name = '$first_name',
                                      last_name = '$last_name', gender = '$gender', 
                                      birthdate = '$birthdate', city = '$city',
                                      state = '$state', picture = '$new_picture'
                                      WHERE user_id = '" . $_SESSION['user_id'] . "'";
                        }
                        else {
                            
                            $query = "UPDATE mismatch_user 
                                      SET first_name = '$first_name',
                                      last_name = '$last_name', gender = '$gender', 
                                      birthdate = '$birthdate', city = '$city',
                                      state = '$state'
                                      WHERE user_id = '" . $_SESSION['user_id'] . "'";
                        }

                        $dbc->query($query)
                            or die('Error querying database.');

                        echo '<p>Seu perfil foi atualizado com sucesso.<br/>
                                 <a href="viewprofile.php">Veja seu perfil</a></p>';

                        $dbc->close();
                        exit();
                    }
                    else {
                        echo '<p class="error">Você tem que entrar com todos os dados do perfil (a imagem é opcional).</p>';
                    }
                }
            }
            else {
                $query = "SELECT first_name, last_name, gender, 
                                 birthdate, city, state, picture 
                                 FROM mismatch_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    
                $data = $dbc->query($query)
                            or die('Error querying database.' . mysqli_connect_error());

                if ($data->num_rows == 1) {
                    $row = $data->fetch_assoc();

                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $gender = $row['gender'];
                    $birthdate = $row['birthdate'];
                    $city = $row['city'];
                    $state = $row['state'];
                    $old_picture = $row['picture'];
                }
                else {
                    echo '<p class="error">Houve um problema ao acessar seu perfil.</p>';
                }
            }

            $dbc->close();
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="max_file_size" value="<?php echo MAX_FILE_SIZE; ?>"/>

            <fieldset>
                <legend>Personal Information</legend>

                <label for="firstname">Nome: </label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $first_name ?? ''; ?>"><br/><br/>
                <label for="lastname">Sobrenome: </label>
                <input type="text" name="lastname" id="lastname" value="<?php if (!empty($last_name)) echo $last_name; ?>"><br/><br/>
                <label for="gender">Sexo: </label>
                <select name="gender" id="gender">
                    <option value="M" <?php if (!empty($gender) && $gender == "M") echo 'selected = "selected"';?> >Masculino</option>
                    <option value="F" <?php if (!empty($gender) && $gender == "F") echo 'selected = "selected"';?> >Feminino</option>
                </select><br/><br/>
                <label for="birthdate">Data de Nascimento: </label>
                <input type="date" name="birthdate" id="birthdate" value="<?php if(!empty($birthdate)) echo $birthdate; ?>"/><br/><br/>
                <label for="city">Cidade: </label>
                <input type="text" name="city" id="city" value="<?php echo $city ?? ''; ?>"/><br/><br/>
                <label for="state">Estado: </label>
                <input type="text" name="state" id="state" value="<?php echo $state ?? ''; ?>"/><br/><br/>
                <input type="hidden" name="old_picture" value="<?php if (!empty($old_picture)) echo $old_picture; ?>"/>
                <label for="new_picture">Foto de Perfil: </label>
                <input type="file" name="new_picture" id="new_picture"/>

                <?php
                    if (!empty($old_picture)) {
                        echo '<img class="profile" src="' . UPLOAD_PATH . $old_picture .
                               '" alt="Profile Picture">';
                    }
                ?>
            </fieldset><br/>
            <input type="submit" name="submit" value="Salvar"/>
        </form>
    </body>
</html>