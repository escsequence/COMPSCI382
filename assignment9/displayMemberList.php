<?php
  if (isset($pageTitle)) {
    echo "<h4>{$pageTitle}</h4>";
  }

  // Check if the dataList is not empty
  if (count($dataList) === 0) {
    echo "There are no members";
    exit();
  }

  foreach ($dataList as $row) {
  /* Each element is an associative array with three elements: memberId, firstName, and lastName.

  */
  echo "<ul>";
  echo "<li><a href='index.php?mode=displayMemberInfo&memberId={$row['memberId']}'>{$row['lastName']}, {$row['firstName']}</a></li>";
  echo "</ul>";
}
