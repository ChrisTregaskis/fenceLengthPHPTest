<?php
require_once "functions.php";


// INPUTS:
// INDIVIDUAL length of post and panel in mm
$post_width = check_input($_GET['post_width_input']);
$panel_length = check_input($_GET['panel_length_input']);
// total fence length input in meters
$fence_length_input = check_input($_GET['fence_length_input']);
// total number of post & panel input
$post_number_input = check_input($_GET['post_number_input']);
$panel_number_input = check_input($_GET['panel_number_input']);


// calc fence length input into mm
$fence_length_mm = fence_calc_mm($fence_length_input);

// calc total post and panel length in percentages
$post_panel_total = $post_width + $panel_length;
$post_percentage = calc_percentage($post_width, $post_panel_total);
$panel_percentage = calc_percentage($panel_length, $post_panel_total);

// transform post and panel percentages into numbers
$post_calc_total = post_calc($fence_length_mm, $post_percentage, $post_width);
$panel_calc_total = panel_calc($fence_length_mm, $panel_percentage, $panel_length);

// ensure post/panel >= desired fence length
$length_check = length_check($post_calc_total, $post_width, $panel_calc_total, $panel_length);


$final_count_posts = final_count($length_check, $fence_length_mm, $post_calc_total);
$final_count_panels = final_count($length_check, $fence_length_mm, $panel_calc_total);


// Get results
$number_of_posts = $final_count_posts;
$number_of_panels = $final_count_panels;
$fence_length_result = fence_length_calc($post_width, $post_number_input, $panel_length, $panel_number_input);


// Want to disable the submit button until all fields are complete to avoid displaying math errors


?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
    <title>Post and Panels Challenge</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="formValidation.js"></script>


</head>
<body>
    <h1>Calculate My Fence</h1>
    <form method="get" id="validate_form_top">
        <h3>Given the length of my fence, how many posts and railings needed:</h3>
        <fieldset>
            <label>What is the fence line in meters?</label>
            <input type="int" name="fence_length_input"/>
        </fieldset>
        <fieldset>
            <label>What is the rail length measurement?</label>
            <select name="panel_length_input">
                <option value="0">Please select</option>
                <option value="1500">1500mm</option>
                <option value="1200">1200mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>What is the post width measurement?</label>
            <select name="post_width_input">
                <option value="0">Please select</option>
                <option value="100">100mm</option>
                <option value="75">75mm</option>
            </select>
        </fieldset>
        <input type="submit">
    </form>

    <p>Desired Fence Length in meters: <?php echo $fence_length_input;?></p>
    <p>Rail length selected: <?php echo $panel_length; echo 'mm'?></p>
    <p>Post width selected: <?php echo $post_width; echo 'mm'?></p>
    <p>POSTS: <?php echo $number_of_posts;?></p>
    <p>RAILINGS: <?php echo $number_of_panels;?></p>


        <h3>Given the number of post and railings, what is the length of my fence:</h3>
    <form>
        <fieldset>
            <label>What is the rail length measurement?</label>
            <select name="panel_length_input">
                <option value="0">Please select</option>
                <option value="1500">1500mm</option>
                <option value="1200">1200mm</option>
            </select>
        </fieldset>
        <fieldset>
            <label>What is the post width measurement?</label>
            <select name="post_width_input">
                <option value="0">Please select</option>
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
    <p><?php echo 'The fence length in meters will be: ' . $fence_length_result;?> </p>
    <p>Rail length: <?php echo $panel_length; echo 'mm'?></p>
    <p>Post width <?php echo $post_width; echo 'mm'?></p>


</body>
</html>

