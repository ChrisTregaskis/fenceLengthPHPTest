<?php


//Check if inputs have data otherwise default inputs
function check_fen_len_input() {
    if(isset($_GET['fence_length_input'])) {
        $fence_length = $_GET['fence_length_input'];
    } else {
        $fence_length = 100;
    }
    return $fence_length;
}

function check_pos_wid_input() {
    if(isset($_GET['post_width_input'])) {
        $post_width = $_GET['post_width_input'];
    } else {
        $post_width = 100;
    }
    return $post_width;
}

function check_pan_len_input() {
    if(isset($_GET['panel_length_input'])) {
        $panel_length = $_GET['panel_length_input'];
    } else {
        $panel_length = 1500;
    }
    return $panel_length;
}

function check_pos_num_input() {
    if(isset($_GET['post_number_input'])) {
        $post_number = $_GET['post_number_input'];
    } else {
        $post_number = 0;
    }
    return $post_number;
}

function check_pan_num_input() {
    if(isset($_GET['panel_number_input'])) {
        $panel_number = $_GET['panel_number_input'];
    } else {
        $panel_number = 0;
    }
    return $panel_number;
}


/**
 * FUNCTION to calc fence length FROM meters into mm
 * @param $f_len
 * @return float|int
 */
function fence_calc_mm ($f_len) {
    $fen_len_mm = $f_len * 1000;
    return $fen_len_mm;
}


function calc_percentage($num, $total) {
    $percentage = $num / $total;
    return $percentage;
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
    $fence_length = ($pos_wid * $pos_num) + ($pan_len * $pan_num);
    $fence_length_final =  $fence_length / 1000;
    return round($fence_length_final, 2);
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
    $num_of_posts = ($f_len * $pos_total_per) / $pos_wid;
    $num_of_posts_final = $num_of_posts + 1;
    return floor($num_of_posts_final);
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
    $num_of_panels = ($f_len * $pan_total_per) / $pan_len;
    return floor($num_of_panels);
}