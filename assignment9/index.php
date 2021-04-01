<?php
  /******************************
  / Assignment 8
  / Author: James Johnston
  / Date: 3/25/2021
  / CS382
  **/

  // Connect to the db
  include('pdo_connect.php');

  // Mode of what to display/actions
  $mode = isset($_GET['mode']) ? strip_tags($_GET['mode']) : null;

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
    <title>COMPSCI382 | Assignment 8</title>
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
              Assignment 8
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <div class="list-group" role="tablist">
                    <?php
                      // Print out our links, this shows which one is currently selected atm
                      echo ($mode == null) ? "<a class='list-group-item list-group-item-action active' href='./index.php'>Home</a>" : "<a class='list-group-item list-group-item-action' href='./index.php'>Home</a>";
                      echo ($mode == "viewmembers") ? "<a class='list-group-item list-group-item-action active' href='?mode=viewmembers'>Members</a>" : "<a class='list-group-item list-group-item-action' href='?mode=viewmembers'>Members</a>";
                      echo ($mode == "displaynewmemberform") ? "<a class='list-group-item list-group-item-action active' href='?mode=displaynewmemberform'>Add New Member</a>" : "<a class='list-group-item list-group-item-action' href='?mode=displaynewmemberform'>Add New Member</a>";
                      echo ($mode == "selectmember") ? "<a class='list-group-item list-group-item-action active' href='?mode=selectmember'>Update Member Information</a>" : "<a class='list-group-item list-group-item-action' href='?mode=selectmember'>Update Member Information</a>";
                      echo ($mode == "displaynewmovieform") ? "<a class='list-group-item list-group-item-action active' href='?mode=displaynewmovieform'>Add New Movie</a>" : "<a class='list-group-item list-group-item-action' href='?mode=displaynewmovieform'>Add New Movie</a>";
                    ?>

                  </div>
                </div>
                <div class="col-9">
                  <div class="tab-content">
                    <?php
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
                        case 'displaynewmovieform':
                          include('displaynewmovieform.html');
                          break;

                        case 'addNewMovie':
                          // Read input values
                          $movieTitle = "";
                          if (isset($_POST['movieTitle'])) {
                                 $movieTitle = $_POST['movieTitle'];
                          }
                          $movieGenre = "";
                          if (isset($_POST['movieGenre'])) {
                                  $movieGenre = $_POST['movieGenre'];
                          }
                          $movieYear = "";
                          if (isset($_POST['movieYear'])) {
                                $movieYear = $_POST['movieYear'];
                          }

                          // Define SQL statement
                          if ($movieTitle === '' || $movieGenre === '' || $movieYear === '') {
                            echo "Invalid movie data, please go back and fill out title, genre, and year.";
                          } else {
                            // Prepare SQL statement
                            $sql = "INSERT INTO `movies` (title, year, type) VALUES (:movieTitle, :movieYear, :movieType);";
                            $parameters = [ ":movieTitle" => $movieTitle, ":movieYear" => $movieYear,  ":movieType" => $movieGenre];
                            $stm =$db->prepare($sql);

                            // execute the statement object
                            $stm->execute($parameters);

                            // Display an appropriate message
                            echo "<div>";
                            echo "<p>Added the following movie to the database:</p>";
                            echo "<p><strong>Title:</strong> $movieTitle</p>";
                            echo "<p><strong>Genre:</strong> $movieGenre</p>";
                            echo "<p><strong>Genre:</strong> $movieYear</p>";
                            echo "</div>";
                          }
                          break;

                        case 'addNewMember':
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

                        case 'selectmember':
                          // Need to display a list of members so that we can select a member to update data
                          $sql = "select `memberId`, `firstName`, `lastName` from `members` order by `lastName`";

                          // This SQL statement does not use any parameters. Use the default $parameterValues array.
                          $dataList = getAll($sql, $db, null);

                          // Define page title
                          $pageTitle = "Select a Member form the List to Update Information";

                          // Include a template to display a list of members
                          include('displayMemberList.php');
                          break;

                        case "displayMemberInfo":
                           /* The request (link) sends two key=value pairs using the GET method: type and memberId */

                           // By default, a link uses the GET method to send key/value pairs. Use the $_GET array to read the member id
                           $memberId = (isset($_GET['memberId'])) ? $_GET['memberId'] : null;

                           // If the $memberID is null then display an error message and exit.
                           if (!isset($memberId)) {
                             echo "You have not selected a member!";
                             exit();
                           }

                           // Select member's data
                           $sql = "select `memberId`, `firstName`, `lastName`, `phone`, `memberType` from `members` where `memberId` = :memberId";

                           // Define values for named parameters
                           $parameterValues = array(":memberId" => $memberId);

                          // Fetch data
                          $dataList = getAll($sql, $db, $parameterValues);

                          // Define page title
                          $pageTitle = "Update Member Information";

                          // Include a template to display a list of members
                          include('displayMemberInfo.php');
                          break;
                        case 'updatememberinfo':
                        // Read input values
                    			$phone = "";
                    			if (isset($_POST['phone'])) {
                    				   $phone = $_POST['phone'];
                    			}
                    			$memberType = "";
                    			if (isset($_POST['memberType'])) {
                    					$memberType = $_POST['memberType'];
                    			}
                    			$memberId = "";
                    			if (isset($_POST['memberId'])) {
                    				  $memberId = $_POST['memberId'];
                    			}

                    			/* if the memberId, phone,  or memberType is empty then display
                    			an error message.
                    			*/
                    			if ($memberId === '' || $phone === '' || $memberType === "") {
                    				echo "Invalid data";
                    				exit();
                    			}
                    			// Define the SQL statement
                    			$sql = "UPDATE  `members` SET `phone` = :phone, `memberType` = :memberType WHERE memberId = :memberId";

                    			// Define values for the named parameters
                    			$parameterValues = array(":phone" => $phone,
                    					":memberType" => $memberType,
                    					 ":memberId" =>$memberId
                    				);

                    			// Prepare SQL statement
                    			$stm =$db->prepare($sql);
                    			// execute the statement object
                    			$stm->execute($parameterValues);
                    			// display an appropriate message
                    			echo "Successfully updated selected member's information.";
                          break;
                          
                        default:
                          echo "<p>Homepage for Assignment 8. Please select an action.</p>";
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
