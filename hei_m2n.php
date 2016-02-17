<?php
/*
 * Copyright (C) Gevilrror
 */

class hei_m2n_t
{
    public $mvalue = '';
    public $rmd = 0; // remainder 余数
    public $m = 10;
    public $n = 62;
    public $slist = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz|~';

    function __construct(array $config = array()) {
        foreach ($config as $key => $value) $this->$key = $value;
    }
}


function hei_m2n_10decimal(hei_m2n_t $m2n, $return_obj = false){
    $mvalues = explode('.', $m2n->mvalue);
    $m2n_int = $m2n;
    $m2n_int->mvalue = $mvalues[0];
    $nvalue = hei_m2n($m2n_int, $return_obj);

    if (isset($mvalues[1])) {
        $m2n_decimal = $m2n;
        $m2n_decimal->mvalue = ($m2n->m==10?'1':'').$mvalues[1];
        $nvalue .= '.'.substr(hei_m2n($m2n_decimal, $return_obj), ($m2n->n==10?1:0));
    }

    $m2n->nvalue = $nvalue;

    return $return_obj ? $m2n : $nvalue;
}


function hei_m2n(hei_m2n_t $m2n, $return_obj = false){

    $mvalue = $m2n->mvalue;

    $nvalue = '';
    while (strlen($m2n->mvalue) > 0) {
        // $m2n = hei_m2n_rmd($m2n);
        hei_m2n_rmd($m2n);
        $nvalue = $m2n->rmd . $nvalue;
    }

    $m2n->mvalue = $mvalue;
    $m2n->nvalue = $nvalue;

    return $return_obj ? $m2n : $nvalue;
}

function hei_m2n_rmd(hei_m2n_t &$m2n){
    $temp = 0;
    $str = '';
    while (strlen($m2n->mvalue) > 0) {
        $t = hei_m2n_getIntFormStr($m2n->mvalue[0], $m2n);
        $temp1 = ($temp * $m2n->m + $t);
        // $divisor = intval($temp1/$m2n->n);
        $str .= hei_m2n_getStrFormInt(intval($temp1/$m2n->n), $m2n);
        $temp = $temp1 % $m2n->n;
        // $temp = $temp1 - ($divisor * $m2n->n);
        $m2n->mvalue = substr($m2n->mvalue, 1);
    }

    while(strlen($str) > 0 && $str[0] == '0'){
        $str = substr($str, 1);
    }

    $m2n->mvalue = $str;
    $m2n->rmd = hei_m2n_getStrFormInt($temp, $m2n);

    return $m2n;
}

function hei_m2n_getIntFormStr($str, hei_m2n_t &$m2n){
    return strpos($m2n->slist, $str);
}

function hei_m2n_getStrFormInt($int, hei_m2n_t &$m2n){
    return substr($m2n->slist, $int, 1);
}




