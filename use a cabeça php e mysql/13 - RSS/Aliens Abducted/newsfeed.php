<?php 
    /*Define o tipo de conteúdo de documento
      RSS como XML*/
    header('Content-Type: text/xml'); 
?>
<?php
    /*Esta linha é uma diretiva XML que indica 
      que este documento possui código xml*/
    echo '<?xml version="1.0" encoding="utf-8"?>'; 
?>
<rss version="2.0">
    <!--Abre o canal-->
    <channel>
        <title>Aliens Abducted Me - Newsfeed</title>
        <!--<link></link>-->
        <!--<link rel="stylesheet" type="text/css" href="css/style.css">-->
        <!--Descrição do conteúdo-->
        <description>Alien abduction reports from around the world courtesy of 
                     Owen and his abducted dog Fang.</description>
        <!--Estabelece a lingua do canal-->
        <language>en-us</language>

        <?php
            require_once 'scripts/connectvars.php';

            $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
                        or die ('Could not connect to the database server ' . mysqli_connect_error());

            $query = "SELECT abduction_id, first_name, last_name, 
                             DATE_FORMAT(when_it_happened, '%a, %d %b %y %T') AS when_it_happened_rfc,
                             alien_description, what_they_did
                      FROM aliens_abduction 
                      ORDER BY when_it_happened DESC";
            
            $data = $dbc->query($query);

            while ($row = $data->fetch_assoc()) {
                echo '<item>';
                echo '  <title>' . $row['first_name'] . ' ' .
                            $row['last_name'] . ' - ' .
                            substr($row['alien_description'], 0, 32) .
                            '...</title>';
                echo '<link>index.php?abduction_id=' . $row['abduction_id'] . '</link>';
                echo '  <pubDate>' . $row['when_it_happened_rfc'] . 
                            ' ' . date('T') . '</pubDate>';
                echo '  <description>' . $row['what_they_did'] . '</description>';
                echo '</item>';
            }

            $dbc->close();
        ?>
    <!--Fecha o canal este documento RSS contém apenas um canal-->
    </channel>
</rss>