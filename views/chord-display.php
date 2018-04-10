<?php
require __DIR__ . '/layouts/header.php';
?>

<?php
require __DIR__ . '/partials/form.php';
?>

<?php foreach($categories as $category => $chords): ?>

<div class="row centered">
    <div class="col-md-4"></div>
    <div class="col-md-4"><h1><?php echo $category; ?></h1></div>
    <div class="col-md-4"></div>
</div>

    <?php
        foreach($chords as $chord) {
            $data = $chord->viewData();
            require __DIR__ . '/molecules/chord-diagram.php';
        }
    ?>

<?php endforeach; ?>

<?php
require __DIR__ . '/layouts/footer.php';
?>
