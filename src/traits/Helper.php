<?php


namespace App\traits;


trait Helper
{
    public function parseNumber($number)
    {
        if ($number > 999999999999) {
            return;
        }

        $singleArray = ['','один','два','три','четыре','пять','шесть','семь','восемь','девять'];
        $decimalArray = ['','одиннадцать','двенадцать','тринадцать','четырнадцать','пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'];
        $decimalBigArray = ['','десять','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'];
        $hundredsArray= ['','сто', 'двести','триста','четыреста','пятсот', 'шестьсот', 'семьсот','восемьсот','девятьсот'];


        $array = [];
        $resultArray = [];
        $length =  strlen($number);

        for ($i = -3; $i > -$length; $i = $i - 3) {
            $array[] = substr($number, $i,3);
        }
        $array[] = substr($number, 0, $length + $i + 3);

        foreach ($array as $key => $item) {
            $string = '';
            switch (strlen($item)) {
                case 2:
                    $item = '0'.$item;
                    break;
                case 1:
                    $item = '00'.$item;
                    break;
            }

            for ($i=0;$i<=2;$i++){
                $number = substr($item,$i,1);
                switch ($i){
                    case 0:
                        $string .= $hundredsArray[$number] .' ';
                        break;
                    case 1:
                        if ($number == 1) {
                            $decimalNumber = substr($item,$i+1,1);
                            $string .= $decimalArray[$decimalNumber] . ' ';
                        } else {
                            $string .= $decimalBigArray[$number] . ' ';
                        }
                        break;
                    case 2:
                        if ( ! $decimalNumber) {
                            $string .= $singleArray[$number] . ' ';
                        }
                        break;
                }
            }
            unset($decimalNumber);

            $beetween = (10 < substr($item,1,2) && substr($item,1,2) < 20);
            switch ($key) {
                case 0:
                    break;
                case 1:
                    $string .= (substr($item,2,1) > 4 || $beetween)? 'тысяч ':' тысячи ';
                    break;
                case 2:
                    $string .= (substr($item,2,1) > 4 || $beetween)? 'миллионов ':'миллиона ';
                    break;
                case 3:
                    $string .= (substr($item,2,1) > 4 || $beetween)? 'миллиардов ':'миллиарда ';
                    break;
            }
            $resultArray[] = $string;
        }
        return implode(array_reverse($resultArray));
    }
}