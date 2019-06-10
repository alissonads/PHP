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
        <?php
            $firstname = $_POST['firstname'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';

            $host = 'localhost';
            $user = 'root';
            $password = '';
            $dbname = 'elvis_store';

            $dbc = new mysqli($host, $user, $password, $dbname)
                    or die('Could not connect to the database server ' . 
                            mysqli_connect_error());

            $query = "INSERT INTO email_list VALUES
                    ('$firstname', '$lastname', '$email')";

            $dbc->query($query) 
                or die('Error querying database.');

            echo '<p>Cliente adicionado com sucesso!</p>';

            $dbc->close();

            echo "<a href='addemail.html' >Voltar</a>"

        ?>
    </body>
</html>