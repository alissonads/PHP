<?php
    // inicia a sessão
    require_once 'scripts/startsession.php';
    
    // inicia o cabeçalho da página
    $page_title = 'Questionário';
    require_once 'scripts/header.php';
    
    require_once 'scripts/appvars.php';
    require_once 'scripts/connectvars.php';
    
    if (!isset($_SESSION['user_id'])) {
        echo '<p class="error">Por favor faça <a href="login.php">login</a> para 
                acessar esta página.</p>';
        exit();
    }

    // Mostra o menu de navegação
    require_once 'scripts/navmenu.php';
    
    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
            or die('Could not connect to the database server ' . 
                    mysqli_connect_error());

    // Se este usuário jamais respondeu ao questionário, 
    // inserrir respostas vazias no banco de dados
    $query = "SELECT * FROM mismatch_response 
              WHERE user_id = '" . $_SESSION['user_id'] ."'";

    $data = $dbc->query($query)
                or die('Error querying database.');

    if ($data->num_rows == 0) {
        // Primeiramente, obtém a lista de IDS dos
        // tópicos a partir da respectiva tabela
        $query = "SELECT topic_id FROM mismatch_topic
                  ORDER BY category_id, topic_id";
        $data = $dbc->query($query)
                    or die('Error querying database.');
        
        $topicIDs = array();

        while ($row = $data->fetch_assoc()) {
            //array_push($topicIDs, $row['topic_id']);
            $topicIDs[] = $row['topic_id'];
        }

        // insere linhas de respostas na tabela respectiva,
        // uma para cada tópico
        foreach ($topicIDs as $topic_id) {
            $query = "INSERT INTO mismatch_response (user_id, topic_id)
                      VALUES ('" . $_SESSION['user_id'] . "', '$topic_id')";
            $dbc->query($query);
        }
    }

    // Se o formulário tiver sido submetido, escreve as respostas no banco
    if (isset($_POST['submit'])) {
        // Escreve as linhas de respostas na respectiva tabela
        foreach ($_POST as $response_id => $response) {
            $query = "UPDATE mismatch_response 
                      SET response = '$response'
                      WHERE response_id = '$response_id'";
            $dbc->query($query)
                or die('Error querying database.');          
        }

        echo '<p>As suas respostas foram registradas.</p>';
    }

    // Obtém os dados de resposta do banco, para gerar o formulário
    /*$query = "SELECT response_id, topic_id, response 
              FROM mismatch_response 
              WHERE user_id = '" . $_SESSION['user_id'] . "'";*/
    $query = "SELECT mr.response_id, mr.topic_id, mr.response, 
                     mt.name AS topic_name, mc.name AS category_name
              FROM mismatch_response AS mr
              INNER JOIN mismatch_topic AS mt USING (topic_id)
              INNER JOIN mismatch_category AS mc USING (category_id)
              WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";

    $data = $dbc->query($query)
        or die('Error querying database.');
    $responses = array();

    while ($row = $data->fetch_assoc()) {
        // Verificar o nome do tópico correspondente à resposta,
        // na tabela dos tópicos
        /*$query2 = "SELECT name, category FROM mismatch_topic
                   WHERE topic_id = '" . $row['topic_id'] . "'";
        $data2 = $dbc->query($query2)
                    or die('Error querying database.');
        
        if ($data2->num_rows == 1) {
            $row2 = $data2->fetch_assoc();
            $row['topic_name'] = $row2['name'];
            $row['category_name'] = $row2['category'];
            //array_push($responses, $row);
            $responses[] = $row;
        }*/
        $responses[] = $row;
    }

    $dbc->close();

    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
    echo '<p>Como você se sente sobre cada tópico?</p>';
    
    $category = $responses[0]['category_name'];
    
    echo '<fieldset><legend>' . $responses[0]['category_name'] . '</legend>';

    foreach ($responses as $response) {

        if ($category != $response['category_name']) {
            $category = $response['category_name'];
            echo '</fieldset><br/><fieldset><legend>' . $response['category_name'] . '</legend>';
        }

        echo '<label ' . ($response['response'] == null ? 'class="error"' : '') . 
                'for="' . $response['response_id'] . '">' . $response['topic_name'] . ': </label>';
        echo '<input type="radio" name="' . $response['response_id'] . 
               '" id="'. $response['response_id'] . '" value="1"' . 
               ($response['response'] == 1?  'checked="checked"' : '' ) . ' /> Gosto ';

        echo '<input type="radio" name="' . $response['response_id'] . 
              '" id="'. $response['response_id'] . '" value="2"' . 
              ($response['response'] == 2?  'checked="checked"' : '' ) . ' /> Não Gosto <br/>';
    }

    echo '</fieldset><br/>';
    echo '<input type="submit" name="submit" value="Salvar Questionário">';
    echo '</form>';

    // Insere o rodapé da página
    require_once 'scripts/footer.php';
?>