<?php
  /******************************
  / Assignment 4
  / Author: James Johnston
  / Date: 2/9/2021
  / CS382
  ******************************/

  // Constants
  define("TAX_RATE", 0.05);
  define("BASE_SYSTEM_COST", 800);
  //define("ASSORTED_FINE_COST", 4.99);
  //define("ASSORTED_MILK_DARK_COST", 5.75);


  // Validate input variables here
  function post_valid($arg) {
    return isset($_POST[$arg]) ? !empty(trim($_POST[$arg])) : false;
  }

  // This function gets a key of an array based on the value
  // We do this because we store the keys as strings since there might be multiple
  // Items that cost the same value in the future.
  function get_key_from_value($value, $array) {
    return array_search($value, $array);
  }

  function validate_component($component, $array) {
    if (isset($_POST[$component])) {
      $component_cost = intval($_POST[$component]);
      return !empty(trim(get_key_from_value($component_cost, $array)));
    } else {
      return false;
    }
  }

  // Guilty until proven innocent
  $input_error = false;
  $invalid_os = false;
  $invalid_name = false;
  $invalid_email = false;

  // Selection arrays
  $os_selections = Array("w10" => "Windows 10", "u18" => "Ubuntu 18.04");
  $processor_selections = Array("Intel Core i5" => 0, "Intel Core i7" => 400, "AMD Ryzen 7" => 300);
  $memory_selections = Array("8 GB" => 0, "16 GB" => 200, "32 GB" => 400, "64 GB" => 1000, "128 GB" => 1200);
  $hd_selections = Array("500 GB" => 0, "1 TB" => 100, "2 TB" => 200, "4 TB" => 300, "240 GB SSD" => 150);

  $sub_total = BASE_SYSTEM_COST;

  // Validation
  if (post_valid("os") && $_POST["os"]!="0") {
    // Do something with OS here
    $os_selection = $os_selections[$_POST["os"]];
  } else {
    $invalid_os = true;
    $input_error = true;
  }

  if (post_valid("fullName")) {

  } else {
    $invalid_name = true;
    $input_error = true;
  }

  if (post_valid("email")) {

  } else {
    $invalid_email = true;
    $input_error = true;
  }

  if (validate_component("processor", $processor_selections)) {
    $processor_selection_cost = intval($_POST["processor"]);
    $processor_selection = get_key_from_value($processor_selection_cost, $processor_selections);
    $sub_total += $processor_selection_cost;
  } else {
    $input_error = true;
  }

  if (validate_component("memory", $memory_selections)) {
    $memory_selection_cost = intval($_POST["memory"]);
    $memory_selection = get_key_from_value($memory_selection_cost, $memory_selections);
    $sub_total += $memory_selection_cost;

  } else {
    $input_error = true;
  }

  if (validate_component("hd", $hd_selections)) {
    $hd_selection_cost = intval($_POST["hd"]);
    $hd_selection = get_key_from_value($hd_selection_cost, $hd_selections);
    $sub_total += $hd_selection_cost;
  } else {
    $input_error = true;
  }

  // Calculate the taxes
  if (!$input_error) {
    $tax_total = $sub_total * TAX_RATE;
    $total_cost = $tax_total + $sub_total;
  }


  // if (post_valid_numeric('milkchocolate', 0, 20)) {
  //   if (post_valid_numeric('assortedfine', 0, 20)) {
  //     if (post_valid_numeric('assortedmilk', 0, 20)) {
  //       $valid_input = true;
  //       $milk_chocolate_quantity = $_POST['milkchocolate'];
  //       $assored_fine_quantity = $_POST['assortedfine'];
  //       $assorted_milk_quantity = $_POST['assortedmilk'];
  //
  //       // Generate the totals for each type of chocolate
  //       $milk_chocolate_total = round($milk_chocolate_quantity * MILK_CHOCOLATE_COST, 2);
  //       $assored_fine_total = round($assored_fine_quantity * ASSORTED_FINE_COST, 2);
  //       $assorted_milk_total = round($assorted_milk_quantity * ASSORTED_MILK_DARK_COST, 2);
  //
  //       // Calculate the sub total
  //       $sub_total_cost = round($milk_chocolate_total + $assored_fine_total + $assorted_milk_total, 2);
  //
  //       // Now calculate the taxes
  //       $taxes = round($sub_total_cost * TAX_RATE, 2);
  //
  //       // Calculate the subtotal + taxes
  //       $total_cost = round($sub_total_cost + $taxes, 2);
  //
  //     }
  //   }
  // }


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
              Assignment 4 - Output (Part 2)
            </div>
            <div class="card-body">
              <?php
                // if ($valid_input) {
                //   echo "<p>Number of milk chocolates: $milk_chocolate_quantity</p>";
                //   echo "<p>Number of assorted fine chocolates: $assored_fine_quantity</p>";
                //   echo "<p>Number of assorted milk and dark chocolates: $assorted_milk_quantity</p>";
                //   echo "<hr />";
                //   // Make sure we display in a clean format with 2 numbers
                //   $format_sub_total = number_format($sub_total_cost, 2, '.', '');
                //   echo "<p><strong>Total cost:</strong> $$format_sub_total</p>";
                //
                //   $format_taxes = number_format($taxes, 2, '.', '');
                //   echo "<p><strong>5% Taxes:</strong> $$format_taxes</p>";
                //
                //   $format_total_cost = number_format($total_cost, 2, '.', '');
                //   echo "<p><strong>Total amount:</strong> $$format_total_cost</p>";
                //
                // } else {
                //   echo 'Invalid input, please go back and enter in valid values. Please make sure that the quantities are within 0-20.';
                // }
                if ($input_error) {
                  echo "Please go back and correct the following errors: ";
                  echo "<ul>";

                  if ($invalid_os) {
                    echo "<li class='text-danger'>No operating system selected.</li>";
                  }
                  if ($invalid_name) {
                    echo "<li class='text-danger'>No name entered.</li>";
                  }
                  if ($invalid_email) {
                    echo "<li class='text-danger'>No email entered.</li>";
                  }

                  if (!$invalid_os && !$invalid_name && !$invalid_email) {
                    echo "<li>An unknown error occured. Please return to the page and re-submit correct values.</li>";
                  }
                  echo "</ul>";
                  echo "<a href='../assignments/assignment4.html'>Back</a>";
                } else {
                  echo "Name: " .  $_POST['fullName'] . "<br /><br />";
                  echo "Email: " .  $_POST['email'] . "<br />";
                  echo "<hr />";
                  echo "<span class='h4'>System Configuration:</span><br/ ><br />";
                  // List of OS, processor, memory, and HDD
                  echo "<ul>";
                  echo "<li><strong>Operating system:</strong> $os_selection</li>";
                  //echo "Processor = " .  $_POST['processor'] . "<br />";
                  //echo "Memory = " .  $_POST['memory'] . "<br />";
                  //echo "HDD = " .  $_POST['hd'] . "<br />";
                  echo "<li><strong>Processor:</strong> $processor_selection</li>";
                  echo "<li><strong>Memory:</strong> $memory_selection</li>";
                  echo "<li><strong>Hard Disk:</strong> $hd_selection</li>";
                  echo "</ul>";

                  echo "<hr />";
                  // Sub total cost
                  echo "<strong>Sub total:</strong> $$sub_total<br /><br />";

                  // 5% Taxes
                  echo "<strong>5% Taxes:</strong> $$tax_total<br /><br />";

                  // Total cost
                  echo "<strong>Total Amount:</strong> $$total_cost<br />";
                  echo "<hr />";

                  echo "<strong>Comments:</strong> " .  $_POST['comments'];
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
