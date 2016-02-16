<?php
/*
 * Copyright (C) Gevilrror
 */

// $m2n = array(
// 	'mvalue' => '',
// 	'rmd' => 0, // 余数
// 	'm' => 10,
// 	'n' => 8,
// 	'slist' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz|~',
// );

function hei_m2n($m2n){

	if (!isset($m2n['slist']))
		$m2n['slist'] = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz|~';

	if (!isset($m2n['m']))
		$m2n['m'] = 10;

	$mvalue = $m2n['mvalue'];

	$nvalue = '';
	while (strlen($m2n['mvalue']) > 0) {
		// $m2n = hei_m2n_rmd($m2n);
		hei_m2n_rmd($m2n);
		$nvalue = $m2n['rmd'] . $nvalue;
	}

	$m2n['mvalue'] = $mvalue;
	$m2n['nvalue'] = $nvalue;

	return $m2n;
}

function hei_m2n_rmd(&$m2n){
	$temp = 0;
	$str = '';
	while (strlen($m2n['mvalue']) > 0) {
		$t = hei_m2n_getIntFormStr($m2n['mvalue'][0], $m2n);
		$temp1 = ($temp * $m2n['m'] + $t);
		// $divisor = intval($temp1/$m2n['n']);
		$str .= hei_m2n_getStrFormInt(intval($temp1/$m2n['n']), $m2n);
		$temp = $temp1 % $m2n['n'];
		// $temp = $temp1 - ($divisor * $m2n['n']);
		$m2n['mvalue'] = substr($m2n['mvalue'], 1);
	}

	while(strlen($str) > 0 && $str[0] == '0'){
		$str = substr($str, 1);
	}

	$m2n['mvalue'] = $str;
	$m2n['rmd'] = hei_m2n_getStrFormInt($temp, $m2n);

	return $m2n;
}

function hei_m2n_getIntFormStr($str, &$m2n){
	return strpos($m2n['slist'], $str);
}

function hei_m2n_getStrFormInt($int, &$m2n){
	return substr($m2n['slist'], $int, 1);
}

