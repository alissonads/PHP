<?php // Para que usuário faça logout apaga-se os registros dos cookies referente a ele

    // Se o usuário estiver logado, apagar o cookie para fazer o logout
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