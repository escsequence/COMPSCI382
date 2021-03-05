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
                <a class="nav-link" href="../assignments.html">Assignments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../activities.html">Activites</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- Main body of the HTML page. -->
    <div class="content container-fluid mt-2">
      <?php
        include('pdo_connect.php');
      ?>
      <!-- Assignemnt 1 -->
      <div class="activity" id="activity-w7-part-1">
          <div class="card">
            <div class="card-header bg-secondary text-white">
              Week 7 Activity - PDO Object
            </div>
            <div class="card-body">
              <p>In this example we load our database connection from a file and verify it's loaded properly.</p>
              <?php
                // check for db connection
                if(isset($db)) {
                  echo "<strong>Status:</strong> <span class='text-success'>Connected</span>";
                } else {
                  echo "<strong>Status:</strong> <span class='text-danger'>Could not connect</span>";
                }
              ?>
            </div>
          </div>
      </div>

      <div class="activity mt-2" id="activity-w7-part-2">
          <div class="card">
            <div class="card-header bg-secondary text-white">
              Week 7 Activity - PDO Object Fetch Data From Database Table
            </div>
            <div class="card-body">
              <p>In this example we list the top 5 movies in the database.</p>
              <?php
                // Define the SQL statement
                $sql = "SELECT title, type FROM `movies` LIMIT 5";

                // Use the prepare( ) method of the PDO object to prepare the SQL statement for execution.
                $statement = $db->prepare($sql);

                // Use the execute() method of the PDOStatement class to query the database to obtain a matching result set.
                $statement->execute();

                // We can fetch either a single row using the fetch( ) method  or the entire set of records in the result set by using the fetchAll( ) method of the PDOStatement class.

                while ($row = $statement->fetch()){
                  /* Each $row is an associative array.  Keys are the same as the field names
                     used in the SQL statement: title and type. */

                  echo "<p><strong>Title</strong>: ".$row['title'].", Type: ".$row['type']."</p>";
                }
              ?>
            </div>
          </div>
      </div>

      <div class="activity mt-2" id="activity-w7-part-3">
          <div class="card">
            <div class="card-header bg-secondary text-white">
              Week 7 Activity - PDO Object Fetch Data From Database Table - Multiple
            </div>
            <div class="card-body">
              <p>In this example we list the top 5 movies in the database then the top 5 members all in the same PHP.</p>
              <?php
                // Define the SQL statement
                $sql = "SELECT title, type FROM `movies` LIMIT 5";
                $sql_members = "SELECT firstName, lastName FROM `members` LIMIT 5";

                // Use the prepare( ) method of the PDO object to prepare the SQL statement for execution.
                $statement = $db->prepare($sql);

                /* Create a second PDOStatement object */
                $statement_members = $db->prepare($sql_members);

                // Use the execute() method of the PDOStatement class to query the database to obtain a matching result set.
                $statement->execute();

                // We can fetch either a single row using the fetch( ) method  or the entire set of records in the result set by using the fetchAll( ) method of the PDOStatement class.

                while ($row = $statement->fetch()){
                  /* Each $row is an associative array.  Keys are the same as the field names
                     used in the SQL statement: title and type. */

                  echo "<p><strong>Title</strong>: ".$row['title'].", Type: ".$row['type']."</p>";
                }

                $statement->closeCursor();
                $statement_members->execute();

                echo '<hr />';

                while ($row = $statement_members->fetch()){
                  /* Each $row is an associative array.  Keys are the same as the field names
                     used in the SQL statement: title and type. */

                  echo "<p><strong>Member</strong>: ".$row['firstName'].", ".$row['lastName']."</p>";
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

  <?php
    $db = null; // clear connection
  ?>
  <!-- Footer W.I.P -->
  <footer>
    <div class="footer">

    </div>
  </footer>
</html>
