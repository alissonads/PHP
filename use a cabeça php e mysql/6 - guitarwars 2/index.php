<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Guitar Wars - Pontuação</h2>

    <p>Bem vindo, Guerreiro Guitar, <a href="addscore.php">adicione sua pontuação</a>.</p>

    <div class="bodyscore">
        <!--cabeçalho-->
        <?php
            require_once 'scripts/appvars.php';
            require_once 'scripts/connectvars.php';
    
            $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or die('Could not connect to the database server' . mysqli_connect_error());
    
            $query = "SELECT `name`, `date`, `score`, `screenshot` 
                      FROM guitarwars 
                      WHERE approved = 1 
                      ORDER BY `score` DESC, `date` ASC";

            if ($result = $dbc->prepare($query)) {
                $result->execute();
                $result->bind_result($name, $date, $score, $screenshot);

                $i = 0;
                while ($result->fetch()) {
                    if ($i == 0) {
                        echo "<div class='scoreheader'>
                                  Top Score: $score
                              </div>";
                    }
                    
                    $dt = explode(' ', $date);
                    $date = $dt[0];
                    $hour = $dt[1];
                    
                    echo "<div class='scoreinfo'>
                              <p><strong>$score</strong></p>
                              <p><strong>Nome: $name</strong></p>
                              <p><strong>Data: $date</strong></p>
                              <p><strong>Hora: $hour</strong></p>
                          </div>";
                    
                    echo '<div class="score">';
                    if (is_file(UPLOAD_PATH . $screenshot) &&
                        filesize(UPLOAD_PATH . $screenshot) > 0) {
                        echo '<img src="' . UPLOAD_PATH . $screenshot . '" alt="Score image"/>';
                    }
                    echo '</div>';

                    echo '<div class="finish"></div>';
                    $i++;
                }

                $result->close();
            }
        
            $dbc->close();
        ?>

        </div>
    </div>
</body>
</html>