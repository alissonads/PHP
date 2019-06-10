<?php
    // inicia a sessão
    require_once 'scripts/startsession.php';
    
    // inicia o cabeçalho da página
    $page_title = 'Meu Par Imperfeito';
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
    
    // Só procura pelo par se o usuário tiver respostas armazenadas
    $query = "SELECT * FROM mismatch_response
              WHERE user_id = '" . $_SESSION['user_id'] . "'";
    
    $data = $dbc->query($query)
                or die('Error querying database.');
    
    if ($data->num_rows != 0) {
        // Primeiro, obtém as respostas do usuário a partir da 
        // respectiva tabela (join para obter o nome do tópico)
        $query = "SELECT mr.response_id, mr.topic_id, mr.response, 
                         mt.name AS topic_name, mc.name AS category_name
                  FROM mismatch_response AS mr
                  INNER JOIN mismatch_topic AS mt USING (topic_id)
                  INNER JOIN mismatch_category AS mc USING (category_id)
                  WHERE mr.user_id = '" . $_SESSION['user_id'] . "'";
        $data = $dbc->query($query)
                    or die('Error querying database.');
        
        $user_responses = array();

        while ($row = $data->fetch_assoc()) {
            $user_responses[] = $row;
        }
        
        // Inicializa os resultados da busca
        $mismatch_score = 0;
        $mismatch_user_id = -1;
        $mismatch_topics = array();
        $mismatch_categories = array();
    
        // Seleciona os ids dos outros usuários para o loop de compraração
        $query = "SELECT user_id FROM mismatch_user
                  WHERE user_id != '" . $_SESSION['user_id'] . "'";
        $data = $dbc->query($query)
                    or die('Error querying database.');
        
        // Loop pela tabela de usuário comparando 
        // as respostas de outras pessoas às respostas do usuário
        while ($row = $data->fetch_assoc()) {
            // Seleciona os dados de resposta para o usuário (um potencial Par imperfeito)
            $query2 = "SELECT response_id, topic_id, response 
                       FROM mismatch_response
                       WHERE user_id = '" . $row['user_id'] . "'";
            $data2 = $dbc->query($query2)
                        or die('Error querying database.');
    
            $mismatch_responses = array();
    
            while ($row2 = $data2->fetch_assoc()) {
                $mismatch_responses[] = $row2;
            }
    
            $score = 0;
            $topics = array();
            $categories = array();
    
            // Compare cada resposta e calcule um total de combinações
            for ($i = 0; $i < count($user_responses); $i++) {
                if ($user_responses[$i]['response'] + $mismatch_responses[$i]['response'] == 3) {
                    $score++;
                    $topics[] = $user_responses[$i]['topic_name'];
                    // Adiciona o nome das categorias em um array
                    $categories[] = $user_responses[$i]['category_name'];
                }
            }

            // Confere esta pessoa tem melhor pontuação do que a ultima
            if ($score > $mismatch_score) {
                // Atualiza or resultados
                $mismatch_score = $score;
                $mismatch_user_id = $row['user_id'];
                $mismatch_topics = array_slice($topics, 0);
                $mismatch_categories = array_slice($categories, 0);
            }
        }

        // Se um par foi achado
        if ($mismatch_user_id != -1) {
            $query = "SELECT username, first_name, last_name, city, state, picture 
                      FROM mismatch_user
                      WHERE user_id = '$mismatch_user_id'";
            $data = $dbc->query($query)
                        or die('Error querying database.');

            if ($data->num_rows == 1) {
                $row = $data->fetch_assoc();

                echo '<div class="label">';
                echo '<div>';
                if (!empty($row['first_name']) && !empty($row['last_name'])) {
                    echo $row['first_name'] . ' ' . $row['last_name'] . '<br/>';
                }
                if (!empty($row['city']) && !empty($row['state'])) {
                    echo $row['city'] . ', ' . $row['state'] . '<br/>';
                }
                echo '</div><div>';
                if (!empty($row['picture'])) {
                    echo '<img src="' . UPLOAD_PATH . $row['picture'] . '" alt="Profile Picture"><br/>';
                }
                echo '</div></div>';

                // Exibir os tópicos
                echo '<h4>Vocês são imperfeitos nos seguintes (' . count($mismatch_topics) . ') tópicos:</h4>';

                foreach ($mismatch_topics as $topic) {
                    echo $topic . '<br/>';
                }

                $category_totals = array(array($mismatch_categories[0], 0));
                foreach ($mismatch_categories as $category) {
                    if ($category_totals[count($category_totals) - 1][0] != $category) {
                        $category_totals[] = array($category, 1);
                    }
                    else {
                        $category_totals[count($category_totals) - 1][1]++;
                    }
                }

                require_once 'scripts/util.php';
                // Gera e exibe a imagem do gráfico de categoria
                echo '<h4>Detalhes das categorias desencontradas: </h4>';
                draw_bar_graph(480, 240, $category_totals, 5, GRAPH . $SESSION['user_id'] . '-mymismatchgraph.png');
                echo '<img src="' . 
                        GRAPH . $SESSION['user_id'] . '-mymismatchgraph.png' . 
                        '" alt="Mismatch category graph" /><br/><br/>';

                echo '<h4>Veja o perfil de <a href=viewprofile.php?user_id=' . $mismatch_user_id . '>' .
                          $row['first_name'] . '</a>.</h4>';
            }
        }
    }
    else {
        echo '<p>Você primeiro deve responder o <a href="questionnaire.php">questionario</a> ' . 
                 'antes de procurar o Par imperfeito</p>';
    }

    $dbc->close();

    require_once 'scripts/footer.php';
?>