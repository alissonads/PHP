<?php
    function isImage(array $v) : bool {
        if ($v['type'] == 'image/gif' || $v['type'] == 'image/jpeg' ||
            $v['type'] == 'image/pjpeg' || $v['type'] == 'image/png') {
                return true;
        }
        return false;
    }

    function draw_bar_graph(int $width, int $height, 
                            array $data, int $max_value,
                            string $filename            ) : void {
        // Cria a imagem vazia
        $img = imagecreatetruecolor($width, $height);
        // Define um fundo branco com texto preto e gráficos cinza
        $bg_color = imagecolorallocate($img, 255, 255, 255);
        $text_color = imagecolorallocate($img, 255, 255, 255);
        $bar_color = imagecolorallocate($img, 0, 0, 0);
        $border_color = imagecolorallocate($img, 192, 192, 192);

        // Preenche o fundo
        imagefilledrectangle($img, 0, 0, $width, $height, $bg_color);

        // Desenha as barras
        $bar_width = $width / ((count($data) * 2) + 1);
        for ($i = 0; $i < count($data); $i++) {
            imagefilledrectangle($img, ($i * $bar_width * 2) + $bar_width, $height,
                                ($i * $bar_width * 2) + ($bar_width * 2), 
                                $height - (($height / $max_value) * $data[$i][1]), $bar_color);
            
            imagestringup($img, 5, ($i * $bar_width * 2) + $bar_width, $height - 5, $data[$i][0], $text_color);
        }

        // Desenha um retângulo em torno da imagem inteira
        imagerectangle($img, 0, 0, $width - 1, $height - 1, $border_color);

        // Desenha a faixa de valores no lado esquerdo do gráfico
        for ($i = 1; $i <= $max_value; $i++) {
            imagestring($img, 5, 0, $height - ($i * ($height / $max_value)), $i, $bar_color);
        }

        // Escreve a imagem em um arquivo
        // parametros: imagem, nome do arquivo, compressão (5 médio)
        imagepng($img, $filename, 5);
        imagedestroy($img);
    }
?>