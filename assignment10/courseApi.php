<?php
/* Servers usually allow GET requests from other domains but allow POST requests only
   from the same domain by default.

   Include headers for cross-domain access control

   Code from weekly activity 12, modified code to work with assignment.
*/

header("Access-Control-Allow-Origin: *");

// Allow the following request methods
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, DELETE");

// Define other parameters
header("Access-Control-Allow-Headers: Content-Type, , Authorization, X-Requested-With");

// include pdo_connect.php file
include('pdo_connect.php');


/* Define variables and assign default values */
$parameterValues = null; // Set the $parameterValues to null

$type = null;

/* Most of the page requests are sent using the GET method
  The 'type' defines the particular task requested.
  Read user input 'type'
*/
if (isset($_GET['type'])){
   $type = $_GET['type'];
}


// Define response based on the user request (input)
switch ($type) {
  case 'courses':
       $subject = (isset($_GET['subject'])) ? $_GET['subject'] : NULL;

       // If neither or both of the fields are put in there
       if (!isset($subject)) {
         $response = $error;
       } else {
         if ($subject === 'All') {
           $sql = "SELECT subject, number, title, description, maxcredits FROM courses ORDER BY subject, number;";
         } else {
           $sql = "SELECT subject, number, title, description, maxcredits FROM courses WHERE subject = :subject ORDER BY number;";
           $parameterValues = array(':subject' => $subject);
         }

         $response = getAllRecords($sql, $db, $parameterValues);
       }
      break;

  case 'schedule':
    $location = (isset($_GET['location'])) ? $_GET['location'] : NULL;

    if (!isset($location)) {
      $response = $error;
    } else {
      if ($location === 'All') {
        $sql = "SELECT s.subject, s.number, s.sectionId, s.instructor, s.displayTime FROM schedule s LEFT JOIN courses c ON s.number = c.number AND s.subject = c.subject GROUP BY subject, number, sectionId, instructor, displayTime;";
      } else {
        $sql = "SELECT s.subject, s.number, s.sectionId, s.instructor, s.displayTime FROM schedule s LEFT JOIN courses c ON s.number = c.number AND s.subject = c.subject WHERE s.location = :location GROUP BY subject, number, sectionId, instructor, displayTime;";
        $parameterValues = array(':location' => $location);
      }

      $response = getAllRecords($sql, $db, $parameterValues);
    }
    break;
default :
      $response = array();
      break;
} // end switch


/* $response is an  array of matching records ( array of associative arrays). The server response must be a string so we
have to convert this array into a string with a format that is easy to convert to
an array of Javascript objects.

We use the json_encode() method to convert the $response into a string using a format which can
easily be converted into an array of JavaScript objects called JSON objects.
*/
echo json_encode($response);




function getAllRecords($sql, $db, $values = null){

/* Input values:
1. SQL statement that includes 'named' parameters

2. Database connection

3. (Optional) Values for 'named' parameters, if there are any 'named' parameters in the SQL statement

Output: Array of matching result records. Each element in the array is an associative array.

*/
// prepare SQL statement
$stm = $db->prepare($sql);
// execute SQL statement
$stm->execute($values);
// fetch all records
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
// return the result set
return $result;
}
