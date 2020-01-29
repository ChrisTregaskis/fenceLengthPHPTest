<?php

require "functions.php";
session_start();
// INPUTS:
// INDIVIDUAL length of post and panel in mm
$post_width = check_pos_wid_input();
$panel_length = check_pan_len_input();
// total fence length input in meters
$fence_length_input = check_fen_len_input();
// total number of post & panel input
$post_number_input = check_pos_num_input();
$panel_number_input = check_pan_num_input();


// calc fence length input into mm
$fence_length_mm = fence_calc_mm($fence_length_input);

// calc total post and panel length in percentages
$post_panel_total = $post_width + $panel_length;
$post_percentage = calc_percentage($post_width, $post_panel_total);
$panel_percentage = calc_percentage($panel_length, $post_panel_total);

// calc number of post and panels
$post_calc_total = post_calc($fence_length_mm, $post_percentage, $post_width);
$panel_calc_total = panel_calc($fence_length_mm, $panel_percentage, $panel_length);

// check total length between post/panel and fence
$length_check = length_check($post_calc_total, $post_width, $panel_calc_total, $panel_length);

if($length_check < $fence_length_mm) {
    $number_of_posts_check = $post_calc_total + 1;
    $number_of_panels_check = $panel_calc_total + 1;
}

// GET RESULTS
$number_of_posts = $number_of_posts_check;
$number_of_panels = $number_of_panels_check;
$fence_length_result = fence_length_calc($post_width, $post_number_input, $panel_length, $panel_number_input);



?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
    <title>Post and Panels Challenge</title>

</head>
<body>
    <h1>Calculate My Fence</h1>
    <form method="get">
        <h3>Given the length of my fence, how many posts and railings needed:</h3>
        <fieldset>
            <label>What is the fence line in meters?</label>
            <input type="number" name="fence_length_input"/>
        </fieldset>
        <fieldset>
            <label>What is the rail length measurement?</label>
            <select name="panel_length_input">
                <option value="0">Please Select</option>
                <option value="1500">1500mm</option>
                <option value="1200">1200mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>What is the post width measurement?</label>
            <select name="post_width_input">
                <option value="0">Please Select</option>
                <option value="100">100mm</option>
                <option value="75">75mm</option>
            </select>
        </fieldset>
        <input type="submit">
    </form>

    <p>Given a fence length of <?php echo $fence_length_input;?>
        meters, you need the following number of posts and railings</p>
    <p><?php echo $number_of_posts;?> POSTS</p>
    <p><?php echo $number_of_panels;?> RAILINGS</p>

        <h3>Given the number of post and railings, what is the length of my fence:</h3>
    <form>
        <fieldset>
            <label>What is the rail length measurement?</label>
            <select name="panel_length_input">
                <option value="0">Please Select</option>
                <option value="1500">1500mm</option>
                <option value="1200">1200mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>What is the post width measurement?</label>
            <select name="post_width_input">
                <option value="0">Please Select</option>
                <option value="100">100mm</option>
                <option value="75">75mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>How many railings do you have?</label>
            <input type="number" name="panel_number_input">
        </fieldset>
                <fieldset>
            <label>How many posts do you have?</label>
            <input type="number" name="post_number_input">
        </fieldset>
        <input type="submit">
    </form>

    <p>Based on the post and railing numbers provided:
        <?php echo $post_number_input . ' Posts and ' . $panel_number_input . ' Panels.';?></p>
    <p><?php echo 'The fence length will be: ' . $fence_length_result;?> meters</p>

<!--    <form action="index.php" method="get">-->
<!--        <input type="text" name="firstName">-->
<!--        <input type="submit">-->
<!--    </form>-->

</body>
</html>

