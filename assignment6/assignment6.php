<?php
  /******************************
  / Assignment 6
  / Author: James Johnston
  / Date: 3/5/2021
  / CS382
  **/

  // Connect to the db
  include('pdo_connect.php');

  // Get the mode/genre
  $mode = isset($_GET['mode']) ? $_GET['mode'] : "";
  $genre = isset($_GET['genre']) ?  $_GET['genre'] : "";
  $member_id = isset($_GET['memberId']) ? $_GET['memberId'] : "";

  function displayMovieData($title, $list, $headers) {
    // Title of the table being shown
  	echo "<h3>{$title}</h3>";

    // If there are items to show
  	if (count($list) > 0) {

      // Create a table
    	echo "<table class='table'>";

      // We establish a header for the table
      echo "<thead><tr>";

      // We loop through each of the headers and print them output
      foreach($headers as $header) {

        // Increase the first letter
        $upper_header = ucwords(strtolower($header));

        // Print the header
        echo "<th>$upper_header</th>";
      }

      // Close the header portion of the table
      echo "</tr></thead><tbody>";

      // Go through the list of movies
      foreach ($list as $movie) {

        // New row
        $trow = "<tr>";

        // We know that each of the header is a
        foreach($headers as $header) {
          // We lower it just incase since how it's stored in the db
          $lower_header = strtolower($header);

          // We get the content of the array based on the "lowered header"
          $trow_content = $movie[$lower_header];

          // We append the content to the row now.
          $trow .= "<td>{$trow_content}</td>";
        }

        // Last part of the table row
        $trow .= "</tr>";

        // Echo it to the web page
        echo $trow;
      }

      // We are completed with printing out the rows, now finish the table
      echo "</tbody></table>";

    } else {

        // There are no items in the list
        echo "<p>There are no movies in the database";

    }
  }

  function getAll($sql, $db, $parameterValues = null) {

    // Prepare the SQL with the statement provided
    $statement = $db->prepare($sql);

    // Execute the query
    $statement->execute($parameterValues);

    // Return the fetchAll statement passed in.
    return $statement->fetchAll(PDO::FETCH_ASSOC);
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
    <title>COMPSCI382 | Assignment 6</title>
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
              Assignment 6
            </div>
            <div class="card-body">
              <?php
                //echo getAll("SELECT * FROM users", $db);
                //displayMovieData("Test", Array(Array("title"=>"Test", "year"=>1900, "type"=>"Test")), ["title", "year", "type"]);
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
