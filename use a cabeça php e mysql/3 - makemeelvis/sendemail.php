<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Make Me Elvis - Send Email</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        
        <?php
            $subject = $_POST['subject'];
            $text = $_POST['elvismail'];

            if (!empty($subject) && !empty($text)) {
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $dbname = 'elvis_store';

                $dbc = new mysqli($host, $user, $password, $dbname)
                        or die('Could not connect to the database server ' . 
                                mysqli_connect_error());

                $query = "SELECT * FROM email_list";
                $result = $dbc->query($query) 
                            or die('Error querying database.');

                if($result->num_rows > 0) {
                    $from = 'elmer@makemeelvis.com';
                    //retorna um array para $row contendo 
                    //todos os dados de uma linha da tabela
                    while ($row = $result->fetch_assoc()) {
                        $firstname = $row['first_name'];
                        $lastname = $row['last_name'];
                        $msg = "Querido $firstname $lastname, \n" . $text;
                        $to = $row['email'];

                        mail($to, $subject, $msg, 'From:' . $from);
                        echo "Email enviado para: $to<br/>";
                    }
                }

                $dbc->close();
            }
            else {
                echo '<p>Assunto e/ou corpo da mensagem estão vazios.</p>';
            }

            echo "<a href='sendemail.html'>Voltar</a>";
        ?>

    </body>
</html>
