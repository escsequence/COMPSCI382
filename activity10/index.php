<?php
  /******************************
  / Activity 10
  / Author: James Johnston
  / Date: 3/25/2021
  / CS382
  **/

  // Connect to the db
  include('pdo_connect.php');

  // Mode of what to display/actions
  $mode = isset($_GET['mode']) ? strip_tags($_GET['mode']) : null;
  //$type = isset($_GET['type']) ? strip_tags($_GET['type']) : null;
  //$genre = isset($_GET['genre']) ?  strip_tags($_GET['genre']) : null;
  //$genre2 = isset($_GET['genre2']) ? strip_tags($_GET['genre2']) : null;
  //$id = isset($_GET['id']) ? strip_tags($_GET['id']) : null;
  //$date = isset($_GET['date']) ? strip_tags($_GET['date']) : null;
  //$date2 = isset($_GET['date2']) ? strip_tags($_GET['date2']) : null;

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

    <!-- Page title -->
    <title>COMPSCI382 | Week 10 Activity</title>
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
              Week 10 Activity
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <div class="list-group" role="tablist">
                    <?php
                      // Print out our links, this shows which one is currently selected atm
                      echo ($mode == null) ? "<a class='list-group-item list-group-item-action active' href='./index.php'>Home</a>" : "<a class='list-group-item list-group-item-action' href='./index.php'>Home</a>";
                      echo ($mode == "viewmembers") ? "<a class='list-group-item list-group-item-action active' href='?mode=viewmembers'>Members</a>" : "<a class='list-group-item list-group-item-action' href='?mode=viewmembers'>Members</a>";
                      echo ($mode == "displaynewmemberform") ? "<a class='list-group-item list-group-item-action active' href='?mode=displaynewmemberform'>Animation</a>" : "<a class='list-group-item list-group-item-action' href='?mode=displaynewmemberform'>Animation</a>";
                      //echo ($mode == "movies" && $genre == "Sci-Fi") ? "<a class='list-group-item list-group-item-action active' href='?type=movies&genre=Sci-Fi'>Sci-Fi</a>" : "<a class='list-group-item list-group-item-action' href='?type=movies&genre=Sci-Fi'>Sci-Fi</a>";
                    ?>

                  </div>
                </div>
                <div class="col-9">
                  <div class="tab-content">
                    <?php
                      // If we should display the database portion or not.
                      //$display_db = true;

                      // Based on the type passed in we will decide what we are doing
                       switch ($mode) {

                        // First case is "members landing page"
                        case 'viewmembers':
                          $title = "Members";
                          $subtitle = "Showing all the members in the database.";
                          $query = "SELECT firstName, lastName, phone FROM members";
                          $content = getAll($query, $db);
                          $headers = ["firstName" => "First Name", "lastName" => "Last Name", "phone" => "Phone"];
                          $error = "There are no members in the database.";
                          displayArrayData($title, $subtitle, $content, $headers, $error);

                          break;

                        case 'displaynewmemberform':
                          include('displaynewmemberform.html');
                          break;

                        case 'addNewMember':
                          // Read input values
                          $firstName = "";
                          if (isset($_POST['firstName'])) {
                                 $firstName = $_POST['firstName'];
                          }
                          $lastName = "";
                          if (isset($_POST['lastName'])) {
                                  $lastName = $_POST['lastName'];
                          }
                          $phone = "";
                          if (isset($_POST['phone'])) {
                                $phone = $_POST['phone'];
                          }

                          $memberType = "";
                          if (isset($_POST['memberType'])) {
                               $memberType = $_POST['memberType'];
                          }
                          // Define SQL statement
                          if ($firstName === '' || $lastName === '') {
                            echo "Invalid data";
                          } else {
                            // Prepare and execute the SQL statement
                            // Prepare SQL statement
                            $sql = "INSERT INTO `members` (firstName, lastName, phone, memberType) VALUES (:firstName, :lastName, :phone, :memberType);";
                            $parameters = [ ":firstName" => $firstName, ":lastName" => $lastName,  ":phone" => $phone, ":memberType" => $memberType];
                            $stm =$db->prepare($sql);
                            // execute the statement object
                            $stm->execute($parameters);
                            // Display an appropriate message
                            echo "<p>Added a new member!</p>";
                          }


                          break;

                        default:
                          break;
                       }

                    ?>
                  </div>
                </div>
              </div>
              <?php
                $db = null; // clear connection
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
