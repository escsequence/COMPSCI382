<?php
  if (isset($pageTitle)) {
	echo "<h4>{$pageTitle}</h4>";
  }

  // Check if the dataList is not empty
	if (count($dataList) === 0) {
		echo "There is no data";
		exit();
	}

  // Get the genres dynamically
  $movieTypeSql = "SELECT DISTINCT `type` from `movies` order by `type`";
  $movieTypeDataList = getAll($movieTypeSql, $db, null);
  $movieGenres = Array();
  foreach($movieTypeDataList as $movieTypeDataListInstance) {
    array_push($movieGenres, $movieTypeDataListInstance['type']);
  }

   /* In this case, the SQL should return just one record matching the given memberId.
	  Hence, $dataList is an array that consists of just one matching record
   */
   $movie = $dataList[0];
   // Display name of the selected member
   // Use an HTML form to display data
   ?>
    <form action="index.php?mode=updatemovieinfo" method="post">
		<table class="table" style="width: 500px;">
		  <tbody>

			<tr>
				<td>Title</td>
				<td><input type="text" name="title" value="<?php echo $movie['title']; ?>" /></td>
			</tr>
			<tr>
				<td>Movie Type/Genre</td>
				<td><select name="movieType">
          <?php
            foreach($movieGenres as $genre) {
              if ($movie['type'] === $genre) {
                echo "<option value='$genre' selected='selected'>$genre</option>";
              } else {
                echo "<option value='$genre'>$genre</option>";
              }
            }
          ?>
					</select>
				</td>
			</tr>
      <tr>
        <td>Year</td>
        <td><input type="text" name="year" value="<?php echo $movie['year']; ?>" /></td>
      </tr>
		  </tbody>
		</table>
		<!-- Need to send memberId to the server using an input element (key=value ).
			We can use a hidden field to define a key=value pair. A hidden field will not be displayed.
		-->
		<input type="hidden" name="movieID" value="<?php echo $movie['movieID']; ?>" />
		<p><button type="submit" class="btn btn-primary">Update Member Information </button>
	</form>
