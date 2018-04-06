<?php
require __DIR__ . '/layouts/header.php';
?>

<?php
require __DIR__ . '/partials/form.php';
?>

<?php foreach($diagrams as $diagram): $data = $diagram->viewData(); ?>

<div class="main-form chord-diagram">
    <div class="main-form-strings">
        <?php for($i = 0; $i <=5; $i++): ?>
            <div class="main-form-string" style="top: <?php echo 15+($i*30); ?>px;"></div>
        <?php endfor; ?>
        <?php foreach($data['strings'] as $string): ?>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 main-form-string-wrapper">
                <?php for($i = 15; $i >= 2; $i--): ?>
                        <div class="main-form-fret">
                            <?php if($string['fret'] > 1 && $data['bar'] + ($string['fret']-1) === $i ): ?>
                            <div class="chord-diagram-selected"><?php echo $i-1; ?></div>
                            <?php endif; ?>
                        </div>
                <?php endfor; ?>
                <div class="main-form-fret">
                    <?php if($string['fret'] == 1): ?>
                        <div class="chord-diagram-selected"></div>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<!--    <div class="chord-diagram-string">-->
<!--        --><?php //for($i = 5; $i >= 2; $i--): ?>
<!--            <div class="chord-diagram-fret">-->
<!--                --><?php //if($string['fret'] === $i): ?>
<!--                    <div class="chord-diagram-selected-fret"></div>-->
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        --><?php //endfor; ?>
<!--        <div class="chord-diagram-fret">-->
<!--            --><?php //if($string['fret'] === 1): ?>
<!--                <div class="chord-diagram-selected-fret"></div>-->
<!--            --><?php //elseif($string['fret'] === 0): ?>
<!--                <div class="chord-diagram-muted-fret"></div>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <div class="chord-diagram-label">-->
<!--            --><?php //echo $string['label']; ?>
<!--        </div>-->
<!--    </div>-->

<?php endforeach; ?>

<?php
require __DIR__ . '/layouts/footer.php';
?>
