<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Make Me Elvis - Remove Email</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
            $email = $_POST['email'] ?? '';

            if (!empty($email)) {
                $host = 'localhost';
                $name = 'root';
                $password = '';
                $dbname = 'elvis_store';

                $dbc = new mysqli($host, $name, $password, $dbname) 
                        or die('Could not connect to the database server ' . 
                                mysqli_connect_error());

                $query = "DELETE FROM email_list WHERE email = '$email'";

                $result = $dbc->query($query) 
                            or die('Error querying database.');

                $dbc->close();

                echo "Cliente removido com sucesso: $email<br/>";
            }
            else {
                echo 'Campo email vazio. Impossivel de deletar<br/>';
            }

            echo '<a href = removeemail.html>Voltar</a>';
        ?>
    </body>
</html>