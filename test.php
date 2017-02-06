<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2016/7/18
 * Time: 22:27
 */

const max_row = 4;
const max_col = 4;
$snake_arr = [];

function moveRight($cur_row, &$cur_col, $value, &$arr) {
    for ($i=$cur_col;$i < max_col - $cur_row;$i++){
        $arr[$cur_row][$i] = $value++;
    }
    $cur_col = $i -1;
    return $value;
}

function moveDown(&$cur_row, $cur_col, $value, &$arr) {
    for ($i=$cur_row;$i < max_row - $cur_col +1;$i++){
        $arr[$i][$cur_col] = $value++;
    }
    $cur_row = $i - 1;
    return $value;
}

function moveLeft($cur_row, &$cur_col, $value, &$arr) {
    for ($i = $cur_col;$i > $cur_col + $cur_row - max_col - 1;$i--){
        $arr[$cur_row][$i] = $value++;
    }
    return $value;
}

function moveUp(&$cur_row, $cur_col, $value, &$arr) {
    for ($i = $cur_col;$i > $cur_col + $cur_row - max_col - 1;$i--){
        $arr[$cur_row][$i] = $value++;
    }
    return $value;
}

function snake($cur_row = 5, $cur_col = 5, $value = 1, $arr = [])
{
    $value = moveRight($cur_row, $cur_col, $value, $arr);
    $cur_row++;
    if($value > 25) {
        return;
    }
    $value = moveDown($cur_row, $cur_col, $value, $arr);

    $value = moveLeft($cur_row, $cur_col, $value, $arr);
    $value = moveUp($cur_row, $cur_col, $value, $arr);
}
