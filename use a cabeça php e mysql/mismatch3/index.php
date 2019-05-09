<?php
    // inicia a sessão
    require_once 'scripts/startsession.php';

    // inicia o cabeçalho da página
    $page_title = 'Onde os opostos se atraem!';
    require_once 'scripts/header.php';

    require_once 'scripts/appvars.php';
    require_once 'scripts/connectvars.php';

    // Mostra o menu de navegação
    require_once 'scripts/navmenu.php';

    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
            or die('Could not connect to the database server ' . 
                    mysqli_connect_error());

    $query = "SELECT user_id, first_name, last_name, picture
              FROM mismatch_user
              WHERE first_name IS NOT NULL ORDER BY join_date DESC LIMIT 5";

    $data = $dbc->query($query)
                or die('Error querying database.');

    echo '<h4>Membros:</h4>';

    echo '<div style="width:160px; min-height:400px; padding:5px" >';
    while ($row = $data->fetch_assoc()) {
        echo '<div style="min-height:90px; padding:5px">';
        if (is_file(UPLOAD_PATH . $row['picture']) && 
            filesize(UPLOAD_PATH . $row['picture']) > 0) {
                    
            echo '<div style="float:left"><img src="' . UPLOAD_PATH . $row['picture'] . '"
                                            alt="' . $row['first_name'] . '"/></div>';
        }
        else {
            echo '<div style="float:left"><img src="' . UPLOAD_PATH . 'nopic.jpg' . '"
                                                alt="' . $row['first_name'] . '"/></div>';
        }

        if (isset($_SESSION['user_id'])) {
            echo '<div class="name">
                    <a href="viewprofile.php?user_id=' . $row['user_id'] . '">' 
                        . $row['first_name'] . 
                 '  </a>
                 </div>';
        }
        else {
            echo '<div class="name">' . $row['first_name'] .'</div>';
        }
        echo '</div>';
    }
    echo '</div>';

    $dbc->close();
?>

<?php
    // Insere o rodapé da página
    require_once 'scripts/footer.php';
?>