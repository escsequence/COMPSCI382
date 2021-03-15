<?php
  /******************************
  / Assignment 7
  / Author: James Johnston
  / Date: 3/15/2021
  / CS382
  **/

  // Connect to the db
  include('pdo_connect.php');

  // Get cos (course or type) and the section we are querying
  $cos = isset($_GET['cos']) ? strip_tags($_GET['cos']) : null;
  $section = isset($_GET['section']) ?  strip_tags($_GET['section']) : null;

  $queryRun = ($cos != null && $section != null);

  if ($queryRun) {
    switch($section) {
      case "cs":
        $course_type = "COMPSCI";
        break;
      case "math":
        $course_type = "MATH";
        break;
      case "magd":
        $course_type = "MAGD";
        break;
      default:
        $course_type = "UNKNOWN";
        break;
    }
  }

  // Validation
  // Allows us to assemble a key, value array and get the key based on a value
  function get_key_from_value($value, $array) {
    return array_search($value, $array);
  }

  function displayArrayData($title, $subtitle, $list, $headers, $error = null) {
    // Title of the table being shown
    echo "<h2>{$title}</h2>";
    echo "<h6>{$subtitle}</h6>";

    // If there are items to show
    if (count($list) > 0) {

      // Create a table
      echo "<table class='table'>";

      // We establish a header for the table
      echo "<thead><tr>";

      // We loop through each of the headers and print them output
      foreach($headers as $header) {

        // Print the header
        echo "<th>$header</th>";
      }

      // Close the header portion of the table
      echo "</tr></thead><tbody>";

      // Go through the list of movies
      foreach ($list as $tbl_itm) {

        // New row
        $trow = "<tr>";

        // We know that each of the header is a
        foreach($headers as $header) {
          // We lower it just incase since how it's stored in the db

          // Get the key from our headers
          $header_key = get_key_from_value($header, $headers);

          // Append the content from the array
          $trow_content = $tbl_itm[$header_key];

          // We append the content to the row now.
          $trow .= "<td>$trow_content</td>";
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
        if ($error == null) {
          echo "<p>There are no items in the database</p>";
        } else {
          echo "<p>$error</p>";
        }

    }
  }

  // Important SQL function to call to the data\
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Page title -->
    <title>UWW - Course Search</title>
  </head>
  <body>
    <!-- General navigation for the HTML page. -->
    <nav>
      <div class="nav-inne">
        <div class="nav navbar navbar-expand-lg navbar-dark bg-dark p-2">
          <a class="navbar-brand" href="./">UWW - Course Searcher</a>
        </div>
      </div>
    </nav>
    <!-- Main body of the HTML page. -->
    <div class="content container-fluid mt-2">
      <div class="assignment" id="assignment3-part-2">
        <div class="card">
          <div class="card-header bg-secondary text-white">
              Search
            </button>
          </div>
          <div class="card-body cotainer">
            <form method="get">
              <div class="form-group">
                <label for="course-type-select">Section</label>
                <select id="course-type-select" name="section" class="form-control">
                  <?php
                  if (($queryRun && $section == "cs") || !$queryRun) {
                    echo "<option value='cs' selected>COMPSCI</option>";
                  } else {
                    echo "<option value='cs'>COMPSCI</option>";
                  }

                  if ($queryRun && $section == "math") {
                    echo "<option value='math' selected>MATH</option>";
                  } else {
                    echo "<option value='math'>MATH</option>";
                  }

                  if ($queryRun && $section == "magd") {
                    echo "<option value='magd' selected>MAGD</option>";
                  } else {
                    echo "<option value='magd'>MAGD</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group mt-2">
                <div class="form-check form-check-inline">
                  <?php
                    if (($queryRun && $cos == "courses") || !$queryRun) {
                      echo "<input id='cos-courses' type='radio' name='cos' value='courses' class='form-check-input' checked='checked'>";
                    } else {
                      echo "<input id='cos-courses' type='radio' name='cos' value='courses' class='form-check-input'>";
                    }
                  ?>
                  <label for="cos-courses" class="form-check-label">Courses</label>
                </div>
                <div class="form-check form-check-inline">
                  <?php
                    if (($queryRun && $cos=="schedules")) {
                      echo "<input id='cos-schedules' type='radio' name='cos' value='schedules' class='form-check-input' checked='checked'>";
                    } else {
                      echo "<input id='cos-schedules' type='radio' name='cos' value='schedules' class='form-check-input'>";
                    }
                  ?>
                  <label for="cos-schedules" class="form-check-label">Schedules</label>
                </div>
              </div>
              <div class="form-group mt-2">
                <input class="btn btn-primary" type="submit" name="" value="Search">
                <a href="./">Reset</a>
              </div>
            </form>
          </div>
        </div>
        <div class='card mt-2'>
          <div class='card-header bg-secondary text-white'>
            Query
          </div>
          <div class='card-body'>
            <?php
              switch($cos) {
                case "courses":
                  // Courses to be displayed.
                  // Subject, Number, Title, Description, Credits
                  $title = "List of courses.";
                  $subtitle = "Comprehensive list for $course_type section courses avaliable.";

                  $query_params = Array(":subject" => $course_type);
                  $query = "SELECT subject, number, title, description, mincredits FROM courses WHERE subject = :subject ORDER BY number ASC;";

                  $content = getAll($query, $db, $query_params);
                  $headers = ["subject" => "Subject", "number" => "Number", "title" => "Title", "description" => "Description", "mincredits" => "Credits"];
                  $error = "There appears to be no courses with the current selection.";

                  displayArrayData($title, $subtitle, $content, $headers, $error);
                  break;
                case "schedules":
                  // Schedules to be displayed.
                  // Subject, Number, Section, Instructor, Time, Location
                  $title = "List of schedules.";
                  $subtitle = "Comprehensive list for $course_type section schedules.";

                  $query_params = Array(":subject" => $course_type);
                  $query = "SELECT subject, number, sectionId, displayTime, location FROM schedule WHERE subject = :subject ORDER BY number ASC;";

                  $content = getAll($query, $db, $query_params);
                  $headers = ["subject" => "Subject", "number" => "Number", "sectionId" => "Section", "displayTime" => "Time", "location" => "Location"];
                  $error = "There appears to be no schedules with the current selection.";

                  displayArrayData($title, $subtitle, $content, $headers, $error);
                  break;
                default:
                  echo "Please select an option from above and click the search button to execute a query.";
                  break;
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
