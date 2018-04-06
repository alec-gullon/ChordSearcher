<?php

namespace Tests\Model;

use App\Model\NotesMatrix;

use PHPUnit\Framework\TestCase;

class NotesMatrixTest extends TestCase {

    public function __construct() {
        parent::__construct();
        require __DIR__ . '/../../config/constants.php';
    }

    public function testBuildsAugmentedNotesCorrectly() {
        $noteMatrix = new NotesMatrix($this->noteMatrix());

        $this->assertEquals($noteMatrix->augmentedNotes[4][4], 'D');
        $this->assertEquals($noteMatrix->augmentedNotes[1][2], 'D');
        $this->assertEquals($noteMatrix->augmentedNotes[5][0], 'G#');
    }

    public function testBuildsMatchingCoordinatesCorrectly() {
        $noteMatrix = new NotesMatrix($this->noteMatrix());
        $noteMatrix->buildMatchingCoordinates($this->notes());

        $reflection = new \ReflectionObject($noteMatrix);
        $variable = $reflection->getProperty('matchingCoordinates');
        $variable->setAccessible(true);

        $this->assertContains([3,0], $variable->getValue($noteMatrix));
        $this->assertContains([1,1], $variable->getValue($noteMatrix));
        $this->assertContains([4,4], $variable->getValue($noteMatrix));
    }

//    public function testBuildsAdmissibleCoordinatesCorrectly() {
//        $noteMatrix = new NotesMatrix($this->noteMatrix());
//        $noteMatrix->buildMatchingCoordinates($this->notes());
//        $noteMatrix->buildAdmissibleCoordinateSets($this->notes());
//
//        $array1 = [
//            [3,0],
//            [1,1],
//            [4,4],
//            [3,5]
//        ];
//
//        $array2 = [
//            [4,0],
//            [1,1],
//            [4,4],
//            [3,5]
//        ];
//
//        // @todo use a custom assertion to check that the first coordinate set belongs, but the second does not
//        $this->assertTrue(false);
//    }

    private function noteMatrix() {
        return [
            0 => ['F', 'A#', 'D#', 'G#', 'C', 'F'],
            1 => ['F#', 'B', 'E', 'A', 'C#', 'F#'],
            2 => ['G', 'C', 'F', 'A#', 'D', 'G'],
            3 => ['G#', 'C#', 'F#', 'B', 'D#', 'G#']
        ];
    }

    private function notes() {
        return [
            'D', 'A', 'F#'
        ];
    }

}