<?php
    function build_query(string $user_search, int $sort) {
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

    function generate_sort_links(string $user_search, int $sort) {
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
?>