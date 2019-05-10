<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Risky Jobs - Search</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <img src="img/riskyjobs_title.gif" alt="Risky Jobs" />
        <img src="img/riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />

        <h3>Risky Jobs - Resultado</h3>

        <?php
            $sort = $_GET['sort'] ?? 0;
            $user_search = $_GET['usersearch'];
            
            // Inicia a tabela de resultados
            echo '<div style="width:650px; min-height:400px; padding:5px; border:1px solid">';
            
            // cabeçalho de titulos
            echo '<div class="heading result_search">';
            require_once 'scripts/util.php';
            // Gera os titulos dos resultados com links de redirecionamento
            echo generate_sort_links($user_search, $sort);
            echo '</div>';

            // Conecta-se ao banco de dados
            require_once 'scripts/connectvars.php';
            $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or die('Could not connect to the database server '.
                               mysqli_connect_error());

            // Faz a consulta ao banco de dados
            // $query = "SELECT * FROM riskyjobs WHERE title = '$user_search'";
            $query = build_query($user_search, $sort);
            $result = $dbc->query($query)
                        or die('Error querying database.');

            // Mostra os resultados da consulta
            while ($row = $result->fetch_assoc()) {
                echo '<div class="results" style="width:100%; min-height:100px">';
                echo '<div class="title">' . $row['title'] . '</div>';
                echo '<div class="description">' . substr($row['description'], 0, 100) . '...</div>';
                echo '<div class="state">' . $row['state'] . '</div>';
                $date = substr($row['date_posted'], 0, 10);
                echo '<div class="date_posted">' . $date . '</div>';
                echo '</div>';
            }
            // Finaliza a tabela de resultados
            echo '</div>';

            $dbc->close();
        ?>
    </body>
</html>