<?php
require "functions.php";

// INPUTS:
// INDIVIDUAL length of post and panel in mm
$post_width = check_input($_GET['post_width_input']);
$panel_length = check_input($_GET['panel_length_input']);
// total fence length input in meters
$fence_length_input = check_input($_GET['fence_length_input']);
// total number of post & panel input
$post_number_input = check_number_input($_GET['post_number_input']);
$panel_number_input = check_number_input($_GET['panel_number_input']);


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

//if($length_check < $fence_length_mm) {
//    $number_of_posts_check = $post_calc_total + 1;
//    $number_of_panels_check = $panel_calc_total + 1;
//}

// GET RESULTS
$number_of_posts = $final_count_posts;
$number_of_panels = $final_count_panels;
$fence_length_result = fence_length_calc($post_width, $post_number_input, $panel_length, $panel_number_input);



echo '1. ' . $fence_length_input;
echo '<br>';
var_dump($fence_length_input);
echo '<br>';
echo '2. ' . $fence_length_mm;
echo '<br>';
var_dump($fence_length_mm);
echo '<br>';
echo '3. ' . $post_width;
echo '<br>';
var_dump($post_width);
echo '<br>';
echo '4. ' . $post_panel_total;
echo '<br>';
var_dump($post_panel_total);
echo '<br>';
echo '5. ' . $post_percentage;
echo '<br>';
var_dump($post_percentage);
echo '<br>';
echo '6. ' . $panel_percentage;
echo '<br>';
var_dump($panel_percentage);
echo '<br>';
echo '7. ' . $post_calc_total;
echo '<br>';
var_dump($post_calc_total);
echo '<br>';
echo '8. ' . $panel_calc_total;
echo '<br>';
var_dump($panel_calc_total);
echo '<br>';
echo '9. ' . $length_check;
echo '<br>';
var_dump($length_check);
echo '<br>';
echo '10. ' . $final_count_posts;
echo '<br>';
var_dump($final_count_posts);
echo '<br>';
echo '11. ' . $final_count_panels;
echo '<br>';
var_dump($final_count_panels);
echo '<br>';
echo '12. ' . $number_of_posts;
echo '<br>';
var_dump($number_of_posts);
echo '<br>';
echo '13. ' . $number_of_panels;
echo '<br>';
var_dump($number_of_panels);
echo '<br>';
echo '14. ' . $post_number_input;
echo '<br>';
var_dump($post_number_input);
echo '<br>';
echo '15. ' . $panel_number_input;
echo '<br>';
var_dump($panel_number_input);

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

    <p>Desired Fence Length: <?php echo $fence_length_input; echo ' meters'?></p>
    <p>POSTS: <?php echo $number_of_posts;?></p>
    <p>RAILINGS: <?php echo $number_of_panels;?></p>
    <p>Rail length: <?php echo $panel_length; echo 'mm'?></p>
    <p>Post width <?php echo $post_width; echo 'mm'?></p>

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
    <p><?php echo 'The fence length will be: ' . $fence_length_result;?> meters</p>
    <p>Rail length: <?php echo $panel_length; echo 'mm'?></p>
    <p>Post width <?php echo $post_width; echo 'mm'?></p>
</body>
</html>

