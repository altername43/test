<?php

/**
 * @param int $a
 * @param int $b
 * @return int
 */
function getRectangles(int $a, int $b): int
{
	$rectangles = 0;

	//если число меньше 2 (для удобства начинаем считать не с 0, а с 1), то прямоугольников не будет
	if ($a < 2 && $b < 2) {
		return $rectangles;
	}

	// теперь основной функционал, моя ошибка заключалась в том, что после подсчета
	// горизонтальных прямоугольников я пошла считать вертикальные
	// сначала полностью считаем горизонтальные
	$keyForA = 1; // переменные для подсчета итераций
	$keyForB = 1;
	$i[$keyForA] = 1; // это по умолчанию первыe прямоугольники 1*1
	$j[$keyForB] = 1;
	$rectanglesA = 0;

	for ($keyForA = 1; $keyForA < $a; $keyForA++) { // первый цикл по вертикальной стороне ($a)
		$i[$keyForA] = $i[$keyForA - 1] + $keyForA; // новое значение кладем в массив, ключ увеличивваем на 1
		if ($keyForA === $a - 1) {
			unset($i[1]);
			if ($a - 1 === 2) { // в таком случае будет одна горизонтальная строка и следующие манипуляции не понадобятся
				$rectanglesA = $i[$keyForA] * 2;
			}
			$rectanglesA = array_sum($i); // получили вертикальные прямоугольники
			if ($b - 1 !== 2) { // в таком случае будет одна вертикальная строка и умножение не понадобится
				$rectanglesA = $rectanglesA * ($b - 1); // и их общее количество по всем вертикальным строкам
			}
		}
		for ($keyForB = 2; $keyForB < $b; $keyForB++) { // вложенный цикл, чтобы в рамках каждой итерации по $a посчитать прямоугольники для каждой горизонтальной строчки ($b)
			$j[$keyForB] = $j[$keyForB - 1] + $keyForB; // новое значение кладем в массив, ключ увеличиваем на 1
			if ($keyForB === $b - 1) {
				$rectangles = $rectangles + $j[$keyForB]; //в последнюю итерацию кладем значение из вспомогательной переменной в прямоугольники
			}
		}
	}
	$rectangles = $rectangles + $rectanglesA; // сумма значений, полученных в результате 2 завершенных циклов и есть искомое число - общее количество всех прямоугольников

	return $rectangles;
}
echo 'Сумма всех прямоугольников: ' . getRectangles(3, 3);
