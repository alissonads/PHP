<?php
    // Gera o menu de navegação
    echo '<hr/>';

    if (isset($_SESSION['username'])) {
        echo '<a href="index.php">Home</a> &#10084; ';
        echo '<a href="viewprofile.php">Perfil</a> &#10084; ';
        echo '<a href="editprofile.php">Editar</a> &#10084; ';
        echo '<a href="questionnaire.php">Questionário</a> &#10084; ';
        echo '<a href="mymismatch.php">Meu Par Imperfeito</a> &#10084; ';
        echo '<a href="logout.php">Sair (' . $_SESSION['username'] . ')</a>';
    }
    else {
        echo '<a href="login.php">Entrar</a> &#10084; ';
        echo '<a href="signup.php">Cadastrar-se</a>';
    }

    echo '<hr/>'
?>