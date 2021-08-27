<?php
    include 'php/model/survey.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Encuesta</title>
</head>
<body>
    <form action="#" method="post">
        <?php
            $survey = new Survey();
            $show_results = false;

            if (isset($_POST['lenguaje'])){
                $show_results = true;
                $survey->setOptionSelected($_POST['lenguaje']);
                $survey->vote();
            }
        ?>

        <h2>¿Cual es tu lenguaje de programación favorito?</h2>
        
        <?php
            if ($show_results){
                $languajes = $survey->showResults();
                echo '<h2>' . $survey->getTotalVotes() . ' votos totales</h2>';
                foreach($languajes as $languaje){
                    $percent = $survey->getPercentageVotes($languaje['votos']);
                    include 'php/view/view_result.php';
                }
            } else {
                include 'php/view/view_vote.php';
            }
        ?>
    </form>

</body>
</html>