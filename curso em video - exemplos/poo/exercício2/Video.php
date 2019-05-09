<?php
    
    require_once 'ActionsVideo.php';

    class Video implements ActionsVideo {
        private $title;
        private $evaluation;
        private $views;
        private $amountLikes;
        private $reproducing;

        public function __construct($title) {
            $this->title = $title;
            $this->evaluation = 0;
            $this->views = 0;
            $this->amountLikes = 0;
            $this->reproducing = false;
        }

        public function getTitle() { return $this->title; }

        public function getEvaluation() { return $this->evaluation; }

        public function getViews() { return $this->views; }

        public function getAmountLikes() { return $this->amountLikes; }

        public function isReproducing() { return $this->reproducing; }

        public function setTitle($title) { $this->title = $title; }
        
        public function setEvaluation($evaluation) {
            $this->evaluation = ($this->evaluation + $evaluation) / $this->views;
        }
        
        public function setViews($views) { $this->views = $views; }
        
        public function setAmountLikes($amountLikes) { $this->amountLikes = $amountLikes; }

        public function play() {
            $this->reproducing = true;
        }

        public function pause() {
            $this->reproducing = false;
        }
         
        public function like() {
            $this->$amountLikes++;
        }
    }