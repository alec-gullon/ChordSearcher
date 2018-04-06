<?php

namespace App\Factories;

use App\Model\Fret;

class FretFactory {

    public function makeFret($bar) {
        return new Fret($bar);
    }

}