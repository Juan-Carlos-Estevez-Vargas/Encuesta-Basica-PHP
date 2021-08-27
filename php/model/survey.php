<?php
    require_once 'db.php';

    class Survey extends DB{
        private $total_votes;
        private $option_selected;

        public function setOptionSelected($option){
            $this->option_selected = $option;
        }

        public function getOptionSelected(){
            return $this->option_selected;
        }

        public function vote(){
            $query = $this->connect()->prepare('UPDATE lenguajes SET votos = votos + 1 WHERE lenguaje = :lenguaje');
            $query->execute(['lenguaje' => $this->option_selected]);
        }

        public function showResults(){
            return $this->connect()->query('SELECT * FROM lenguajes');
        }

        public function getTotalVotes(){
            $query = $this->connect()->query('SELECT SUM(votos) AS votos_totales FROM lenguajes');
            $this->total_votes = $query->fetch(PDO::FETCH_OBJ)->votos_totales;
            return $this->total_votes;
        }

        public function getPercentageVotes($votes){
            return round(($votes / $this->total_votes) * 100, 0);
        }
    }
?>