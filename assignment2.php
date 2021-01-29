<?php
  $var1 = 10;
  $var2 = 20;
  echo '<html>';
  echo '<a href=\'./assignments.html\'>Go back to assignment page</a>';
  echo '<h1>Assignment 2</h1>';
  echo '<hr />';
  echo '<h2>Part 1</h2>';
  echo '$var1 = ' . $var1;
  echo '<br />';
  echo '$var2 = ' . $var2;
  echo '<br /><br />';
  echo "<table>";
  echo "<thead>";
    echo "<tr>";
      echo '<th>$var1</th>';
      echo '<th>operation</th>';
      echo '<th>operation name</th>';
      echo '<th>$var2</th>';
      echo '<th>value</th>';
    echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
      echo "<tr>";
        echo "<td>$var1</td>";
        echo "<td>+</td>";
        echo "<td>sum</td>";
        echo "<td>$var2</td>";
        $sum=$var1+$var2;
        echo "<td>$sum</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td>$var1</td>";
        echo "<td>-</td>";
        echo "<td>difference</td>";
        echo "<td>$var2</td>";
        $diff=$var1-$var2;
        echo "<td>$diff</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td>$var1</td>";
        echo "<td>*</td>";
        echo "<td>product</td>";
        echo "<td>$var2</td>";
        $prod=$var1*$var2;
        echo "<td>$prod</td>";
      echo "</tr>";
  echo "</tbody>";
  echo "</table>";
  echo '<hr />';

  echo '<h2>Part 2</h2>';
  $prime_numbers = array(2, 3, 5, 7, 11, 13, 17, 19, 23, 29);

  echo "<h3>First 10 prime numbers squared:</h3>";
  echo "<ul>";
  foreach ($prime_numbers as $number) {
    $squared = pow($number, 2);
    echo "<li>Number: $number, Square: $squared</li>";
  }
  echo "</ul>";
  echo '<hr />';

  echo '<h2>Part 3</h2>';
  echo "<strong>Default</strong>: <code>";
  $random_numbers = array(-1, 2, 15, 32, 2, -44, 9, -1, -31, 30);
  print_r($random_numbers);
  echo "</code><br />";
  echo "<strong>After sort function</strong>: <code>";
  sort($random_numbers);
  print_r($random_numbers);
  echo "</code><br />";
  echo "<strong>After rsort (reverse) function</strong>: <code>";
  rsort($random_numbers);
  print_r($random_numbers);
  echo '</code><br />';
  echo "<strong>Unique values</strong>: <code>";
  print_r(array_unique($random_numbers));
  echo "</code>";
  echo '<hr />';

  echo '<h2>Part 4</h2>';
  $sum_of_pos = 0;
  foreach($random_numbers as $random_number) {
    // Definition of positive is greater than 0.
    if ($random_number > 0) {
      $sum_of_pos += $random_number;
    }
  }
  echo "Sum of the positive values: $sum_of_pos";

  echo "</html>";

?>
