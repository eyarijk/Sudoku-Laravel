<?php

namespace App\Game;

Class Sudoku
{

    protected $solution = [];

    protected $lvl;


    public function __construct($lvl)
    {
        $this->solution = $this->calculateSolution($this->generateEmptyPuzzle());
        $this->lvl = $lvl;
    }

    public function getSolution()
    {
        return $this->solution;
    }

    protected function generateEmptyPuzzle()
    {
        return array_fill(0, 9, array_fill(0, 9, 0));
    }

    protected function calculateSolution(array $puzzle)
    {
        while (true) {

            $options = null;

            foreach ($puzzle as $rowIndex => $row) {

                $columnIndex = array_search(0, $row);

                if ($columnIndex === false) {
                    continue;
                }

                $validOptions = $this->getValidOptions($puzzle, $rowIndex, $columnIndex);

                $options = array(
                    'rowIndex' => $rowIndex,
                    'columnIndex' => $columnIndex,
                    'validOptions' => $validOptions
                );

                break;
            }

            if ($options == null) {
                return $puzzle;
            }

            if (count($options['validOptions']) == 1) {
                $puzzle[$options['rowIndex']][$options['columnIndex']] = current($options['validOptions']);
                continue;
            }

            foreach ($options['validOptions'] as $value) {
                $tempPuzzle = $puzzle;
                $tempPuzzle[$options['rowIndex']][$options['columnIndex']] = $value;
                $result = $this->calculateSolution($tempPuzzle);

                if ($result == true) {
                    return $result;
                }
            }

            return false;
        }
    }


    protected function getValidOptions(array $grid, $rowIndex, $columnIndex)
    {
        $invalid = $grid[$rowIndex];

        for ($i = 0; $i < 9; $i++) {
            $invalid[] = $grid[$i][$columnIndex];
        }

        if ($rowIndex % 3 == 0) {
            $boxRow = $rowIndex;
        } else {
            $boxRow = $rowIndex - $rowIndex % 3;
        }

        if ($columnIndex % 3 == 0) {
            $boxColumn = $columnIndex;
        } else {
            $boxColumn = $columnIndex - $columnIndex % 3;
        }

        $invalid = array_unique(
            array_merge(
                $invalid,
                array_slice($grid[$boxRow], $boxColumn, 3),
                array_slice($grid[$boxRow + 1], $boxColumn, 3),
                array_slice($grid[$boxRow + 2], $boxColumn, 3)
            )
        );

        $valid = array_diff(range(1, 9), $invalid);
        shuffle($valid);

        return $valid;
    }

    public function getGame()
    {
        $num = floor(81 * $this->lvl);

        $arr = $this->getSolution();

        while ($num != 0) {

            $randNumV = rand(0, 8);
            $randNumH = rand(0, 8);

            if ($arr[$randNumH][$randNumV] != "") {
                $arr[$randNumH][$randNumV] = "";
                $num--;
            }

        }

        return $arr;
    }


}
