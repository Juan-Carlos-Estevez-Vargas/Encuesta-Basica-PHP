<?php
    require_once 'db.php';

    //Clase controladora que extiende de DB
    class Survey extends DB{
        //Variables para el total de los votos y la opción seleccionada
        private $total_votes;
        private $option_selected;

        //Método para setear la opción seleccionada
        public function setOptionSelected($option){
            $this->option_selected = $option;
        }

        //Método para setear la opción seleccionada
        public function getOptionSelected(){
            return $this->option_selected;
        }

        //Método para actualizar los votos en la base de datos
        public function vote(){
            $query = $this->connect()->prepare('UPDATE lenguajes SET votos = votos + 1 WHERE lenguaje = :lenguaje');
            $query->execute(['lenguaje' => $this->option_selected]);
        }

        //Método para mostrar todos los resultados de los lenguajes de programación
        public function showResults(){
            return $this->connect()->query('SELECT * FROM lenguajes');
        }

        //Método para obtener el total de votos de todos los lenguajes de programación
        public function getTotalVotes(){
            $query = $this->connect()->query('SELECT SUM(votos) AS votos_totales FROM lenguajes');
            $this->total_votes = $query->fetch(PDO::FETCH_OBJ)->votos_totales;
            return $this->total_votes;
        }

        //Método para obtener el porcentaje de votos de cada lenguaje
        public function getPercentageVotes($votes){
            return round(($votes / $this->total_votes) * 100, 0);
        }
    }
?>