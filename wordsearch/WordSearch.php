<?php
/*
TIP: La funcion getPosInBoard retorna la posición de una letra en el tablero
La podés usar en la implementacion de searchWord. Recorda que una matriz en PHP se accede como $board[$fila][$columna]

Ej.
$board = [
    ['a', 'b', 'c', 'd'],
    ['n', 'k', 'l', 'm'],
    ['o', 'f', 'z', 's']
];

getPosInBoard('l',$board) retornará [1,2] >> O sea, fila 1, columna 2 
*/

function getPosInBoard($letter,$board) {
	for ($i=0; $i < count($board) ; $i++) { 
		for ($j=0; $j < count($board[$i]) ; $j++) { 
			if($letter == $board[$i][$j]) {
				return array($i,$j);
			}
		}
	}
	return NULL;
}

function isAdjacent($currentChar, $nextChar, $board) {
	$currentElementPosition = getPosInBoard($currentChar, $board);
	if (is_null($currentElementPosition)) {
		return false;
	}
	else {
		$nextElementPosition = getPosInBoard($nextChar, $board);
		if (is_null($nextElementPosition)) {
			return false;
		}
		else {
			$currentElementRow = $currentElementPosition[0];
			$currentElementColumn = $currentElementPosition[1];
			$lastRow = count($board) - 1;
			$lastColumn = count($board[0]) - 1;
			$nextElementRow = $nextElementPosition[0];
			$nextElementColumn = $nextElementPosition[1];

			if ($currentElementRow == 0)
			{
				if ($currentElementColumn == 0) { // top-left
					return (
						($nextElementColumn == $currentElementColumn + 1) ||
						($nextElementRow == $currentElementRow + 1)
					);
				}
				elseif ($currentElementColumn == $lastColumn) { // top-right
					return (
						($nextElementRow == $currentElementRow + 1) ||
						($nextElementColumn == $currentElementColumn - 1)
					);
				}
				else { // top
					return (
						($nextElementColumn == $currentElementColumn + 1) ||
						($nextElementRow == $currentElementRow + 1) ||
						($nextElementColumn == $currentElementColumn - 1)
					);
				}
			}
			elseif ($currentElementRow == $lastRow)
			{
				if ($currentElementColumn == 0) { // bottom-left
					return (
						($nextElementRow == $currentElementRow -1) ||
						($nextElementColumn == $currentElementColumn + 1)
					);
				}
				elseif ($currentElementColumn == $lastColumn) { // bottom-right
					return (
						($nextElementRow == $currentElementRow - 1) ||
						($nextElementColumn == $currentElementColumn - 1)
					);
				}
				else { // bottom
					return (
						($nextElementRow == $currentElementRow - 1) ||
						($nextElementColumn == $currentElementColumn + 1) ||
						($nextElementColumn == $currentElementColumn - 1)
					);
				}
			}
			else
			{
				if ($currentElementColumn == 0) { // left
					return (
						($nextElementRow == $currentElementRow - 1) ||
						($nextElementColumn == $currentElementColumn + 1) ||
						($nextElementRow == $currentElementRow + 1)
					);
				}
				elseif ($currentElementColumn == $lastColumn) { // right
					return (
						($nextElementRow == $currentElementRow - 1) ||
						($nextElementColumn == $currentElementColumn - 1) ||
						($nextElementRow == $currentElementRow + 1)
					);
				}
				else { // center
					return (
						($nextElementRow == $currentElementRow - 1) ||
						($nextElementColumn == $currentElementColumn + 1) ||
						($nextElementRow == $currentElementRow + 1) ||
						($nextElementColumn == $currentElementColumn - 1)
					);
				}
			}
		}
	}
}

// Debe retornar true o false
function searchWord($board, $str) {
	if (!is_null($str) && !empty($str)) {
		$word = str_split($str);

		$i = 0;
		// Mientras encuentre adyacentes, avanzo
		while (($i < (count($word) - 1)) && isAdjacent($word[$i], $word[$i+1], $board))
			$i++;

		return ($i == (count($word) - 1));
	}
}
