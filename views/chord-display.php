<?php
require __DIR__ . '/layouts/header.php';
?>

<?php
require __DIR__ . '/partials/form.php';
?>

<?php foreach($diagrams as $diagram): $data = $diagram->viewData(); ?>

    <div class="chord-diagram">
        <?php echo $data['bar']; ?>
        <?php foreach($data['strings'] as $string): ?>
            <div class="chord-diagram-string">
                <?php for($i = 5; $i >= 2; $i--): ?>
                <div class="chord-diagram-fret">
                    <?php if($string['fret'] === $i): ?>
                    <div class="chord-diagram-selected-fret"></div>
                    <?php endif; ?>
                </div>
                <?php endfor; ?>
                <div class="chord-diagram-fret">
                    <?php if($string['fret'] === 1): ?>
                        <div class="chord-diagram-selected-fret"></div>
                    <?php elseif($string['fret'] === 0): ?>
                        <div class="chord-diagram-muted-fret"></div>
                    <?php endif; ?>
                </div>
                <div class="chord-diagram-label">
                    <?php echo $string['label']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php endforeach; ?>

<?php
require __DIR__ . '/layouts/footer.php';
?>
