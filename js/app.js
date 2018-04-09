mutedInputs = document.getElementsByClassName('main-form-fret-muted');

for(var i = 0; i <= 5; i++) {
    var input = mutedInputs[i].children[0];

    input.addEventListener('click', function() {
        // toggle mutes
    });

}