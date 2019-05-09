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
        <img src="img/blankface.jpg" width="161" height="350" alt="" style="float:right"/>
        <img src="img/elvislogo.gif" name="elvislogo" width="229" height="32" border="0" alt="Make Me Elvis"/>

        <p><strong>Privado:</strong> Para o uso de Elmer SÓ<br/>
        escreva e envie um e-mail a sócios da lista de clientes.</p>

        <?php
            $subject = $_POST['subject'] ?? '';
            $text = $_POST['elvismail'] ?? '';
            $output_form = true;

            if (isset($_POST['submit'])) {
                if (empty($subject) && empty($text)) {
                    echo '<p class="error">Assunto e corpo da mensagem estão vazios.</p>';
                    $output_form = true;
                }
                elseif (empty($subject) && !empty($text)) {
                    echo '<p class="error">Assunto da mensagem está vazio.</p>';
                    $output_form = true;
                }
                elseif (!empty($subject) && empty($text)) {
                    echo '<p class="error">corpo da mensagem está vazio.</p>';
                    $output_form = true;
                }
                else {
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
                    $output_form = false;

                    echo '<br/><a href=' . $_SERVER['PHP_SELF'] . '>Voltar</a>';
                }
            }

            if ($output_form) {
        ?>

        <!--$_SERVER['PHP_SELF'] retorna a pagina atual sendemail.php.
             vantagens se renomear o arquivo não dará erro-->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="subject">Assunto do email: </label><br/>
            <input type="text" name="subject" id="subject" size="30" value="<?php echo $subject; ?>"/><br/><br/>
            <label for="elvismail">Conteudo do email: </label><br/>
            <textarea name="elvismail" id="elvismail" cols="40" rows="8"><?php echo $text; ?></textarea><br/><br/>
            <input type="submit" name="submit" value="Enviar"/>
        </form>

        <?php } ?>
    </body>
</html>
