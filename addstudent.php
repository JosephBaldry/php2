<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to add the student details
      $sql = "INSERT INTO student";
	  $sql.= "(studentid, password, dob, firstname, lastname, house, town, county, country, postcode)";
	  $sql.= "VALUES ('$_POST[txtstudentid]', '$_POST[txtpassword]', '$_POST[txtdob]', '$_POST[txtfirstname]', '$_POST[txtlastname]', '$_POST[txthouse]', '$_POST[txttown]', '$_POST[txtcounty]', '$_POST[txtcountry]', '$_POST[txtpostcode]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
   }
    {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
     // $sql = "select * from student where studentid='". $_SESSION['id'] . "';";


      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>My Details</h2>
   <form name="frmdetails" action="" method="post">
    Student ID :
   <input class='form-control' name="txtstudentid" type="text" value="" /><br/>
    Password :
   <input class='form-control' name="txtpassword" type="text" value="" /><br/>
    Date of Birth :
   <input class='form-control' name="txtdob" type="text" value="" /><br/>
   First Name :
   <input class='form-control' name="txtfirstname" type="text" value="" /><br/>
   Surname :
   <input class='form-control' name="txtlastname" type="text"  value="" /><br/>
   Number and Street :
   <input class='form-control' name="txthouse" type="text"  value="" /><br/>
   Town :
   <input class='form-control' name="txttown" type="text"  value="" /><br/>
   County :
   <input class='form-control' name="txtcounty" type="text"  value="" /><br/>
   Country :
   <input class='form-control' name="txtcountry" type="text"  value="" /><br/>
   Postcode :
   <input class='form-control' name="txtpostcode" type="text"  value="" /><br/>
   <input class='btn btn-default' type="submit" value="Save" name="submit"/>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
