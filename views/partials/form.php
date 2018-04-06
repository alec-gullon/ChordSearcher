<!--<label class="container">-->
<!--    <input type="radio" name="test"/>-->
<!--    <span class="checkmark"></span>-->
<!--</label>-->

<form action="/build-chords" method="POST" class="main-form">

    <?php foreach($formData['strings'] as $string): ?>

    <div class="main-form-string-wrapper">
        <div class="main-form-string"></div>
        <?php for($i = 16; $i >= 0; $i--): ?>
        <label class="main-form-fret">
            <input type="radio" name="<?php echo $string['label']; ?>-string" id="<?php echo $string['label']; ?>" value="<?php echo $string['notes'][$i]; ?>" />
            <span class="main-form-fret__radio"><?php echo $string['notes'][$i]; ?></span>
        </label>
        <?php endfor; ?>

        <label><?php echo $string['label']; ?> String</label>

    </div>

    <?php endforeach; ?>

    <button type="submit">Build Chords</button>
</form>