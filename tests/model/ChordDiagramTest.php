<?php

namespace Tests\Model;

use App\Model\ChordDiagram;

use PHPUnit\Framework\TestCase;

class ChordDiagramTest extends TestCase {

    public function __construct() {
        parent::__construct();
        require __DIR__ . '/../../config/constants.php';
    }

    public function testViewDataIsCorrect() {
        $coordinates = [
            [1,1], [2,4], [3,3], [4,2], [5,5]
        ];

        $chordDiagram = new ChordDiagram(5,$coordinates);
        $viewData = $chordDiagram->viewData();

        $this->assertEquals($viewData['strings'][4]['fret'], 2);
    }

}