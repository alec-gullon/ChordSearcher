var mutedInputs = document.getElementsByClassName('main-form-fretmuted');

for(var i = 0; i <= 5; i++) {
    var input = mutedInputs[i];

    var lastIds = {
        'E-string': true,
        'A-string': true,
        'D-string': true,
        'G-string': true,
        'B-string': true,
        'e-string': true
    };
    // input.addEventListener('click', function(event) {
    //     if(lastSelected) {
    //         mutedInputs[1].checked = true;
    //         lastSelected = false;
    //     } else {
    //         lastSelected = true;
    //     }
    // });
}