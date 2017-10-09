<?php

namespace Villy\ZhReplace;

class ZhReplace
{

    private $fontLibrary;

    public function __construct()
    {
        $this->fontLibrary = require __DIR__ . '/../config/data.php';
    }

    public function c2t($str)
    {
        $str_t = '';
        $len = strlen($str);
        $a = 0;
        while ($a < $len) {
            if (ord($str{$a}) >= 224 && ord($str{$a}) <= 239) {
                if (($temp = strpos(
                        $this->fontLibrary['utf8_gb2312'], $str{$a} . $str{$a + 1} . $str{$a + 2}
                    )) !== false) {
                    $str_t .= $this->fontLibrary['utf8_big5']{$temp} .
                        $this->fontLibrary['utf8_big5']{$temp + 1} .
                        $this->fontLibrary['utf8_big5']{$temp + 2};

                    $a += 3;
                    continue;
                }
            }
            $str_t .= $str{$a};
            $a += 1;
        }
        return $str_t;
    }


    public function t2c($str)
    {
        $str_t = '';
        $len = strlen($str);
        $a = 0;
        while ($a < $len) {
            if (ord($str{$a}) >= 224 && ord($str{$a}) <= 239) {
                if (($temp = strpos(
                        $this->fontLibrary['utf8_big5'], $str{$a} . $str{$a + 1} . $str{$a + 2}
                    )) !== false) {
                    $str_t .= $this->fontLibrary['utf8_gb2312']{$temp} .
                        $this->fontLibrary['utf8_gb2312']{$temp + 1} .
                        $this->fontLibrary['utf8_gb2312']{$temp + 2};

                    $a += 3;
                    continue;
                }
            }
            $str_t .= $str{$a};
            $a += 1;
        }
        return $str_t;
    }
}
