<?php
  // Constants
  define("TAX_RATE", 0.05);
  define("MILK_CHOCOLATE_COST", 2.50);
  define("ASSORTED_FINE_COST", 4.99);
  define("ASSORTED_MILK_DARK_COST", 5.75);


  // Validate input variables here
  function post_valid_numeric($arg, $min, $max) {
    if (isset($_POST[$arg]) && is_numeric($_POST[$arg])) {
      return ($_POST[$arg] >= $min && $_POST[$arg] <= $max);
    } else {
      return false;
    }
  }

  // Guilty until proven innocent
  $valid_input = false;

  // With our newly made function we check if the post value is valid and within
  // the 0 to 20 values - if not then it is invalid
  if (post_valid_numeric('milkchocolate', 0, 20)) {
    if (post_valid_numeric('assortedfine', 0, 20)) {
      if (post_valid_numeric('assortedmilk', 0, 20)) {
        $valid_input = true;
        $milk_chocolate_quantity = $_POST['milkchocolate'];
        $assored_fine_quantity = $_POST['assortedfine'];
        $assorted_milk_quantity = $_POST['assortedmilk'];

        // Generate the totals for each type of chocolate
        $milk_chocolate_total = round($milk_chocolate_quantity * MILK_CHOCOLATE_COST, 2);
        $assored_fine_total = round($assored_fine_quantity * ASSORTED_FINE_COST, 2);
        $assorted_milk_total = round($assorted_milk_quantity * ASSORTED_MILK_DARK_COST, 2);

        // Calculate the sub total
        $sub_total_cost = round($milk_chocolate_total + $assored_fine_total + $assorted_milk_total, 2);

        // Now calculate the taxes
        $taxes = round($sub_total_cost * TAX_RATE, 2);

        // Calculate the subtotal + taxes
        $total_cost = round($sub_total_cost + $taxes, 2);

      }
    }
  }


?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Page title -->
    <title>COMPSCI382 | Assignment 3</title>
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
              <li class="nav-item">
              </li>
                <a class="nav-link" href="../activities.html">Activites</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- Main body of the HTML page. -->
    <div class="content container-fluid mt-2">
      <div class="assignment" id="assignment3-part-2">
          <div class="card">
            <div class="card-header bg-secondary text-white">
              Assignment 3 - Output (Part 2)
            </div>
            <div class="card-body">
              <?php
                if ($valid_input) {
                  echo "<p>Number of milk chocolates: $milk_chocolate_quantity</p>";
                  echo "<p>Number of assorted fine chocolates: $assored_fine_quantity</p>";
                  echo "<p>Number of assorted milk and dark chocolates: $assorted_milk_quantity</p>";
                  echo "<hr />";
                  // Make sure we display in a clean format with 2 numbers
                  $format_sub_total = number_format($sub_total_cost, 2, '.', '');
                  echo "<p><strong>Total cost:</strong> $$format_sub_total</p>";

                  $format_taxes = number_format($taxes, 2, '.', '');
                  echo "<p><strong>5% Taxes:</strong> $$format_taxes</p>";

                  $format_total_cost = number_format($total_cost, 2, '.', '');
                  echo "<p><strong>Total amount:</strong> $$format_total_cost</p>";

                } else {
                  echo 'Invalid input, please go back and enter in valid values. Please make sure that the quantities are within 0-20.';
                }
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
