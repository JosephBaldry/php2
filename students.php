<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

	if(isset($_POST['deleteYeet']))
	{
		foreach($_POST['deleteYeet'] as $current) // for each check box selected, delete selected entry
		{
		$sql = "DELETE FROM student where studentid =". $current . ";";
		$result = mysqli_query($conn, $sql);
		}
	}
  

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student
      $sql = "select * from student";

      $result = mysqli_query($conn,$sql);

      // prepare page content with included css
      $data['content'] .= "<form action=''method='post'>";
      $data['content'] .= "<table class='table table-bordered'>";
      $data['content'] .= "<tr><th colspan='8' align='center'>Students</th></tr>";
      $data['content'] .= "<thread><tr><th>Firstname</th><th>Lastname</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Delete</th></tr></thread>";
      // Display the students within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tbody><tr><td> $row[firstname] </td><td> $row[lastname] </td><td> $row[house]</td><td> $row[town] </td><td> $row[county] </td><td> $row[country] </td><td> $row[postcode] </td><td><center><input id='checkBox' value='$row[studentid]' name='deleteYeet[]' type='checkbox'></center> </td></tr></tbody>";
      }
      	
      $data['content'] .= "</table>";
      $data['content'] .= "</br><input type='submit' value='Delete'></form>";


      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>