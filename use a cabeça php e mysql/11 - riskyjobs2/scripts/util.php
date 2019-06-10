<?php
    // Cria uma consulta de busca a partir das palavras-chaves
    // de busca e da configuração de classificação
    function build_query(string $user_search, int $sort) : string {
        $search_query = "SELECT * FROM riskyjobs";

        // Remove as possiveis virgulas transformando em espaços
        $clean_search = str_replace(',', ' ', $user_search);
        // Separa as palavras se possuir mais de uma
        $search_words = explode(' ', $clean_search);

        $final_search_words = array();
        // Remove os indics vazios
        // Verifica se tem algum indice vazio na lista
        // senão adiciona-o na nova lista
        if (count($search_words) > 0) {
            foreach ($search_words as $word) {
                if (!empty($word)) {
                    $final_search_words[] = $word;
                }
            }
        }

        // Gera uma cláusula WHERE usando todas as palavras-chaves de busca
        $where_list = array();
        if (count($final_search_words) > 0) {
            foreach ($final_search_words as $word) {
                $where_list[] = "description LIKE '%$word%'";
            }
        }

        // Junta todos os indices da listacriando uma unica
        // string adicionando ' OR ' para separá-las
        $where_clause = implode(' OR ', $where_list);

        // Adiciona a cláusula WHERE à consulta de busca.
        if (!empty($where_clause)) {
            $search_query .= " Where $where_clause";
        }

        switch ($sort) {
            case 1:
                $search_query .= " ORDER BY title";
                break;
            case 2:
                $search_query .= " ORDER BY title DESC";
                break;
            case 3:
                $search_query .= " ORDER BY state";
                break;
            case 4:
                $search_query .= " ORDER BY state DESC";
                break;
            case 5:
                $search_query .= " ORDER BY date_posted";
                break;
            case 6:
                $search_query .= " ORDER BY date_posted DESC";
                break;
            default:
                break;
        }

        return $search_query;
    }

    // Cria links com base na configuração de classificação especificada
    // Ordenando de acordo com o link clicado
    function generate_sort_links(string $user_search, int $sort) : string {
        $sort_links = '';
        // echo '<div class="title">Job Title</div> 
            //       <div class="description">Description</div>
            //       <div class="state">State</div>
            //       <div class="date_posted">Date Posted</div>';
        switch ($sort) {
            case 1:
                $sort_links .= '<div class="title">' .
                                    '<a href="' . $_SERVER['PHP_SELF'] . 
                                    '?usersearch=' . $user_search . '&sort=2">Job Title</a>' .
                               '</div> 
                                <div class="description">Description</div>';

                $sort_links .= '<div class="state">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=3">State</a>' .
                               '</div>';

                $sort_links .= '<div class="date_posted">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=5">Date Posted</a>' .
                               '</div>';
                break;
            case 3:
                $sort_links .= '<div class="title">' .
                                    '<a href="' . $_SERVER['PHP_SELF'] . 
                                    '?usersearch=' . $user_search . '&sort=1">Job Title</a>' .
                               '</div> 
                                <div class="description">Description</div>';

                $sort_links .= '<div class="state">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=4">State</a>' .
                               '</div>';

                $sort_links .= '<div class="date_posted">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=3">Date Posted</a>' .
                               '</div>';
                break;
            case 5:
                $sort_links .= '<div class="title">' .
                                    '<a href="' . $_SERVER['PHP_SELF'] . 
                                    '?usersearch=' . $user_search . '&sort=1">Job Title</a>' .
                               '</div> 
                                <div class="description">Description</div>';

                $sort_links .= '<div class="state">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=3">State</a>' .
                               '</div>';

                $sort_links .= '<div class="date_posted">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=6">Date Posted</a>' .
                               '</div>';
                break;
            default:
                $sort_links .= '<div class="title">' .
                                    '<a href="' . $_SERVER['PHP_SELF'] . 
                                    '?usersearch=' . $user_search . '&sort=1">Job Title</a>' .
                               '</div> 
                                <div class="description">Description</div>';

                $sort_links .= '<div class="state">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=3">State</a>' .
                               '</div>';

                $sort_links .= '<div class="date_posted">' .
                                '<a href="' . $_SERVER['PHP_SELF'] . 
                                '?usersearch=' . $user_search . '&sort=5">Date Posted</a>' .
                               '</div>';
                break;
        }

        return $sort_links;
    }

    // Cria links de navegação, com base na página atual e no número de páginas
    function generate_page_links(string $user_search, 
                                 int $sort, 
                                 int $cur_page, 
                                 int $num_pages) : string{
            
        $page_links = '';

        // Se esta página não for a primeira, gera o link "previous"
        if ($cur_page > 1) {
            $page_links .= '<a href="' . $_SERVER['PHP_SELF'] .
                           '?usersearch=' . $user_search . 
                           '&sort=' . $sort . 
                           '&page=' . ($cur_page - 1) . 
                           '"><-</a>';
        }
        else {
            $page_links .= '<-';
        }

        // Faz um loop através das páginas, gerando os links com os números das páginas
        for ($i = 1; $i <= $num_pages; $i++) {
            if ($cur_page == $i) {
                $page_links .= ' ' . $i;
            }
            else {
                $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] .
                               '?usersearch=' . $user_search . 
                               '&sort=' . $sort . 
                               '&page=' . $i . 
                               '">' . $i . '</a>';
            }
        }

        // Se esta página não for a última, gera o link "next"
        if ($cur_page < $num_pages) {
            $page_links .= '<a href="' . $_SERVER['PHP_SELF'] .
                           '?usersearch=' . $user_search . 
                           '&sort=' . $sort . 
                           '&page=' . ($cur_page + 1) . 
                           '"> -></a>';
        }
        else {
            $page_links .= ' ->';
        }

        return $page_links;
    }

    function win_checkdnsrr($domain, $recType='') {
        if (!empty($domain)) {
            if ($recType == '') $recType = "MX";
            exec("nslookup -type=$recType $domain", $output);

            foreach ($output as $line) {
                if (preg_match("/^$domain/", $line)) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
?>