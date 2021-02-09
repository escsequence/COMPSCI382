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

  // We can validate the components we are building. The value cannot be an empty string and it also needs to exist in our array
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

  // Start the cost at the base system cost level
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
    $name = $_POST["fullName"];
  } else {
    $invalid_name = true;
    $input_error = true;
  }

  if (post_valid("email")) {
    $email = $_POST["email"];
  } else {
    $invalid_email = true;
    $input_error = true;
  }

  // No validation done on comments per the assignment
  $comments = $_POST["comments"];

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
    $tax_total = round($sub_total * TAX_RATE, 2);
    $total_cost = round($tax_total + $sub_total, 2);
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
              Assignment 4 - Output (Part 2)
            </div>
            <div class="card-body">
              <?php
                // Determine if we display an error message or the details
                if ($input_error) {

                  // Generic error message
                  echo "Please go back and correct the following errors: ";
                  // Contain a list of the errors
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

                  // If we are here and none of these errors are true then it must be an issue with the values
                  if (!$invalid_os && !$invalid_name && !$invalid_email) {
                    echo "<li>An unknown error occured. Please return to the page and re-submit correct values.</li>";
                  }
                  echo "</ul>";

                  // Show a back link
                  echo "<a href='../assignments/assignment4.html'>Back</a>";
                } else {

                  // Display the contents of the purchase
                  echo "<strong>Name:</strong> $name<br /><br />";
                  echo "<strong>Email:</strong> $email<br />";
                  echo "<hr />";
                  echo "<span class='h4'>System Configuration:</span><br/ ><br />";

                  // List of OS, processor, memory, and HDD
                  echo "<ul>";
                  echo "<li><strong>Operating system:</strong> $os_selection</li>";
                  echo "<li><strong>Processor:</strong> $processor_selection</li>";
                  echo "<li><strong>Memory:</strong> $memory_selection</li>";
                  echo "<li><strong>Hard Disk:</strong> $hd_selection</li>";
                  echo "</ul>";

                  echo "<hr />";
                  // Sub total cost
                  $format_sub_total = number_format($sub_total, 2, '.', '');
                  echo "<strong>Sub total:</strong> $$format_sub_total<br /><br />";

                  // 5% Taxes
                  $format_tax_total = number_format($tax_total, 2, '.', '');
                  echo "<strong>5% Taxes:</strong> $$format_tax_total<br /><br />";

                  // Total cost
                  $format_total_cost = number_format($total_cost, 2, '.', '');
                  echo "<strong>Total Amount:</strong> $$format_total_cost<br />";
                  echo "<hr />";

                  echo "<strong>Comments:</strong> $comments";
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
