<?php
require_once "functions.php";

cheekyFunction();

// INPUTS:
// MM
$post_width = check_input($_POST['post_width_input']);
$panel_length = check_input($_POST['panel_length_input']);
// METERS
$fence_length_input = check_input($_POST['fence_length_input']);
$post_number_input = check_input($_POST['post_number_input']);
$panel_number_input = check_input($_POST['panel_number_input']);

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

//// empty variables for required field handling
//$post_err = $panel_err = $fence_err = $post_num_err = $panel_num_err = "";
//$pw_check = $pl_check = $fl_check = $pol_check = $pal_check = "";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if (empty($_POST["post_width_input"])) {
//        $post_err = "Post width is required";
//    } else {
//        $pw_check = test_input($_POST["post_width_input"]);
//    }
//
//    if (empty($_POST["panel_length_input"])) {
//        $panel_err = "Rail length is required";
//    } else {
//        $pl_check = test_input($_POST["panel_length_input"]);
//    }
//
//    if (empty($_POST["fence_length_input"])) {
//        $fence_err = "Fence length is required";
//    } else {
//        $fl_check = test_input($_POST["fence_length_input"]);
//    }
//
//    if (empty($_POST["post_number_input"])) {
//        $post_num_err = "Post number is required";
//    } else {
//        $pol_check = test_input($_POST["post_number_input"]);
//    }
//
//    if (empty($_POST["panel_number_input"])) {
//        $panel_num_err = "Rail number is required";
//    } else {
//        $pal_check = test_input($_POST["panel_number_input"]);
//    }
//}
//
//function test_input($data) {
//    $data = trim($data);
//    $data = stripslashes($data);
//    return $data;
//}

?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
    <title>Post and Panels Challenge</title>
    <style>.error {color: #FF0000}</style>

</head>
<body>
    <h1>Calculate My Fence</h1>
    <form method="post" id="validate_form_top">
        <h3>Given the length of my fence, how many posts and railings needed:</h3>
        <p><span class="error">All fields required before submitting</span></p>
        <fieldset>
            <label>What is the fence line in meters?</label>
            <input type="number" name="fence_length_input" required/>
            <span class="error">* <?php echo $fence_err;?></span>
        </fieldset>
        <fieldset>
            <label>What is the rail length measurement?</label>
            <select name="panel_length_input" required>
                <option value="0">Please select</option>
                <option value="1500">1500mm </option>
                <option value="1200">1200mm</option>
            </select>
            <span class="error">* <?php echo $panel_err;?></span>
        </fieldset>
        <fieldset>
            <label>What is the post width measurement?</label>
            <select name="post_width_input">
                <option value="0">Please select</option>
                <option value="100">100mm</option>
                <option value="75">75mm</option>
            </select>
            <span class="error">* <?php echo $post_err;?></span>
        </fieldset>
        <input type="submit">
    </form>

    <p>Desired Fence Length in meters: <?php echo $fence_length_input;?></p>
    <p>Rail length selected in mm: <?php echo $panel_length;?></p>
    <p>Post width selected in mm: <?php echo $post_width;?></p>
    <p>POSTS: <?php echo $number_of_posts;?></p>
    <p>RAILINGS: <?php echo $number_of_panels;?></p>


    <h3>Given the number of post and railings, what is the length of my fence:</h3>
    <p><span class="error">All fields required before submitting</span></p>
    <form method="post" id="validate_form_bottom" >
        <fieldset>
            <label>What is the rail length measurement?</label>
            <select name="panel_length_input">
                <option value="0">Please select</option>
                <option value="1500">1500mm</option>
                <option value="1200">1200mm</option>
            </select>
            <span class="error">* <?php echo $panel_err;?></span>
        </fieldset>
        <fieldset>
            <label>What is the post width measurement?</label>
            <select name="post_width_input">
                <option value="0">Please select</option>
                <option value="100">100mm</option>
                <option value="75">75mm</option>
            </select>
            <span class="error">* <?php echo $post_err;?></span>
        </fieldset>
        <fieldset>
            <label>How many railings do you have?</label>
            <input type="number" name="panel_number_input">
            <span class="error">* <?php echo $panel_num_err;?></span>
        </fieldset>
                <fieldset>
            <label>How many posts do you have?</label>
            <input type="number" name="post_number_input">
            <span class="error">* <?php echo $post_num_err;?></span>
        </fieldset>
        <input type="submit">
    </form>

    <p>Based on the post and railing numbers provided:
        <?php echo $post_number_input . ' Posts and ' . $panel_number_input . ' Panels.';?></p>
    <p>The fence length in meters will be: <?php echo $fence_length_result;?> </p>
    <p>Rail length in mm: <?php echo $panel_length;?></p>
    <p>Post width in mm: <?php echo $post_width;?></p>

</body>
</html>

<?php

//if (!empty($_POST)) {
//    if (isset($_POST['post_width_input'])) {
//        $post_width = check_input($_POST['post_width_input']);
//    }
//    $panel_length = check_input($_POST['panel_length_input']);
//    // total fence length input in meters
//    $fence_length_input = check_input($_POST['fence_length_input']);
//    // total number of post & panel input
//    $post_number_input = check_input($_POST['post_number_input']);
//    $panel_number_input = check_input($_POST['panel_number_input']);
//}}