<?php
    $openNotes = ['E', 'A', 'D', 'G', 'B', 'e'];
?>

<form action="/build-chords" method="POST">

    <?php foreach($openNotes as $note): ?>

        <label><?php echo $note; ?> String</label>

        <?php for($i = 0; $i < 16; $i++): ?>

            <input type="radio" name="<?php echo $note; ?>-string" value="<?php echo $i; ?>" />

        <?php endfor; ?>

    <?php endforeach; ?>

    <button type="submit">Build Chords</button>
</form>