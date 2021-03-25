<!DOCTYPE html>
<html>
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Page title -->
    <title>COMPSCI382 | Week 2 Activity</title>
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


      <!-- Assignemnt 1 -->
      <div class="activity" id="activity-w2-part-1">
          <div class="card">
            <div class="card-header bg-secondary text-white">
              Week 2 Activity - Part 1
            </div>
            <div class="card-body">
              <?php
                $var1 = 10;
                $var2 = 20;
                echo '$var1 = ' . $var1;
                echo '<br />';
                echo '$var2 = ' . $var2;
                echo '<br /><br />';
                echo "<table class='table'>";
                echo "<thead>";
                  echo "<tr>";
                    echo '<th scope="col">$var1</th>';
                    echo '<th scope="col">operation</th>';
                    echo '<th scope="col">operation name</th>';
                    echo '<th scope="col">$var2</th>';
                    echo '<th scope="col">value</th>';
                  echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    echo "<tr>";
                      echo "<td>$var1</td>";
                      echo "<td>+</td>";
                      echo "<td>sum</td>";
                      echo "<td>$var2</td>";
                      $sum=$var1+$var2;
                      echo "<td>$sum</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>$var1</td>";
                      echo "<td>-</td>";
                      echo "<td>difference</td>";
                      echo "<td>$var2</td>";
                      $diff=$var1-$var2;
                      echo "<td>$diff</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>$var1</td>";
                      echo "<td>*</td>";
                      echo "<td>product</td>";
                      echo "<td>$var2</td>";
                      $prod=$var1*$var2;
                      echo "<td>$prod</td>";
                    echo "</tr>";
                echo "</tbody>";
                echo "</table>";
              ?>
            </div>
          </div>
      </div>

      <div class="activity mt-2" id="activity-w2-part-2">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            Week 2 Activity - Part 2
          </div>
          <div class="card-body">
            <?php
              $prime_numbers = array(2, 3, 5, 7, 11, 13, 17, 19, 23, 29);

              echo "<h3>First 10 prime numbers squared:</h3>";
              echo "<ul>";
              foreach ($prime_numbers as $number) {
                $squared = pow($number, 2);
                echo "<li>Number: $number, Square: $squared</li>";
              }
              echo "</ul>";
            ?>
          </div>
        </div>
      </div>

      <div class="activity mt-2" id="activity-w2-part-3">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            Week 2 Activity - Part 3
          </div>
          <div class="card-body">
            <?php
              echo "<strong>Default</strong>: <code>";
              $random_numbers = array(-1, 2, 15, 32, 2, -44, 9, -1, -31, 30);
              print_r($random_numbers);
              echo "</code><br />";
              echo "<strong>After sort function</strong>: <code>";
              sort($random_numbers);
              print_r($random_numbers);
              echo "</code><br />";
              echo "<strong>After rsort (reverse) function</strong>: <code>";
              rsort($random_numbers);
              print_r($random_numbers);
              echo '</code><br />';
              echo "<strong>Unique values</strong>: <code>";
              print_r(array_unique($random_numbers));
              echo "</code>";
            ?>
          </div>
        </div>
      </div>

      <div class="activity mt-2" id="activity-w2-part-4">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            Week 2 Activity - Part 4
          </div>
          <div class="card-body">
            <?php
            $sum_of_pos = 0;
              foreach($random_numbers as $random_number) {
                // Definition of positive is greater than 0.
                if ($random_number > 0) {
                  $sum_of_pos += $random_number;
                }
              }
              echo "Sum of the positive values (from part 3): $sum_of_pos";
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
