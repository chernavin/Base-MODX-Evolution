<?php
/*
* Image util library 1.0.0
*
* Copyright (c) 2010 smallder.ru
* Dual licensed under the MIT (MIT-LICENSE.txt)
* and GPL (GPL-LICENSE.txt) licenses.
*
* Depends:
* PHP 5 with GD
*/

/**
* Инструментарий для работы с изображениями
*/
class imageUtil
{
	/**
	 * Накладывает одно изображение на другое.
	 * Дублирует функционал imagecopymerge из GD, т.к. та некорректно отрабатывает полностью прозрачные пиксели.
	 *
	 * @param resource $dstImg Изображение-подложка
	 * @param resource $srcImg Изображение, которое накладываем
	 * @param integer $dstX Смещение накладываемого изображения относительно подложки по X
	 * @param integer $dstY Смещение накладываемого изображения относительно подложки по Y
	 * @param integer $srcX Стартовая точка накладываемого изображения по X
	 * @param integer $srcY Стартовая точка накладываемого изображения по Y
	 * @param integer $srcW Ширина накладываемого изображения
	 * @param integer $srcH Высота накладываемого изображения
	 * @param integer $opacity Прозрачность накладываемого изображения
	 * @return void
	 */
	public static function copyMerge($dstImg, $srcImg, $dstX, $dstY, $srcX, $srcY, $srcW, $srcH, $opacity = 0)
	{
		$dstW = imagesx($dstImg);
		$dstH = imagesy($dstImg);
		$srcW = min(imagesx($srcImg), $srcW);
		$srcH = min(imagesy($srcImg), $srcH);
		//перебираем пиксели $srcImg
		for($srcPointX = $srcX; $srcPointX < $srcW; $srcPointX++)
		{
			for($srcPointY = $srcY; $srcPointY < $srcH; $srcPointY++)
			{
				//определяем соответствующие координаты в $dstImg
				$dstPointX = $dstX + $srcPointX - $srcX;
				$dstPointY = $dstY + $srcPointY - $srcY;
				
				//проверяем, не вышли ли за пределы $dstImg
				if($dstPointX >= 0 && $dstPointX < $dstW && $dstPointY >= 0 && $dstPointY < $dstH)
				{
					//получаем RGB-цвет точки $srcImg
					$srcIndex = imagecolorat($srcImg, $srcPointX, $srcPointY);
					$srcData = imagecolorsforindex($srcImg, $srcIndex);
					
					//полностью прозрачные пиксели игнорируем
					if($srcData['alpha'] < 127)
					{
						//получаем RGB-цвет точки $dstImg
						$dstIndex = imagecolorat($dstImg, $dstPointX, $dstPointY);
						$dstData = imagecolorsforindex($dstImg, $dstIndex);
						
						//рассчитываем прозрачность точки $srcImg в долях единицы
						$srcAlpha = round(((127 - $srcData['alpha']) / 127), 2);
						$srcAlpha = $srcAlpha * $opacity / 100;
						
						//рассчитываем цветовые составляющие и прозрачность результирующего пикселя
						$avgRed = self::getAverageColor($dstData['red'], $srcData['red'], $srcAlpha);
						$avgGreen = self::getAverageColor($dstData['green'], $srcData['green'], $srcAlpha);
						$avgBlue = self::getAverageColor($dstData['blue'], $srcData['blue'], $srcAlpha);
						$newAlpha = min($dstData['alpha'], $srcData['alpha']);
						
						//получаем индекс цвета из палитры
						$newColor = self::getPaletteColor($dstImg, $avgRed, $avgGreen, $avgBlue, $newAlpha);
						
						//рисуем пиксель
						imagesetpixel($dstImg, $dstPointX, $dstPointY, $newColor);
					}
				}
			}
		}
	}
	
	/**
	 * Возвращает результат сложения цветовых каналов
	 *
	 * @param integer $colorOne Первый цвет
	 * @param integer $colorOne Второй цвет
	 * @param integer $alpha Уровень прозрачности
	 * @return integer
	 */
	protected static function getAverageColor($colorOne, $colorTwo, $alpha)
	{
		return round((($colorOne * (1 - $alpha)) + ($colorTwo * $alpha)));
	}
	
	/**
	 * Ищет цвет в палитре, если такого нет - создает.
	 *
	 * @param resource $img Изображение
	 * @param integer $r Красный
	 * @param integer $g Зеленый
	 * @param integer $b Синий
	 * @param integer $alpha Уровень прозрачности
	 * @return integer
	 */
	protected static function getPaletteColor($img, $r, $g, $b, $alpha)
	{
		$c = imagecolorexactalpha($img, $r, $g, $b, $alpha);
		if($c != -1)
			return $c;
		$c = imagecolorallocate($img, $r, $g, $b, $alpha);
		if($c != -1)
			return $c;
		return imagecolorclosest($img, $r, $g, $b, $alpha);
	}
}
?>
