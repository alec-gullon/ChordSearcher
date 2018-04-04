<?php

namespace Tests\Model;

use App\Model\NeckSection;

use PHPUnit\Framework\TestCase;

class NeckSectionTest extends TestCase {

    public function __construct() {
        parent::__construct();
        require __DIR__ . '/../../config/constants.php';
        require __DIR__ . '/../../helpers/notes.php';
    }

    public function testDeterminesNotesCorrectly() {
        $neckSection = new NeckSection();
        $neckSection->barPosition = 5;
        $neckSection->determineNotes();

        $this->assertEquals($neckSection->notes[1][0], 'A');
        $this->assertEquals($neckSection->notes[2][2], 'G#');
        $this->assertEquals($neckSection->notes[4][5], 'C');
    }

}