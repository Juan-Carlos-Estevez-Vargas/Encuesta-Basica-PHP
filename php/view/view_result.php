<div class="opcion">
    <?php
        //Anchura de la barra de porcentaje
        $widthBar = $percent * 5;
        $style = 'barra';

        if ($survey->getOptionSelected() == $languaje['lenguaje']){
            $style = 'seleccionado';
        }

        echo $languaje['lenguaje'];
    ?>

    <div class="<?php echo $style; ?>" style="width=<?php echo $widthBar . 'px;' ?>">
        <?php
            echo $percent . '%';
        ?>
    </div>
</div>