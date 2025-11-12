<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Arithmetic Example</title>
</head>
<body>
    <h1>Welcome to PHP Arithmetic Operations</h1>
    <p>This page demonstrates basic arithmetic operations using PHP.</p>
    
    <?php
    // Define two numbers
    $num1 = 10;
    $num2 = 5;
    
    // Perform arithmetic operations
    $sum = $num1 + $num2;
    $difference = $num1 - $num2;
    $product = $num1 * $num2;
    $quotient = $num1 / $num2;
    $remainder = $num1 % $num2;

    // Display the results
    echo "<p>Sum of $num1 and $num2 is: $sum</p>";
    echo "<p>Difference of $num1 and $num2 is: $difference</p>";
    echo "<p>Product of $num1 and $num2 is: $product</p>";
    echo "<p>Quotient of $num1 and $num2 is: $quotient</p>";
    echo "<p>Remainder of $num1 divided by $num2 is: $remainder</p>";
    ?>
    
    <footer>
        <p>Footer Content</p>
    </footer>
</body>
</html>