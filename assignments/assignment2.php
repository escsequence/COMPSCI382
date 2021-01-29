<?php
  /******************************
  / Author: James Johnston
  / Date: 1/29/2021
  / CS382
  ******************************/


function table($arr, $cat) {
  tStart();
  //tHeader($cat);
  //$new_arr = array();
  foreach($arr as $item) {
    //$new_item = array();
    //foreach($item as $key => $value) {
      //array_push($new_item, arr_ele[category]);
      //echo $value;
    //}
    foreach($cat as $selected_category) {

    }
    //array_push($new_arr, $new_item)
  }
  //tBody($new_arr);
  tEnd();
}

function tStart() {
  echo "<table>";
}

function tHeader($th) {
  echo "<thead><tr>";
  foreach($th as $header) {
    echo "<th>$header</th>";
  }
  echo "</tr></thead>";
}

function tBody($tb) {
  echo "<tbody>";
  foreach($tb as $item) {
    echo "<tr>";
    foreach($item as $attr) {
      echo "<td>$attr</td>";
    }
    echo "</tr>";
  }
  echo "</tbody>";
}

function tEnd() {
  echo "</table>";
}


  $products =
  [
    ['type' => 'electronics','name' => 'Audio Technica ATH-M50x','price' => 119.99, 'quantity' => 2 ],
    ['type' => 'electronics','name' => 'Sennheiser HD 202 II','price' => 24.50,'quantity' => 5 ],
    ['type' => 'electronics', 'name' => 'GPX HM3817DTBK Micro System', 'price' => 135.99, 'quantity' => 1 ],
    ['type' => 'electronics', 'name' => 'Samsung MX-J630 2.0 Channel 230 Watt System', 'price' => 117.99, 'quantity' => 4 ],
    ['type' => 'electronics', 'name' => 'M-Audio Bass Traveler', 'price' => 29.00, 'quantity' => 9 ],
    ['type' => 'electronics', 'name' => 'HLED Strip light kit', 'price' => 17.95, 'quantity' => 5 ],
    ['type' => 'movies', 'name' => 'Spectre', 'price' => '19.99', 'quantity' => 0 ],
    ['type' => 'movies', 'name' => 'Finding Dory', 'price' => 19.99, 'quantity' => 4 ],
    ['type' => 'movies', 'name' => 'Terminator: Genisys', 'price' => 14.95, 'quantity' => 3 ],
    ['type' => 'movies','name' => 'Interstellar','price' => 12.00,'quantity' => 4 ],
    ['type' => 'movies', 'name' => 'Transformers: Age of Extinction', 'price' => 9.95, 'quantity' => 7 ],
    ['type' => 'movies', 'name' => 'Eye in the Sky', 'price' => 14.95, 'quantity' => 6 ],
    ['type' => 'movies', 'name' => 'Venom', 'price' => '22.99', 'quantity' => 0 ],
    ['type' => 'movies', 'name' => 'The spy who dumped me', 'price' => 29.00, 'quantity' => 8 ],
    ['type' => 'movies', 'name' => 'Mamma Mia, Here We Go Again', 'price' => 22.99, 'quantity' => 4 ],
    ['type' => 'electronics', 'name' => 'M-Audio Bass Traveler', 'price' => 29.00, 'quantity' => 5 ],
    ['type' => 'video-games', 'name' => 'Battlefield 1', 'price' => 59.99, 'quantity' => 3 ],
    ['type' => 'video-games', 'name' => 'Overwatch', 'price' => 40.00, 'quantity' => 1 ],
    ['type' => 'video-games', 'name' => 'Gears of War 4', 'price' => 59.99, 'quantity' => 8 ],
    ['type' => 'video-games', 'name' => 'Titanfall 2', 'price' => 59.99, 'quantity' => 7 ],
    ['type' => 'video-games', 'name' => 'Sid Meier\'s Civilization VI ', 'price' => 59.99, 'quantity' => 4 ],
    ['type' => 'video-games', 'name' => 'The Sims 4', 'price' => 39.99, 'quantity' => 2 ],
    ['type' => 'video-games', 'name' => 'Grand Theft Auto V', 'price' => 59.99, 'quantity' => 7
  ]
];


  echo '<html>';
  echo '<a href=\'../assignments.html\'>Go back to assignment page</a>';
  echo '<h1>Assignment 2</h1>';
  echo '<hr />';

  tStart();
  tHeader(["name", "type", "price"]);

  // Generate part 1 content
  $p1content = Array();

  foreach($products as $item) {
    //$new_item = array();
    //foreach($item as $key => $value) {
      //array_push($new_item, arr_ele[category]);
      //echo $value;
    //}
    $new_item = Array();
    foreach(["name", "type", "price"] as $cat) {
      array_push($new_item, $item[$cat]);
      //echo $item[$cat];
    }
    array_push($p1content, $new_item);
  }
  tBody($p1content);


  //tBody()
  tEnd();


  // Part 1
  echo '<h2>Part 1. Display name, type, and price of each product.</h2>';


  echo '<hr />';

  // Part 2
  echo '<h2>Part 2. Display name, type, and price of each product with a price greater than 30.</h2>';


  echo '<hr />';

  // Part 3
  echo '<h2>Part 3. Display name, type, and price of each electronics item with a price greater than 30.</h2>';

  echo '<hr />';

  // Part 4
  echo '<h2>Part 4. Revenue generated by each product is calculated by multiplying price and quantity.</h2>';

  echo '<hr />';

  // Part 5
  echo '<h2>Part 5. Find the revenue generated by electronics items.</h2>';

  // echo '$var1 = ' . $var1;
  // echo '<br />';
  // echo '$var2 = ' . $var2;
  // echo '<br /><br />';
  // echo "<table>";
  // echo "<thead>";
  //   echo "<tr>";
  //     echo '<th>$var1</th>';
  //     echo '<th>operation</th>';
  //     echo '<th>operation name</th>';
  //     echo '<th>$var2</th>';
  //     echo '<th>value</th>';
  //   echo "</tr>";
  // echo "</thead>";
  // echo "<tbody>";
  //     echo "<tr>";
  //       echo "<td>$var1</td>";
  //       echo "<td>+</td>";
  //       echo "<td>sum</td>";
  //       echo "<td>$var2</td>";
  //       $sum=$var1+$var2;
  //       echo "<td>$sum</td>";
  //     echo "</tr>";
  //     echo "<tr>";
  //       echo "<td>$var1</td>";
  //       echo "<td>-</td>";
  //       echo "<td>difference</td>";
  //       echo "<td>$var2</td>";
  //       $diff=$var1-$var2;
  //       echo "<td>$diff</td>";
  //     echo "</tr>";
  //     echo "<tr>";
  //       echo "<td>$var1</td>";
  //       echo "<td>*</td>";
  //       echo "<td>product</td>";
  //       echo "<td>$var2</td>";
  //       $prod=$var1*$var2;
  //       echo "<td>$prod</td>";
  //     echo "</tr>";
  // echo "</tbody>";
  // echo "</table>";
  // echo '<hr />';
  //
  // echo '<h2>Part 2</h2>';
  // $prime_numbers = array(2, 3, 5, 7, 11, 13, 17, 19, 23, 29);
  //
  // echo "<h3>First 10 prime numbers squared:</h3>";
  // echo "<ul>";
  // foreach ($prime_numbers as $number) {
  //   $squared = pow($number, 2);
  //   echo "<li>Number: $number, Square: $squared</li>";
  // }
  // echo "</ul>";
  // echo '<hr />';
  //
  // echo '<h2>Part 3</h2>';
  // echo "<strong>Default</strong>: <code>";
  // $random_numbers = array(-1, 2, 15, 32, 2, -44, 9, -1, -31, 30);
  // print_r($random_numbers);
  // echo "</code><br />";
  // echo "<strong>After sort function</strong>: <code>";
  // sort($random_numbers);
  // print_r($random_numbers);
  // echo "</code><br />";
  // echo "<strong>After rsort (reverse) function</strong>: <code>";
  // rsort($random_numbers);
  // print_r($random_numbers);
  // echo '</code><br />';
  // echo "<strong>Unique values</strong>: <code>";
  // print_r(array_unique($random_numbers));
  // echo "</code>";
  // echo '<hr />';
  //
  // echo '<h2>Part 4</h2>';
  // $sum_of_pos = 0;
  // foreach($random_numbers as $random_number) {
  //   // Definition of positive is greater than 0.
  //   if ($random_number > 0) {
  //     $sum_of_pos += $random_number;
  //   }
  // }
  // echo "Sum of the positive values: $sum_of_pos";

  echo "</html>";

?>
