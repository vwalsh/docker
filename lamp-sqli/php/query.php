<!DOCTYPE html>
<html>
  <style>
    body{
      background: #111;
      color: #ddd;
    }
    pre{
      background: #222;
      color: #eee;
      padding: 10px;
    }
    strong{
      color: #fff;
      font-size: 24px;
    }
    span.sqli{
      color: red;
    }
  </style>
<body>

<h1>Query Results:</h1>
<strong>WARNING: this is a docker container running on your host machine. You can still mess up your host via this.
  Be sure you understand if you delete/overwrite files, it may delete/overwrite files located on your host. While this should be limited
  to the files that run this docker container (eg, php files, sql files), you might just be super creative and find
  a way to make this warning a liar.
  <br/>
  <br/>
  You've been warned. GLHF!
</strong>
<?php

// include the db connection info so we can make queries later in this script
include_once("./dbconnect.php");

// SEE: ../mysql/init.sql for details on the default TABLE and data inserted into the table

// grab the POST vars from the submitted HTTP form
$user = $_POST['uname'];
$pass = $_POST['psw'];

if(!empty($user) && !empty($pass)){

  // ==================================== SQLi is here! =======================================================
  // This is where you should consider editing the code manually if you don't want to use the POST vars.
  // Prepare the SELECT statement to run as an SQL query 
  $sql = "SELECT user,email FROM users WHERE user = '$user' AND pass = '$pass';";
  $sql_pretty = "SELECT user,email FROM users WHERE user = '<span class='sqli'>$user</span>' AND pass = '<span class='sqli'>$pass</span>';";

  // ==================================== SQLi is here! =======================================================

  
  // this executes the query, it's a custom function located in the dbconnect.php file
  // NOTE: $sql is the actual query, $sql_pretty is for better debugging!
  $results = query_db($sql, $sql_pretty);
  // TODO: utilize the $results to show how a login page might work
  // TODO: show how a search function might work
  // TODO: show how a newsletter signup might work
  // TODO: show how to properly sanitize input to avoid sqli
  // TODO: show how to improperly sanitize input via "deny list" approach vs the proper "allow list"
}

?>
<pre>Try some sqli here, or go to the source code for this php file and see how it works.

consider trying to run various queries (by either editing the $sql variable or submitting sqli attempts).
this should help understand how a query is built when it's done poorly.
eventually this will help by showcasing some ways logins are written improperly.

NOTE: the <span class='sqli'>RED</span> text in the query is the INPUT you've given it!
</pre>

<form action="query.php" method="post" autocomplete="off">
    <!-- attempt to turn off autocomplete/autosaving of form submission -->
    <input type="hidden" autocomplete="false" />
  
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required style="width: 75%;"/>
    <br/>
    <br/>

    <label for="psw"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" name="psw" required style="width: 65%;"/>

    <br/>
    <br/>
    <button type="submit">Login</button>
</form>


</body>
</html>