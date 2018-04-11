<?php

namespace Tests\Model;

use App\Model\Chord;

use PHPUnit\Framework\TestCase;

class ChordDiagramTest extends TestCase {

    public static function setupBeforeClass() {
        require __DIR__ . '/../../config/constants.php';
    }

    public function testViewDataIsCorrect() {
        $coordinates = [
            [1,1], [2,4], [3,3], [4,2], [5,5]
        ];

        $chordDiagram = new Chord(5,$coordinates);
        $viewData = $chordDiagram->diagramData();

        $this->assertEquals($viewData['strings'][4]['fret'], 2);
    }

    /**
     * @param $coordinates
     * @paam $difficulty
     *
     * @dataProvider providerItCalculatesDifficultyCorrectly
     */
    public function testItCalculatesDifficultyCorrectly($coordinates, $difficulty) {
        $chordDiagram = new Chord(1,$coordinates);

        $this->assertEquals($chordDiagram->difficulty(), $difficulty);
    }

    public function providerItCalculatesDifficultyCorrectly() {
        return array(
            array(
                $this->chordVoicings()['barred_A'],
                30
            ),
            array(
                $this->chordVoicings()['open_D'],
                10
            ),
            array(
                $this->chordVoicings()['barred_C'],
                30
            ),
            array(
                $this->chordVoicings()['open_C7'],
                24
            )
        );
    }

    /**
     * @dataProvider providerItCalculatesHeldFretsCorrectly
     */
    public function testItCalculatesHeldFretsCorrectly($coordinates, $heldFrets) {
        $chordDiagram = new Chord(5,$coordinates);
        $frets = $chordDiagram->fingeredFrets();

        $this->assertEquals($frets, $heldFrets);
    }

    public function providerItCalculatesHeldFretsCorrectly() {
        return array(
            array(
                $this->chordVoicings()['barred_A'],
                6
            ),
            array(
                $this->chordVoicings()['open_D'],
                3
            ),
            array(
                $this->chordVoicings()['barred_C'],
                5
            ),
            array(
                $this->chordVoicings()['open_C7'],
                4
            )
        );
    }

    /**
     * @dataProvider providerItCalculatesSpreadCorrectly
     */
    public function testItCalculatesSpreadCorrectly($coordinates, $expectedSpread) {
        $chordDiagram = new Chord(1,$coordinates);
        $spread = $chordDiagram->spread();

        $this->assertEquals($spread, $expectedSpread);
    }

    public function providerItCalculatesSpreadCorrectly() {
        return array(
            array(
                $this->chordVoicings()['barred_A'],
                18
            ),
            array(
                $this->chordVoicings()['open_D'],
                4
            ),
            array(
                $this->chordVoicings()['barred_C'],
                20
            ),
            array(
                $this->chordVoicings()['open_C7'],
                16
            )
        );
    }

    private function chordVoicings() {
        return [
            'open_D' => array( [1, 3], [2,4], [3,4], [2,5]),
            'barred_A' => array( [2,0], [4,1], [4,2], [3,3], [2,4], [2,5]),
            'barred_C' => array( [5,1], [4,2], [2,3], [3,4], [2,5] ),
            'open_C7' => array( [5,1], [4,2], [2,3], [3,4], [1,5] )
        ];
    }

}