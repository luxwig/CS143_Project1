<hitml>
<head><title>Calculator</title></head>
<body>

<h1>Calculator</h1>
Type an expression in the following box (e.g., 10.5+20*3/25).
<p>
    <form method="GET">
        <input type="text" name="expr">
        <input type="submit" value="Calculate">
    </form>
</p>

<ul>
    <li>Only numbers and +,-,* and / operators are allowed in the expression.
    <li>The evaluation follows the standard operator precedence.
    <li>The calculator does not support parentheses.
    <li>The calculator handles invalid input "gracefully". It does not output PHP error messages.
</ul>

Here are some(but not limit to) reasonable test cases:
<ol>
  <li> A basic arithmetic operation:  3+4*5=23 </li>
  <li> An expression with floating point or negative sign : -3.2+2*4-1/3 = 4.46666666667, 3*-2.1*2 = -12.6 </li>
  <li> Some typos inside operation (e.g. alphabetic letter): Invalid input expression 2d4+1 </li>
</ol>

<?php
    $input = $_GET["expr"];
    // Remove whitespaces
    $equation = preg_replace('/\s+/', '', $input);
    // echo "$equation\n";
    $equation = preg_replace('/--/', '+', $input);
    // bug fixed : 1--2
    $output = "";
    $num = '((?:0|[1-9]\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?|pi|π)';  
    $operators = '[\/*\^\+-,]';
    $regexp = '/^([+-]?('.$num.'|\s*\((?1)+\)|\((?1)+\))(?:'.$operators.'(?1))?)+$/'; 

    if ($equation <> "")
    {
        echo "<h1>Result</h1>";
        if (preg_match($regexp, $equation))
        {   
            eval('$result = '.$equation.';');
            if($result == ""){
            $output = "Division by zero error!";
            echo "$output\n";
        }
        else {
            $output = "$input = $result";
            // bug fixed : output original expression
            echo "$output\n";
        }

    }
    else
    {
        $output = "Invalid Expression!";
        echo "$output\n";
    }
}
?>

</body>
</html>

