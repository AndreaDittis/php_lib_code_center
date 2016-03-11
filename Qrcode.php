<?php

//需要PHP的Qrcode类库
//define('PHPQRCODE', './Qrcode');
//include_once(PHPQRCODE."/phpqrcode.php");
//include_once(PHPQRCODE."/watermask.php");

class MY_Qrcode{
	public static function generate_qrcode($value, $is_outfile = FALSE, $errorCorrectionLevel = 'L', $matrixPointSize = 5) {

		$img = QRcode::png($value, $is_outfile, $errorCorrectionLevel, $matrixPointSize);
		return $img;
	}
}

echo MY_Qrcode::generate_qrcode('www.baidu.com', FALSE, 'M');