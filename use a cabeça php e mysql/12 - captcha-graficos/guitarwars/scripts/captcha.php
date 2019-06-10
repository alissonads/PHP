<?php
    session_start();

    define('CAPTCHA_NUMCHARS', 7);
    define('CAPTCHA_WIDTH', 100);
    define('CAPTCHA_HEIGHT', 25);

    // Gera a senha aleatória
    $pass_phrase = "";
    for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
        $pass_phrase .= chr(rand(97, 122));
    }
    //echo "$pass_phrase <br/>";
    // Armazena a senha criptografada em uma variável de sessão
    $_SESSION['pass_phrase'] = sha1($pass_phrase);

    // Cria a imagem
    $img = @imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT)
				or die("Cannot initialize new GD image stream");

    // Define um fundo branco com texto preto e gráficos cinza
    $bg_color = imagecolorallocate($img, 255, 255, 255);  //branco
    $text_color = imagecolorallocate($img, 0, 0, 0);      //preto
    $graphic_color = imagecolorallocate($img, 64, 64, 64);//cinza escuro

    // Preenche o fundo
    imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

    // Desenha algumas linhas aleatórias
    for ($i = 0; $i < 5; $i++) {
        imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH,
                  rand() % CAPTCHA_HEIGHT, $graphic_color);
    }

    // Insere alguns pontos aleatórios
    for ($i = 0; $i < 50; $i++) {
        imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
    }

    // Desenha a string da senha
    /*imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color,
                 '/../font/Courier New Bold.ttf', $pass_phrase);*/
    imagestring($img, 5, 20, CAPTCHA_HEIGHT - 20, $pass_phrase, $text_color);

    // Faz output da imagem como PNG, usando um cabeçalho
    // Para gerar imagem diretamente na memória,
    // Precisa-se chamar está função para que a imagem
    // seja entregue ao navegador através do cabeçalho.
    header("Content-type: image/png");
    // Envia a imagem gerada diretamente ao navegador
    // ou para um arquivo do servidor
    // retorna true se a imagem existir
    imagepng($img);

    // apaga a imagens
    // retorna true se bem secedida
    imagedestroy($img);
?>