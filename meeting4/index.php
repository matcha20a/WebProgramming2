<?php
include('../header.php');
include('../menu.php');
?>
<div id="container">
<h1 style="text-align:center">Using PHP Function Math</h1>
<?php
$square_root = sqrt(49);
$rank = pow(12,2);
$maximum = max(2,4,6,8,10);
$random = rand (100, 100000);
echo "The square root of 49 is " . $square_root. "<br>";
echo "The square root of 12 is " . $rank . "<br>";
echo "The maximum value of the set 2,4,6,8,10 is ". $maximum . "<br>";
echo "Generate random values with the rand() function, namely ". $random. "<br>";
echo "UFor a more complete implementation of Math Functions, please click this link <a href='https://www.w3schools.com/php/php_ref_math.asp' target='_blank'>Learn Math Functions from the w3schools Website</a><br>";
echo "Or at this link <a href='https://www.php.net/manual/en/ref.math.php' target='_blank' >Learn Math Functions from the PHP Website</a><br>";
echo "Click this link to study further material <a href='private functions.php' target=' _blank'>Study More</a><br>";
?>
</div> <?php
include('../footer.php')
?>