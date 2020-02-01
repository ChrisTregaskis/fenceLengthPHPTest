<?php

require '../functions.php';

use PHPUnit\Framework\TestCase;

class Stacktests extends TestCase
{
    //// ---- check_input ---- ////


    //SUCCESS check_input: return 150 if input = 150
    public function test_s_input_r_int()
    {
        $expected = 150;
        $input = 150;
        $case = check_input($input);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS check_input: return 150 if input = str '150'
    public function test_s_input_r_int2()
    {
        $expected = 150;
        $input = '150';
        $case = check_input($input);
        $this->assertEquals($expected, $case);
    }

    //FAILURE check_input: return error if input string
    public function test_f_input_r_error()
    {
        $expected = 'error! please input integer';
        $input = '5 St. James Square';
        $case = check_input($input);
        $this->assertEquals($expected, $case);
    }

    //MALFORMED check_input: return error if array passed ??
    public  function test_m_input_r_err()
    {
        $expected = 'error! please input integer';
        $input = ['0'];
        $case = check_input($input);
        $this->assertEquals($expected, $case);
    }


    //// ---- fence_calc_mm ---- ////


    //SUCCESS fence_calc_mm: with input of 25, check returns int of 25000
    public function test_s_fence_calc_mm_r_int()
    {
        $expected = 25000;
        $input = 25;
        $case = fence_calc_mm($input);
        $this->assertEquals($expected, $case);
    }

    //FAILURE fence_calc_mm: with input of str '25', returns error, ensures integrity of input
    public function test_f_fence_calc_mm_r_int()
    {
        $expected = 'error! Expecting an integer on fence_calc_mm';
        $input = '5 St. James Square';
        $case = fence_calc_mm($input);
        $this->assertEquals($expected, $case);
    }

    //MALFORMED check_input: ?


    //// ---- calc_percentage ---- ////


    //SUCCESS calc_percentage: check input reaches correct percentage output,
    //expected taken from online percentage calculator
    public function test_s_calc_percentage_r_float()
    {
        $expected = 0.15384615384615385;
        $input1 = 2;
        $input2 = 13;
        $case = calc_percentage($input1, $input2);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS calc_percentage: check returns null if input null or 0
    public function test_s_calc_percentage_r_null()
    {
        $expected = null;
        $input1 = 0;
        $input2 = null;
        $case = calc_percentage($input1, $input2);
        $this->assertEquals($expected, $case);
    }

    //FAILURE calc_percentage: with input str, returns error
    public function test_f_calc_percentage_r_err()
    {
        $expected = 'error! Expecting two integers on calc_per';
        $input1 = '2';
        $input2 = '5 St. James Square';
        $case = calc_percentage($input1, $input2);
        $this->assertEquals($expected, $case);
    }


    //// ---- post_calc ---- ////


    //SUCCESS post_calc: Based on percentage against total length and width return value
    // then iterate by 1 to complete post either end
    public function test_s_post_calc_r_int()
    {
        $expected = 6;
        $input1 = 10000;
        $input2 = 0.05;
        $input3 = 100;
        $case = post_calc($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS post_calc: if input null, return null
    public function test_s_post_calc_r_null()
    {
        $expected = null;
        $input1 = 0;
        $input2 = null;
        $input3 = 3;
        $case = panel_calc($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }

    //FAILURE post_calc: return error message if invalid input datatype passed
    public function test_f_post_calc_r_err()
    {
        $expected = 'error! expected integers and/or floats on post_calc';
        $input1 = ['5 St. James Square'];
        $input2 = 5.89;
        $input3 = 3;
        $case = post_calc($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }


    //// ---- panel_calc ---- ////


    //SUCCESS panel_calc: return panel total int number based on given inputs
    public function test_s_panel_calc_r_int()
    {
        $expected = 5;
        $input1 = 10000;
        $input2 = 0.05;
        $input3 = 100;
        $case = panel_calc($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS panel_calc: if input null, return null
    public function test_s_panel_calc_r_null()
    {
        $expected = null;
        $input1 = 0;
        $input2 = null;
        $input3 = 3;
        $case = panel_calc($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }

    //FAILURE panel_calc: return error message if invalid input datatype passed
    public function test_f_panel_calc_r_err()
    {
        $expected = 'error! expected integers and/or floats on panel_calc';
        $input1 = ['5 st. James Square'];
        $input2 = 5.89;
        $input3 = 3;
        $case = panel_calc($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }


    //// ---- length_check ---- ////


    //SUCCESS length_check: return total length of post and panels in mm
    public function test_s_length_check_r_float()
    {
        $expected = 22500;
        $input1 = 15.00;
        $input2 = 100;
        $input3 = 14.00;
        $input4 = 1500;
        $case = length_check($input1, $input2, $input3, $input4);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS length_check: return null in any input field was null
    public function  test_s_length_check_r_null()
    {
        $expected = null;
        $input1 = 15.00;
        $input2 = 100;
        $input3 = null;
        $input4 = 1500;
        $case = length_check($input1, $input2, $input3, $input4);
        $this->assertEquals($expected, $case);
    }

    //FAILURE length_check: return error message if invalid input datatype passed
    public function test_f_length_check_r_err()
    {
        $expected = 'error! expected integers on length_check';
        $input1 = ['5 St. James Square'];
        $input2 = 100;
        $input3 = 14.00;
        $input4 = 1500;
        $case = length_check($input1, $input2, $input3, $input4);
        $this->assertEquals($expected, $case);
    }



    //// ---- final_count ---- ////


    //SUCCESS final_count: return current number iterated by 1
    public function test_s_final_count_r_float_iterated()
    {
        $expected = 101;
        $input1 = 100.00;
        $input2 = 101;
        $input3 = 100.00;
        $case = final_count($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS final_count: return same current number
    public function test_s_final_count_r_float_same()
    {
        $expected = 100;
        $input1 = 102.00;
        $input2 = 101;
        $input3 = 100.00;
        $case = final_count($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS final_count: return null when any input field null
    public function test_s_final_count_r_null()
    {
        $expected = null;
        $input1 = 100.00;
        $input2 = null;
        $input3 = 100.00;
        $case = final_count($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }

    //FAILURE final_count: return error message if invalid dataType passed
    public function test_f_final_count_r_err()
    {
        $expected = 'error! expected integers on final_count';
        $input1 = ['5 St. James Square'];
        $input2 = 101;
        $input3 = 100;
        $case = final_count($input1, $input2, $input3);
        $this->assertEquals($expected, $case);
    }


    //// ---- fence_length_calc ---- ////


    //SUCCESS fence_length_calc: multiply post width by post num, add to
    // panel length multiplied by num, then divide by 1000 to get meters
    public function test_s_fence_length_calc_r_float()
    {
        $expected = 10;
        $input1 = 50;
        $input2 = 100;
        $input3 = 50;
        $input4 = 100;
        $case = fence_length_calc($input1, $input2, $input3, $input4);
        $this->assertEquals($expected, $case);
    }

    //SUCCESS fence_length_calc: return 0 if any input is null
    public function test_s_fence_length_calc_r_0()
    {
        $expected = 0;
        $input1 = 50;
        $input2 = null;
        $input3 = 50;
        $input4 = 100;
        $case = fence_length_calc($input1, $input2, $input3, $input4);
        $this->assertEquals($expected, $case);
    }

    //FAILURE fence_length_calc:
    public function test_f_fence_length_calc_r_err()
    {
        $expected = 'error! expected integers and floats on fence_length_calc';
        $input1 = ['5 St. James Square'];
        $input2 = 100;
        $input3 = 50;
        $input4 = 100;
        $case = fence_length_calc($input1, $input2, $input3, $input4);
        $this->assertEquals($expected, $case);
    }

}