<?php
    $openNotes = ['E', 'A', 'D', 'G', 'B', 'e'];
?>

<form action="/build-chords" method="POST" class="main-form">

    <?php foreach($openNotes as $note): ?>

    <div class="main-form-string">

        <?php for($i = 0; $i < 16; $i++): ?>
            <label class="main-form-fret" for="<?php echo $note; ?>-string">
                <input type="radio" name="<?php echo $note; ?>-string" id="<?php echo $note; ?>" value="<?php echo $i; ?>" />
            </label>
        <?php endfor; ?>

        <label><?php echo $note; ?> String</label>

    </div>

    <?php endforeach; ?>

    <button type="submit">Build Chords</button>
</form>