<?php

require "functions.php";

// INDIVIDUAL length of post and panel in mm
$post_width = 100;
$panel_length = 1500;

// INPUTS:
// total fence length input in meters
$fence_length_input = 100;
// IF accepting post width and panel length inputs, ENSURE unit is mm ONLY
// total number of post & panel input
$post_number_input = 64;
$panel_number_input = 63;


// calc fence length input into mm
$fence_length_mm = fence_calc_mm($fence_length_input);

// calc number of post and panel length in percentages
$post_panel_total = $post_width + $panel_length;
$post_total_percentage = ($post_width / $post_panel_total);
$panel_total_percentage = ($panel_length / $post_panel_total);

// check total length between post/panel and fence
$post_calc_total = post_calc($fence_length_mm, $post_total_percentage, $post_width);
$panel_calc_total = panel_calc($fence_length_mm, $panel_total_percentage, $panel_length);

$post_panel_total_check = ($post_calc_total * $post_width) + ($panel_calc_total * $panel_length);

if($post_panel_total_check < $fence_length_mm) {
    $number_of_posts_check = $post_calc_total + 1;
    $number_of_panels_check = $panel_calc_total + 1;
}

// GET RESULTS
$number_of_posts = $number_of_posts_check;
$number_of_panels = $number_of_panels_check;
$fence_length_result = fence_length_calc($post_width, $post_number_input, $panel_length, $panel_number_input);

// Potentionally use for the calculate button?
function calculate_my_fence($num_of_pos, $num_of_pan) {
    return ['number of posts' => $num_of_pos, 'number of panels' => $num_of_pan];
}

//Backup Result Call
//$number_of_posts = post_calc($fence_length_mm, $post_total_percentage, $post_width);
//$number_of_panels = panel_calc($fence_length_mm, $panel_total_percentage, $panel_length);

?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
    <title>Post and Panels Challenge</title>

</head>
<body>
    <h1>Calculate My Fence</h1>
    <form>
        <h3>Given the length of my fence, how many posts and railings needed:</h3>
        <fieldset>
            <label>What is the fence line in meters?</label>
            <input type="number"/>
        </fieldset>
        <fieldset>
            <label>What is the post measurement?</label>
            <select>
                <option value="0">Please Select</option>
                <option value="1500">1500mm</option>
                <option value="1200">1200mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>What is the rail measurement?</label>
            <select >
                <option value="0">Please Select</option>
                <option value="100">100mm</option>
                <option value="75">75mm</option>
            </select>
        </fieldset>
        <button>Calculate</button>
    </form>

    <p>Given the length of fence needed: <?php echo $fence_length_input;?></p>
    <p><?php echo $number_of_posts;?> POSTS</p>
    <p><?php echo $number_of_panels;?> RAILINGS</p>

        <h3>Given the number of post and railings, what is the length of my fence:</h3>
    <form>
        <fieldset>
            <label>What is the post measurement?</label>
            <select>
                <option value="0">Please Select</option>
                <option value="1500">1500mm</option>
                <option value="1200">1200mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>What is the rail measurement?</label>
            <select>
                <option value="0">Please Select</option>
                <option value="100">100mm</option>
                <option value="75">75mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>How many posts do you have?</label>
            <input type="number">
        </fieldset>
                <fieldset>
            <label>How many railings do you have?</label>
            <input type="number">
        </fieldset>
        <button><a>Calculate</a></button>
    </form>

    <p>Based on the post and railing numbers provided:
        <?php echo $post_number_input . ' Posts and ' . $panel_number_input . ' Panels.';?></p>
    <p><?php echo 'The fence length will be: ' . $fence_length_result;?> POSTS</p>

</body>
</html>

