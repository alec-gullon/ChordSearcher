<?php

namespace App\Model;

/**
 * Models a Chord diagram that is output to the view
 *
 * @package App\Model
 */

class ChordDiagram {

    /**
     * @todo
     *
     * @var int
     */
    public $bar = 1;

    /**
     * @todo
     * @var
     */
    public $coordinates;

    public function __construct($bar, $coordinates) {
        $this->bar = $bar;
        $this->coordinates = $coordinates;
    }

    public function viewData() {
        $data = [];

        $data['strings'] = [];
        for($i = 0; $i < 6; $i++) {
            $fret = $this->determineStringPosition($i);
            $data['strings'][] = [
                'fret' => $fret,
                'label'=> OPEN_NOTES[$i],
            ];
            $data['bar'] = $this->bar;
        }
        return $data;
    }

    private function determineStringPosition($string) {
        foreach($this->coordinates as $coordinate) {
            if($coordinate[1] === $string) {
                return $coordinate[0];
            }
        }
        return 0;
    }
}