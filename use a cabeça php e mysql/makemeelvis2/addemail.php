<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Make Me Elvis - Add Email</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <img src="img/blankface.jpg" width="161" height="350" alt="" style="float:right"/>
        <img src="img/elvislogo.gif" name="elvislogo" width="229" height="32" border="0" alt="Make Me Elvis"/>
        
        <p>Entre com seu nome, sobrenome e e-mail para ser adicionado
           na lista de clientes <strong>Make Me Elvis</strong>.</p>

        <?php
            $status = 0;

            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';

            if (isset($_POST['submit'])) {
                if (!empty($firstname) && !empty($lastname) && !empty($email)) {
                    $host = 'localhost';
                    $user = 'root';
                    $password = '';
                    $dbname = 'elvis_store';
    
                    $dbc = new mysqli($host, $user, $password, $dbname)
                            or die('Could not connect to the database server ' . 
                                    mysqli_connect_error());
    
                    $query = "INSERT INTO email_list VALUES
                            (DEFAULT, '$firstname', '$lastname', '$email')";
    
                    $dbc->query($query) 
                        or die('Error querying database.');
    
                    $dbc->close();
                    $status = 1;
                }
                else {
                    $status = -1;
                }
            }

        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="firstname">Nome: </label>
            <input type="text" name="firstname" id="firstname" value="<?php echo ($status != 1)?$firstname:''; ?>"/><br/><br/>
            <label for="lastname">Sobrenome: </label>
            <input type="text" name="lastname" id="lastname" value="<?php echo ($status != 1)?$lastname:''; ?>"/><br/><br/>
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="<?php echo ($status != 1)?$email:''; ?>"/><br/><br/>
            <input type="submit" name="submit" value="Adicionar"/>
        </form>

        <?php 
            if($status == -1) {
                echo '<p class="error">ERRO. Existem campos vazios</p>';
            }
            elseif($status == 1) {
                echo '<p>Cliente adicionado com sucesso!</p>';
            }
        ?>
    </body>
</html>