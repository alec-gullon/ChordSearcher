<?php

namespace App\Model;

/**
 * Models a Chord diagram
 *
 * @property int    $bar
 * @property array  $coordinates
 *
 */

class ChordDiagram {

    /**
     * The position of the first barred fret
     *
     * @var int
     */
    public $bar = 1;

    /**
     * Array of coordinates of notes that need to be held down. A coordinate is
     * of form [x,y], where:
     *
     *  - x = 1,..,5 represent fret (1 represents open string)
     *  - y = 0,...5 represents string, from low to high
     *
     * @var array
     */
    public $coordinates;

    public function __construct($bar, $coordinates) {
        $this->bar = $bar;
        $this->coordinates = $coordinates;
    }

    /**
     * The data needed to render a chord diagram.
     *
     * @return array
     */
    public function viewData() {
        $data = [];

        $data['strings'] = [];
        for($i = 0; $i < 6; $i++) {
            $fret = $this->determineStringPosition($i);
            $data['strings'][] = [
                'fret' => $fret,
                'label'=> OPEN_NOTES[$i]['label'],
            ];
        }
        $data['bar'] = $this->bar;
        return $data;
    }

    public function difficulty() {
        return ($this->fingeredFrets()*2) + $this->spread();
    }

    public function fingeredFrets() {
        $fingeredFrets = 0;
        foreach($this->coordinates as $coordinate) {
            if($coordinate[0] > 1) {
                $fingeredFrets++;
            }
        }
        return $fingeredFrets;
    }

    public function spread() {
        $lastFret = 0;
        $firstString = 5;
        $lastString = 0;

        foreach($this->coordinates as $coordinate) {
            if($coordinate[0] === 1) {
                continue;
            }
            if($coordinate[0] > $lastFret) {
                $lastFret = $coordinate[0];
            }
            if($coordinate[1] < $firstString) {
                $firstString = $coordinate[1];
            }
            if($coordinate[1] > $lastString) {
                $lastString = $coordinate[1];
            }
        }

        return ($lastFret - 1) * ($lastString - $firstString + 1);
    }

    /**
     * Determines the strings fret position in the diagram. A string that is not played is
     * represented with position 0
     *
     * @param int   $string
     *
     * @return int
     */
    private function determineStringPosition($string) {
        foreach($this->coordinates as $coordinate) {
            if($coordinate[1] === $string) {
                return $coordinate[0];
            }
        }
        return 0;
    }
}