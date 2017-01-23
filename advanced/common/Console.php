<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/23
 * Time: 18:24
 */

namespace common;


class Console
{
    public static function console($log='')
    {
        switch (empty($log)) {
            case False:
                $out = json_encode($log);
                $GLOBALS['console'] .= 'console.log('.$out.');';
                break;

            default:
                echo '<script type="text/javascript">'.$GLOBALS['console'].'</script>';
        }
    }
}