<?php

    require_once 'User.php';
    require_once 'Video.php';

    class Visualization {
        private $viewer;
        private $film;

        public function __construct($viewer, $film) {
            $this->viewer = $viewer;
            $this->film = $film;
            $this->film->setViews($this->film->getViews() + 1);
            $this->viewer->addViews();
        }

        public function getViewer() { return $this->viewer; }

        public function getFilm() { return $this->film; }

        public function setViewer($viewer) { $this->viewer = $viewer; }

        public function setFilm($film) { $this->film = $film; }

        public function evaluate() {
            $this->film->setEvaluation(5);
        }

        public function evaluateNot($n) {
            $this->film->setEvaluation($n);
        }

        public function evaluatePerc($p) {
            if ($p <= 20) {
                $n = 3;
            }
            elseif ($p <= 50) {
                $n = 5;
            }
            elseif ($p <= 90) {
                $n = 8;
            }
            else {
                $n = 10;
            }
            $this->film->setEvaluation($n);
        }
    }