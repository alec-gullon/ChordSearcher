<?php

namespace App\Factories;

use App\Factories\FretFactory;

use App\Model\NeckSection;

class NeckSectionFactory {

    public function makeNeckSection($bar) {
        $factory = new FretFactory();
        return new NeckSection($bar, $factory);
    }

}