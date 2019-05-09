<?php

    require_once 'Publicacao.php';
    require_once 'Pessoa.php';

    class Livro implements Publicacao {
        private $titulo;
        private $autor;
        private $totalPaginas;
        private $paginaAtual;
        private $aberto;
        private $leitor;

        public function __construct($titulo, 
                                    $autor, 
                                    $totalPaginas, 
                                    $leitor) {
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->totalPaginas = $totalPaginas;
            $this->paginaAtual = 0;
            $this->aberto = false;
            $this->leitor = $leitor;
        }

        public function getTitulo() { return $this->titulo; }

        public function getAutor() { return $this->autor; }

        public function getTotalPaginas() { return $this->totalPaginas; }

        public function getPaginaAtual() { return $this->paginaAtual; }

        public function estaAberto() { return $this->aberto; }

        public function getLeitor() { return $this->leitor; }

        public function setTitulo($titulo) { $this->titulo = $titulo; }
        
        public function setAutor($autor) { $this->autor = $autor; }
        
        public function setTotalPaginas($totalPaginas) { $this->totalPaginas = $totalPaginas; }
        
        public function setPaginaAtual($paginaAtual) { $this->paginaAtual = $paginaAtual; }
        
        public function setLeitor($leitor) { $this->leitor = $leitor; }

        public function abrir() {
            $this->aberto = true;
            $this->avancarPagina();
        }

        public function fechar() {
            $this->aberto = false;
        }

        public function folhear($pagina) {
            if ($pagina > $this->totalPaginas ||
                $pagina < 1) {
                echo "Página inválida: $pagina";
            }
            else if (!$this->estaAberto()) {
                $this->abrir();
                $this->paginaAtual = $pagina;
            }
        }

        public function avancarPagina() {
            $this->paginaAtual++;
            if ($this->paginaAtual > $this->totalPaginas) {
                echo "Não existem mais páginas. Você já terminou de lêr o livro.<br>";
                $this->voltarPagina();
            }
        }

        public function voltarPagina() {
            $this->paginaAtual--;
            if ($this->paginaAtual <= 0) {
                $this->fechar();
                $this->paginaAtual = 0;
            }
        }

        public function detalhes() {

            echo "<hr/>Livro: $this->titulo <br/>";
            echo "Autor: $this->autor <br/>";
            echo "Total de Página: $this->totalPaginas<br/>";
            echo "Leitor: " . $this->leitor->getNome();
            if ($this->estaAberto())
                echo "<br/>Está lendo a página $this->paginaAtual<br/>";
        }
    }