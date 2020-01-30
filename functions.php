<?php

//// --- INPUTS ---- ////

/**
 * FUNCTION to check if fence length input has data
 * @return int|mixed
 */
//function check_fen_len_input():int {
//    if(isset($_GET['fence_length_input'])) {
//        $fence_length = $_GET['fence_length_input'];
//    } else {
//        $fence_length = 100;
//    }
//    return $fence_length;
//}

function check_fen_len_input() {
    if(isset($_GET['fence_length_input'])) {
        $input_returned = is_numeric($_GET['fence_length_input']) ?
            $_GET['fence_length_input'] * 1 : $_GET['fence_length_input'];
        return $input_returned;
    } elseif (isset($_GET['fence_length_input']) === false) {
        return null;
    } else {
        return 'error! please input integer';
    }
}

/**
 * FUNCTION to check if post width input has data
 * @return int|mixed
 */
function check_pos_wid_input() {
    if(isset($_GET['post_width_input'])) {
        $post_width = $_GET['post_width_input'];
    } else {
        $post_width = 100;
    }
    return $post_width;
}

/**
 * FUNCTION to check if panel length input has data
 * @return int|mixed
 */
function check_pan_len_input() {
    if(isset($_GET['panel_length_input'])) {
        $panel_length = $_GET['panel_length_input'];
    } else {
        $panel_length = 1500;
    }
    return $panel_length;
}

/**
 * FUNCTION to check if post number input has data
 * @return int|mixed
 */
function check_pos_num_input() {
    if(isset($_GET['post_number_input'])) {
        $post_number = $_GET['post_number_input'];
    } else {
        $post_number = 0;
    }
    return $post_number;
}

/**
 * FUNCTION to check if panel number input has data
 * @return int|mixed
 */
function check_pan_num_input() {
    if(isset($_GET['panel_number_input'])) {
        $panel_number = $_GET['panel_number_input'];
    } else {
        $panel_number = 0;
    }
    return $panel_number;
}



//// --- DESIRED FENCE LENGTH ---- ////


/**
 * FUNCTION to calc fence length FROM meters into mm
 * @param $f_len
 * @return float|int
 */
function fence_calc_mm ($f_len) {
    if(is_int($f_len)) {
        $fen_len_mm = $f_len * 1000;
        return ceil($fen_len_mm);
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
    if(is_int($num) && is_int($total)) {
        $percentage = $num / $total;
        return floatval($percentage);
    } elseif ($num === null || $total === null) {
        return null;
    } else {
        return 'error! Expecting two integers on calc_per';
    }
}

/**
 * FUNCTION to calc number of POST
 * @param $f_len, is the known fence length
 * @param $pos_total_per, taken from the calculated post percentage
 * @param $pos_wid, taken from the known individual post width
 *
 * @return float|int how many post's needed
 */
function post_calc($f_len, $pos_total_per, $pos_wid) {
    if (is_int($f_len && is_float($pos_total_per) && is_int($pos_wid))) {
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
    if (is_int($f_len && is_float($pan_total_per) && is_int($pan_len))) {
        $num_of_panels = ($f_len * $pan_total_per) / $pan_len;
        return floor($num_of_panels);
    } elseif ($f_len === null || $pan_total_per === null || $pan_len === null) {
        return null;
    } else {
        return 'error! expected integers and/or floats on panel_calc';
    }
}

/**
 * FUNCTION to calc total length of post and panel
 * @param $pos_num
 * @param $pos_wid
 * @param $pan_num
 * @param $pan_len
 * @return float|int
 */
function length_check($pos_num, $pos_wid, $pan_num, $pan_len) {
    if (is_int($pos_num && is_int($pos_wid && is_int($pan_num && is_int($pan_len))))) {
        $length = ($pos_num * $pos_wid) + ($pan_num * $pan_len);
        return $length;
    } elseif ($pos_num === null || $pos_wid === null || $pan_num === null || $pan_len === null) {
        return null;
    } else {
        return 'error! expected integers on length_check';
    }
}


function final_count($current_length, $fence_length, $current_num) {
    if (is_int($current_length && is_int($fence_length) && is_int($current_num))) {
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


//// --- KNOWN NUMBER = POST & PANEL ---- ////


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
    $fence_length = ($pos_wid * $pos_num) + ($pan_len * $pan_num);
    $fence_length_final =  $fence_length / 1000;
    return round($fence_length_final, 2);
}




