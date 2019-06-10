<?php // Para que usuário faça logout apaga-se os registros dos cookies referente a ele

    // Se o usuário estiver logado, apagar as variáveis de sessão para fazer o logout
    session_start();
    if (isset($_SESSION['user_id'])) {
        // Apaga as variaveis de sessão limpando o array $_SESSION
        $_SESSION = array();

        // Apaga o cookie de sessão, definindo o seu prazo de validade como uma hora atrás (3600)
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600);
        }

        // Finaliza a sessão
        session_destroy();
    }

    if (isset($_COOKIE['user_id'])) {
        // Apaga os cookies user ID e username, definindo os seus 
        // prazos de validade como uma hora atrás (3600)
        setcookie('user_id', '', time() - 3600);
        setcookie('username', '', time() - 3600);
    }

    // Redireciona para a home page
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . 
                dirname($_SERVER['PHP_SELF']) .
                'index.php';
    header('Location: ' . $home_url);
?>