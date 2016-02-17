# php_hei_m2n
php 任意精度整数、任意进制数转换

    $t = microtime(1);
    
    for ($i=0; $i < 10000; $i++) {
    	$m2n_convert = hei_m2n(new hei_m2n_t(array('mvalue'=>'100000000000000000000000000000062','m'=>10,'n'=>64)));
    }
    
    var_dump(microtime(1) - $t, $m2n_convert);

    // float(2.8031599521637)
    // string(18) "JkBMr1MuMixu40000|"
	
