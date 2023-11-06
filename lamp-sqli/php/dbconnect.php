<?php

// Often, php code is structed such that a "db.php" or "dbconnect.php" file is used
// this file will setup the connection to the database and allow for queries to be sent to the db.
// this follows the principal of DRY (don't repeat yourself) code
// this isn't necessarily the most performant version of how to use this but it's been common for a lot of dev in the past.

// custom function to query the db and return results:
// and no, this is not good code. that's the point of this!
function query_db($sql)
{
  $servername = "db"; // This should match the service name of the MySQL service in docker-compose (aka this is the "hostname" of the mysql server)
  $username = "root";
  $password = "iamrootpassword";
  $dbname = "sqli_database";

  // enable error reporting
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Mysql connection failed in db.php, did docker startup the mysql server? error: " . $conn->connect_error);
  }

  try {
    print("<strong>running query: " . htmlspecialchars($sql) . "</strong>\n\n\n<pre style='background: #ccc;'>");

    // execute the sql statement against the mysql connection (aka query the mysql server)
    $result = $conn->query($sql);

    // Check if the query was successful and there are results
    if ($result && is_bool($result) === false) {
      // Fetch all the rows from the result set
      $rows = $result->fetch_all(MYSQLI_ASSOC);

      print("query results:\n");

      if(count($rows) > 0){
        print_r($rows);
      } else {
        print("no rows returned.");
      }
      print("</pre>");

      return $rows;
    } else {
      echo "No records found.\n\n";
      // print_r($result == false);
    }
  } catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    // echo "SQL: " . htmlspecialchars($sql);
    // In a production environment, you would likely want to log this error to an error log and not output it to the browser
  } catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
  }

  print("</pre>");

  return null;
}
