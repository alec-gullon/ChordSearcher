<!--<label class="container">-->
<!--    <input type="radio" name="test"/>-->
<!--    <span class="checkmark"></span>-->
<!--</label>-->

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"><h1 class="site-header">Chord Searcher</h1></div>
    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 site-description">
        <p>Chord searcher is a PhP application that helps you experiment with different voicings
    for a particular chord on the guitar. Just input the frets on the guitar neck you are playing and a selection
            of different voicings will be generated for you.</p>
        <p>The application is in the early stage of its life, but plenty more work and updates will be coming soon!</p>
    </div>
    <div class="col-md-4">
        <form action="/set-open-notes" method="POST">
            <h3>Change Open Notes</h3>

        </form>
    </div>
</div>

<form action="/get-chords/" method="GET" class="main-form">
    <div class="main-form-strings">
    <?php for($i = 0; $i <=5; $i++): ?>
        <div class="main-form-string" style="top: <?php echo 15+($i*30); ?>px;"></div>
    <?php endfor; ?>
    <?php foreach($formData['strings'] as $string): ?>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 main-form-string-wrapper">
                <?php for($i = 14; $i >= 0; $i--): ?>
                    <label class="main-form-fret">
                        <input type="radio"
                               name="<?php echo $string['label']; ?>-string"
                               id="<?php echo $string['label'] . '-' . $i; ?>"
                               value="<?php echo $string['notes'][$i]; ?>" />
                        <span class="main-form-fret__radio"><?php echo $string['notes'][$i]; ?></span>
                    </label>
                <?php endfor; ?>
                <label class="main-form-fret-muted">
                    <input  type="radio"
                            name="<?php echo $string['label']; ?>-string"
                            id="<?php echo $string['label'] . '-mute'; ?>"
                            value="X"
                            checked="checked" />
                    <span class="main-form-fret-muted__radio">X</span>
                </label>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 main-form-button">
            <button class="btn btn-default" type="submit">Build Chords</button>
        </div>
        <div class="col-md-4"></div>
    </div>
</form>