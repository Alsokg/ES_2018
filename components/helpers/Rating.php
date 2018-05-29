<?php

namespace app\components\helpers;

class Rating{
    public static function getRating($ratingsArr){
        $total = 0;
        foreach($ratingsArr as $item){
            $total += $item['rating'];
        }
        if (count($ratingsArr) > 0){
            return round($total/count($ratingsArr), 0, PHP_ROUND_HALF_UP);
        }
        return 0;
    }
}
?>