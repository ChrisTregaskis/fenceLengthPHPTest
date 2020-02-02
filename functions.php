<?php




/**
 * FUNCTION checking input active and converting to int defaulting 100
 * @param $input, used for fence length and post width input
 * @return float|int|string|null
 */
function check_input($input) {
    if(isset($input)) {
        $input_returned = is_numeric($input) ?
            $input * 1 : $input = 'error! please input integer';
        return $input_returned;
    } elseif (!(isset($input))) {
        return 0;
    } else {
        return 'error! please input integer';
    }
}

/**
 * FUNCTION to calc fence length FROM meters into mm
 * @param $f_len
 * @return float|int|string|null
 */
function fence_calc_mm ($f_len) {
    if(is_int($f_len)) {
        $fen_len_mm = $f_len * 1000;
        return ($fen_len_mm);
    } elseif ($f_len === null) {
        return null;
    } else {
        return 'error! Expecting an integer on fence_calc_mm';
    }
}

/**
 * FUNCTION calc percentage of total length into post & panel
 * @param $num
 * @param $total
 * @return float|int
 */
function calc_percentage($num, $total) {
    if ($num === 0 || $total === 0 || $num === null || $total === null) {
        return null;
    } elseif (is_int($num) && is_int($total)) {
        $percentage = $num / $total;
        return floatval($percentage);
    } else {
        return 'error! Expecting two integers on calc_per';
    }
}

/**
 * FUNCTION return post total int number given inputs (sum + 1 to start AND end with post)
 * @param $f_len, is the known fence length
 * @param $pos_total_per, taken from the calculated post percentage
 * @param $pos_wid, taken from the known individual post width
 *
 * @return float|int how many post's needed
 */
function post_calc($f_len, $pos_total_per, $pos_wid) {
    if (is_int($f_len) && is_float($pos_total_per) && is_int($pos_wid)) {
        $num_of_posts = ($f_len * $pos_total_per) / $pos_wid;
        $num_of_posts_final = $num_of_posts + 1;
        return floor($num_of_posts_final);
    } elseif ($f_len === null || $pos_total_per === null || $pos_wid === null) {
        return null;
    } else {
        return 'error! expected integers and/or floats on post_calc';
    }
}

/**
 * FUNCTION to calc number of PANEL
 * @param $f_len, is the known fence length
 * @param $pan_total_per, taken from the calculated panel percentage
 * @param $pan_len, from the known individual panel length
 *
 * @return float how many panel's are needed
 */
function panel_calc($f_len, $pan_total_per, $pan_len) {
    if (is_int($f_len) && is_float($pan_total_per) && is_int($pan_len)) {
        $num_of_panels = ($f_len * $pan_total_per) / $pan_len;
        return floor($num_of_panels);
    } elseif ($f_len === null || $pan_total_per === null || $pan_len === null) {
        return null;
    } else {
        return 'error! expected integers and/or floats on panel_calc';
    }
}

/**
 * FUNCTION return total length of post and panels in mm given the numbers and length
 * @param $pos_num, calculated number posts
 * @param $pos_wid, known width in mm
 * @param $pan_num, calculated number panels
 * @param $pan_len, known length in mm
 * @return float|int
 */
function length_check($pos_num, $pos_wid, $pan_num, $pan_len) {
    if (is_float($pos_num) && is_int($pos_wid) && is_float($pan_num) && is_int($pan_len)) {
        $length = ($pos_num * $pos_wid) + ($pan_num * $pan_len);
        return $length;
    } elseif ($pos_num === null || $pos_wid === null || $pan_num === null || $pan_len === null) {
        return null;
    } else {
        return 'error! expected integers on length_check';
    }
}

/**
 * FUNCTION to collate the final count of posts, adding 1 post and rail if...
 * ...total length falls under desired length
 * @param $current_length
 * @param $fence_length
 * @param $current_num
 * @return float|int|string
 */
function final_count($current_length, $fence_length, $current_num) {
    if (is_float($current_length) && is_int($fence_length) && is_float($current_num)) {
        if($current_length < $fence_length) {
            $final_count = $current_num + 1;
            return $final_count;
        } else {
            $final_count = $current_num;
            return $final_count;
        }
    } elseif ($current_length === null || $fence_length === null || $current_num === null) {
        return 0;
    } else {
        return 'error! expected integers on final_count';
    }
}

/**
 * FUNCTION calc FENCE length from number of posts and panels
 * @param $pos_wid, post width
 * @param $pos_num, number of posts input
 * @param $pan_len, panel length
 * @param $pan_num, number of panel input
 *
 * @return int final fence length
 */
function fence_length_calc($pos_wid, $pos_num, $pan_len, $pan_num) {
    if (is_int($pos_wid) && is_int($pos_num) && is_int($pan_len) && is_int($pan_num)) {
        $fence_length = ($pos_wid * $pos_num) + ($pan_len * $pan_num);
        $fence_length_final =  $fence_length / 1000;
        return round($fence_length_final, 2);
    } elseif ($pos_wid === null || $pos_num === null || $pan_len === null || $pan_num === null) {
        return 0;
    } else {
        return 'error! expected integers and floats on fence_length_calc';
    }
}



