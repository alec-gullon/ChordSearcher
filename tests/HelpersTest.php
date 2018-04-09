<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use App\Helpers\NotesHelper;

class HelpersTest extends TestCase {

    public static function setupBeforeClass() {
        require __DIR__ . '/../config/constants.php';
    }

    public function testAdvanceNote() {
        $newNote = NotesHelper::advanceNote('E', 4);
        $this->assertEquals($newNote, 'G#');

        $newNote = NotesHelper::advanceNote('G', 12);
        $this->assertEquals($newNote, 'G');
    }

    public function testBarNotes() {
        $barreNotes = NotesHelper::barNotes(5);

        $this->assertEquals($barreNotes[1], 'D');
    }

}