<?php

function getSum($n1, $n2) {
    // prepare numbers: fit them in one length - filling free space in the beginning by zeros.
    $strlen = max(strlen($n1), strlen($n2));

    $n1 = str_repeat("0", $strlen - strlen($n1)) . $n1;
    $n2 = str_repeat("0", $strlen - strlen($n2)) . $n2;


    // calculate sum "in column" maths method (school method)
    $sum = '';
    $mem = 0;
    for ($i = $strlen - 1; $i >= 0; $i--) {
        $result = ((int) $mem + (int) $n1[$i] + (int) $n2[$i]);

        $sum = (string) ($result % 10) . $sum;
        $mem = (int) ($result / 10);
    }

    if ($mem) {
        $sum = $mem . $sum;
    }

    return $sum;
}

$number1 = "562817903261556281790326155628179032698";
$number2 = "713645422108671364542210867136454221086";

$sum = (int) $number1 + (int) $number2; // 1.844674407371E+19

$sum2 = getSum($number1, $number2); // 1276463325370227646332537022764633253701

$mysqli = new mysqli("localhost", "root", "root");
$r = $mysqli->query("select @sum:=$number1 + $number2");
$sum3 = $r->fetch_row()[0]; // 1276463325370227646332537022764633253701

echo "$sum\r\n";
echo "$sum2\r\n";
echo "$sum3\r\n";
die;

