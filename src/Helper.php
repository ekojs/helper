<?php declare(strict_types=1);
/**
 * Author: Eko Junaidi Salam <eko.junaidi.salam@gmail.com>
 * License: AGPL-3.0-or-later
 *
 * Helper collections
 */

// @codeCoverageIgnoreStart
if(!function_exists('is_kabisat')){
// @codeCoverageIgnoreEnd

    function is_kabisat($tahun){
        $tahun = intval($tahun);
        return ((($tahun % 4 == 0) && ($tahun % 100 != 0) || ($tahun % 400 == 0))?1:0);
    }
}
