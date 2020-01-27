<?php

//INDIVIDUAL length of post and panel in mm
$post_width = 100;
$panel_length = 1500;

//INPUTS:
//total fence length input in meters
$fence_length_input = 100;
//total number of post & panel input
$post_number_input = 63;
$panel_number_input = 62;
//IF accepting post width and panel length inputs, ENSURE unit is mm ONLY

/**
 * FUNCTION to calc fence length FROM meters into mm
 * @param $f_len
 * @return float|int
 */
function fence_calc_mm ($f_len) {
    $fen_len_mm = $f_len * 1000;
    return $fen_len_mm;
}

$fence_length_mm = fence_calc_mm($fence_length_input);

//calc number of post and panel length in percentages
$post_panel_total = $post_width + $panel_length;
$post_total_percentage = ($post_width / $post_panel_total);
$panel_total_percentage = ($panel_length / $post_panel_total);

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

// CHECK TOTAL LENGTH BETWEEN POST/PANEL AND FENCE
$post_calc_total = post_calc($fence_length_mm, $post_total_percentage, $post_width);
$panel_calc_total = panel_calc($fence_length_mm, $panel_total_percentage, $panel_length);

$post_panel_total_check = ($post_calc_total * $post_width) + ($panel_calc_total * $panel_length);

if($post_panel_total_check < $fence_length_mm) {
    $number_of_posts_check = $post_calc_total + 1;
    $number_of_panels_check = $panel_calc_total + 1;
}


//////////////////
// CALL FUNCTIONS:
$number_of_posts = $number_of_posts_check;
$number_of_panels = $number_of_panels_check;
//$number_of_posts = post_calc($fence_length_mm, $post_total_percentage, $post_width);
//$number_of_panels = panel_calc($fence_length_mm, $panel_total_percentage, $panel_length);
$fence_length_result = fence_length_calc($post_width, $post_number_input, $panel_length, $panel_number_input);


///////////
// DISPLAY:

echo 'line 1';
echo '<br>';
echo 'line 2';
echo '<br>';



echo $number_of_posts . ' posts and ' . ' ' . $number_of_panels . ' panels needed based on a fence length requirement of ' . $fence_length_input . ' meters.';
echo '<br>';
echo 'Based on ' . $post_number_input . ' number of posts and ' . $panel_number_input . ' number of panels, the fence length will be ' . $fence_length_result . ' meters.';
echo '<br>';


