<?php
  /******************************
  / Assignment 2 (Part 1 - 5)
  / Author: James Johnston
  / Date: 1/29/2021
  / CS382
  ******************************/

  /**
   * Prints the begining of a table to the webpage.
   *
   * @author James Johnston
   */
  function tStart() {
    echo "<table class='table'>";
  }

  // Table header function
  function tHeader($th) {
    echo "<thead><tr>";
    foreach($th as $header) {
      echo "<th>$header</th>";
    }
    echo "</tr></thead>";
  }

  // Table body function
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

  /**
   * Prints the ending of a table to the webpage.
   *
   * @author James Johnston
   */
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
    ['type' => 'video-games', 'name' => 'Grand Theft Auto V', 'price' => 59.99, 'quantity' => 7]
  ];
?>

<!DOCTYPE html>
<html>
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Page title -->
    <title>James Johnston's Homepage</title>
  </head>
  <body>
    <!-- General navigation for the HTML page. -->
    <nav>
      <div class="nav-inne">
        <div class="nav navbar navbar-expand-lg navbar-dark bg-dark p-2">
          <a class="navbar-brand" href="../">James Johnston</a>
          <button type="button" class=navbar-toggler data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="../">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../about.html">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../assignments.html">Assignments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../activities.html">Activites</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- Main body of the HTML page. -->
    <div class="content container-fluid mt-2">

      <!-- Part 1 -->
      <div class="assignment" id="assignment2-part-1">
          <div class="card">
            <div class="card-header bg-secondary text-white">
              Assignment 2 - Part 1. Display name, type, and price of each product.
            </div>
            <div class="card-body">
              <?php
                tStart();
                tHeader(["Name", "Type", "Price"]);
                // Generate part 1 content
                $p1content = Array();
                foreach($products as $item) {
                  $new_item = Array();
                  foreach(["name", "type", "price"] as $cat) {
                    array_push($new_item, $item[$cat]);
                  }
                  array_push($p1content, $new_item);
                }
                tBody($p1content);
                tEnd();
              ?>
            </div>
          </div>
      </div>

      <!-- Part 2 -->
      <div class="assignment mt-2" id="assignment2-part-2">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            Assignment 2 - Part 2. Display name, type, and price of each product with a price greater than 30.
          </div>
          <div class="card-body">
            <?php
              tStart();
              tHeader(["Name", "Type", "Price"]);
              // Generate part 2 content
              $p2content = Array();
              foreach($products as $item) {
                $new_item = Array();
                if ($item["price"] > 30) {
                  foreach(["name", "type", "price"] as $cat) {
                    array_push($new_item, $item[$cat]);
                  }
                }
                array_push($p2content, $new_item);
              }
              tBody($p2content);
              tEnd();
            ?>
          </div>
        </div>
      </div>

      <div class="assignment mt-2" id="assignment2-part-3">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            Assignment 2 - Part 3. Display name, type, and price of each electronic with a price greater than 30.
          </div>
          <div class="card-body">
            <?php
              tStart();
              tHeader(["Name", "Type", "Price"]);
              // Generate part 3 content
              $p3content = Array();
              foreach($products as $item) {
                $new_item = Array();
                if ($item["price"] > 30 && $item["type"] == 'electronics') {
                  foreach(["name", "type", "price"] as $cat) {
                    array_push($new_item, $item[$cat]);
                  }
                  array_push($p3content, $new_item);
                }
              }
              tBody($p3content);
              tEnd();
            ?>
          </div>
        </div>
      </div>

      <div class="assignment mt-2" id="assignment2-part-4">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            Assignment 2 - Part 4. Revenue generated by each product. Displaying name, type, price, quantity, revenue.
          </div>
          <div class="card-body">
            <?php
              $total_revenue = 0;
              tStart();
              tHeader(["Name", "Price", "Quantity", "Revenue"]);
              // Generate part 4 content
              $p4content = Array();
              foreach($products as $item) {
                $new_item = Array();
                foreach(["name", "price", "quantity"] as $cat) {
                  array_push($new_item, $item[$cat]);
                }
                $revenue = $item["quantity"] * $item["price"];
                $total_revenue += $revenue;
                array_push($new_item, $revenue);

                array_push($p4content, $new_item);
              }
              tBody($p4content);
              tEnd();
              echo "<div class='h3'>Total revenue: $$total_revenue</div>"
            ?>
          </div>
        </div>
      </div>

      <div class="assignment mt-2" id="assignment2-part-5">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            Assignment 2 - Part 5. Revenue generated for only electronic products. Displaying name, type, price, quantity, revenue.
          </div>
          <div class="card-body">
            <?php
              $total_revenue = 0;
              tStart();
              tHeader(["Name", "Type", "Price", "Quantity", "Revenue"]);
              // Generate part 5 content
              $p5content = Array();
              foreach($products as $item) {
                if ($item["type"] == 'electronics') {
                  $new_item = Array();
                  foreach(["name", "type", "price", "quantity"] as $cat) {
                    array_push($new_item, $item[$cat]);
                  }

                  $revenue = $item["quantity"] * $item["price"];
                  $total_revenue += $revenue;
                  array_push($new_item, $revenue);

                  array_push($p5content, $new_item);
                }
              }
              tBody($p5content);
              tEnd();
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Script includes after the content -->
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Bootstrap CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>

  <!-- Footer W.I.P -->
  <footer>
    <div class="footer">

    </div>
  </footer>
</html>
