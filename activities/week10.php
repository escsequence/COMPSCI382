<?php
  /******************************
  / Assignment 6
  / Author: James Johnston
  / Date: 3/5/2021
  / CS382
  **/

  // Connect to the db
  include('pdo_connect.php');

  // Get the get values passed through
  $type = isset($_GET['type']) ? strip_tags($_GET['type']) : null;
  $genre = isset($_GET['genre']) ?  strip_tags($_GET['genre']) : null;
  $genre2 = isset($_GET['genre2']) ? strip_tags($_GET['genre2']) : null;
  $id = isset($_GET['id']) ? strip_tags($_GET['id']) : null;
  $date = isset($_GET['date']) ? strip_tags($_GET['date']) : null;
  $date2 = isset($_GET['date2']) ? strip_tags($_GET['date2']) : null;

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
              Assignment 6
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <div class="list-group" role="tablist">
                    <?php
                      // Print out our links, this shows which one is currently selected atm
                      echo ($type == null) ? "<a class='list-group-item list-group-item-action active' href='./assignment6.php'>Home</a>" : "<a class='list-group-item list-group-item-action' href='./assignment6.php'>Home</a>";
                      echo ($type == "members") ? "<a class='list-group-item list-group-item-action active' href='?type=members'>Members</a>" : "<a class='list-group-item list-group-item-action' href='?type=members'>Members</a>";
                      echo ($type == "movies" && $genre == "Animation") ? "<a class='list-group-item list-group-item-action active' href='?type=movies&genre=Animation'>Animation</a>" : "<a class='list-group-item list-group-item-action' href='?type=movies&genre=Animation'>Animation</a>";
                      echo ($type == "movies" && $genre == "Sci-Fi") ? "<a class='list-group-item list-group-item-action active' href='?type=movies&genre=Sci-Fi'>Sci-Fi</a>" : "<a class='list-group-item list-group-item-action' href='?type=movies&genre=Sci-Fi'>Sci-Fi</a>";
                      echo ($type == "rentals" && $genre == null) ? "<a class='list-group-item list-group-item-action active' href='?type=rentals&date=2017-12-31'>Rentals</a>" : "<a class='list-group-item list-group-item-action' href='?type=rentals&date=2017-12-31'>Rentals</a>";
                      echo ($type == "rentals" && $genre == "Sci-Fi") ? "<a class='list-group-item list-group-item-action active' href='?type=rentals&date=2017-12-31&genre=Sci-Fi'>Sci-Fi Rentals</a>" : "<a class='list-group-item list-group-item-action' href='?type=rentals&date=2017-12-31&genre=Sci-Fi'>Sci-Fi Rentals</a>";
                      echo ($type == "movies" && $genre == "Drama") ? "<a class='list-group-item list-group-item-action active' href='?type=movies&date=2010&date2=2019&genre=Drama'>Drama</a>" : "<a class='list-group-item list-group-item-action' href='?type=movies&date=2010&date2=2019&genre=Drama'>Dramas</a>";
                      echo ($type == "rentalreport" && ($genre == null && $id == null && $date == null)) ? "<a class='list-group-item list-group-item-action active' href='?type=rentalreport'>Rental Report</a>" : "<a class='list-group-item list-group-item-action' href='?type=rentalreport'>Rental Report</a>";
                      echo ($type == "rentalreport" && ($genre != null && $id == null && $date == null)) ? "<a class='list-group-item list-group-item-action active' href='?type=rentalreport&genre=Drama&genre2=Adventure'>Drama/Adventure Rentals</a>" : "<a class='list-group-item list-group-item-action' href='?type=rentalreport&genre=Drama&genre2=Adventure'>Drama/Adventure Rentals</a>";
                      echo ($type == "rentalreport" && ($genre != null && $id != null)) ? "<a class='list-group-item list-group-item-action active' href='?type=rentalreport&genre=Sci-Fi&id=5'>Sci-Fi Rentals for Juan</a>" : "<a class='list-group-item list-group-item-action' href='?type=rentalreport&genre=Sci-Fi&id=5'>Sci-Fi Rentals for Juan</a>";
                      echo ($type == "rentalreport" && ($genre != null && $date != null)) ? "<a class='list-group-item list-group-item-action active' href='?type=rentalreport&genre=Drama&date=2019-12-01'>Drama Rental Report</a>" : "<a class='list-group-item list-group-item-action' href='?type=rentalreport&genre=Drama&date=2019-12-01'>Drama Rental Report</a>";
                    ?>

                  </div>
                </div>
                <div class="col-9">
                  <div class="tab-content">
                    <?php
                      // If we should display the database portion or not.
                      $display_db = true;

                      // Based on the type passed in we will decide what we are doing
                       switch ($type) {

                         // First case is "members landing page"
                         case 'members':
                          $title = "Members";
                          $subtitle = "Showing all the members in the database.";
                          $query = "SELECT firstName, lastName, phone FROM members";
                          $content = getAll($query, $db);
                          $headers = ["firstName" => "First Name", "lastName" => "Last Name", "phone" => "Phone"];
                          $error = "There are no members in the database.";
                          break;

                         case 'movies':
                          $title = "Movies";
                          $query_params = Array(":type" => $genre);
                          // Check to see if the date1 and date2 are set so we know what kind of query this is
                          if ($date != null && $date2 != null) {
                            // Not normal, it is containing a date

                            // Sub title contaning the date
                            $subtitle = "List of $genre movies released between the years $date and $date2.";

                            $query = "SELECT title, type, year FROM movies WHERE type = :type AND year BETWEEN :year1 AND :year2;";
                            $query_params[":year1"] = $date;
                            $query_params[":year2"] = $date2;
                            $headers = ["title" => "Title", "type" => "Type", "year" => "Year"];
                          } else {
                            // Normal query without date criteria

                            // Sub title, stripping out any possible html in the query
                            $subtitle = "List of $genre movies.";

                            // Assemble the query
                            $query = "SELECT title, year, movieID FROM movies WHERE type = :type";
                            $headers = ["title" => "Title", "year" => "Year", "movieID" => "Movie ID#"];
                          }
                          $content = getAll($query, $db, $query_params);
                          $error = "There are no movies in the database under that genre.";
                          break;

                          case 'rentals':
                           $title = "Rentals";
                           $query_params = Array(":date" => $date);
                           if ($genre == null) {
                             $query = "SELECT m.title, m.type, r.dateOut FROM rentals r INNER JOIN movies m ON m.movieID = r.movieID WHERE r.dateOut < :date;";
                             $subtitle = "List of all movie rentals checked out before $date.";
                           } else {
                             $query = "SELECT m.title, m.type, r.dateOut FROM rentals r INNER JOIN movies m ON m.movieID = r.movieID WHERE r.dateOut > :date AND m.type = :genre;";
                             $query_params[":genre"] = $genre;
                             $subtitle = "List of $genre movie rentals checked out before $date.";
                           }
                           $content = getAll($query, $db, $query_params);
                           $headers = ["title" => "Title", "type" => "Type", "dateOut" => "Date Out"];
                           $error = "There are no rentals in the database that match that criteria.";
                           break;

                         case 'rentalreport':
                          $title = "Rental Report";
                          $headers = ["firstName" => "First Name", "lastName" => "Last Name", "title" => "Title", "type" => "Type", "year" => "Year"];
                          if ($genre == null) {
                            $subtitle = "List of all the rentals out and whom rented it.";
                            $query = "SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) ORDER BY mb.memberID ASC;";
                            $query_params = null;
                          } else {
                            $query_params = [":type" => $genre];
                            // If there is a second genre provided we want to see items that are (this or that) genre wise.
                            if ($genre2 != null) {
                              $subtitle = "List of all the $genre or $genre2 rentals and whom rented it.";
                              $query = "SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) WHERE mv.type = :type OR mv.type = :type2 ORDER BY mb.memberID ASC;";
                              $query_params[":type2"] = $genre2;
                            } else if ($id != null) {
                              $subtitle = "List of all the $genre rentals for user id $id.";
                              $query = "SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) WHERE mv.type = :type AND mb.memberID = :memberid;";
                              $query_params[":memberid"] = $id;
                            } else if ($date != null) {
                              $subtitle = "List of all the $genre rentals for all members checked out after $date.";
                              $query = "SELECT mb.firstName, mb.lastName, mv.title, mv.type, mv.year, r.dateOut FROM members mb LEFT JOIN rentals r USING(memberID) INNER JOIN movies mv ON (r.movieID = mv.movieID) WHERE mv.type = :type AND r.dateOut > :date;";
                              $query_params[":date"] = $date;
                              $headers["dateOut"] = "Date Out";
                            }
                          }
                          $content = getAll($query, $db, $query_params);
                          $error = "No rentals checked out by any users found.";
                          break;

                         default:
                          // We tell the bottom portion we aren't able to display anything
                          $display_db = false;
                          break;

                       }

                       // We determine if we are display data or not.
                      if ($display_db) {

                        // Call our function and pass in our variables we assembled above.
                        displayArrayData($title, $subtitle, $content, $headers, $error);

                      } else {

                        // This means we are showing the "landing page" or something else.
                        echo "<h3>Welcome to the Movie Store database!</h3>Please select an option to query our massive collection of movies, rentals, or members.";

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
