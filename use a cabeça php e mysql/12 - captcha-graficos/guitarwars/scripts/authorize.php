<?php /*não deve ter espaço antes da tag php*/
    /*
      header -> Função usada para enviar um cabeçalho do servidor para o navegador.
      Deve ser chamado antes de qualquer conteúdo.
    */
    
    $username = 'rock';
    $password = 'roll';

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] != $username || $_SERVER['PHP_AUTH_PW'] != $password) {
        /* 
          Nome do usuario/senha incorretos, então enviar os 
          cabeçalhos de autenticação novamente 
        */
        header('HTTP/1.1 401 Unauthorized'); // informa ao navegador que o usuário não está autorizado a ver a página
        /* 
          no lugar de "Guitar Wars" pode ser outro, é um dominio básico, 
          uma expressão usada para identificar esta autenticação em particular.
          
          obs: todas as páginas que compartilhar esse script
          possuirão o mesmo Basic realm de autenticação "Guitar Wars",
          garantindo que compartilhem o mesmo usuário e senha.
        */
        header('WWW-Authenticate:Basic realm="Guitar Wars"'); 
        /*
          Quando clicar em cancelar na janela de pop-up,
          está função sai do script e gera uma mensagem de erro
          em uma página HTML

          obs: Só é chamada se o usuário sair da janela de autenticação,
          clicando em cancelar.
        */
        exit('<h2>Gitar Wars</h2>Desculpe, você deve digitar um
              usuário e senha válidos para acessar está página');
    }