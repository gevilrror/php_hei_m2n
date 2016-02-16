<?php
/*
 * Copyright (C) Gevilrror
 */

function hei_m2n($m2n){

    if (!isset($m2n['strlist']))
        $m2n['strlist'] = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz|~';

    if (!isset($m2n['from']))
        $m2n['from'] = 10;

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
        $temp1 = ($temp * $m2n['from'] + $t);
        // $divisor = intval($temp1/$m2n['to']);
        $str .= hei_m2n_getStrFormInt(intval($temp1/$m2n['to']), $m2n);
        $temp = $temp1 % $m2n['to'];
        // $temp = $temp1 - ($divisor * $m2n['to']);
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
    return strpos($m2n['strlist'], $str);
}

function hei_m2n_getStrFormInt($int, &$m2n){
    return substr($m2n['strlist'], $int, 1);
}
