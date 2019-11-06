<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		# if (){
         if( !(isset($_POST["Name"]) && isset($_POST["ID"]) && isset($_POST["course"]) && isset($_POST["grade"]) && isset($_POST["cardnumber"]) && isset($_POST["cardtype"]))){?>
            <h1>Sorry</h1>
			   <p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>
         <?php } 
         else if( !((strlen($_POST["Name"]) > 0) && (strlen($_POST["ID"]) > 0) && (strlen($_POST["grade"]) > 0) && (strlen($_POST["cardnumber"]) > 0) && (strlen($_POST["cardtype"]) > 0))){?>
            <h1>Sorry</h1>
			   <p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>
         <?php }
         else if(!(preg_match("/^[a-zA-Z]+[ -]*[a-zA-Z]+$/", $_POST["Name"]))){ ?>
            <h1>Sorry</h1>
			   <p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>
         <?php }
         else if( !(preg_match("/^[0-9]{16}/", $_POST["cardnumber"]) && ($_POST["cardtype"] == "Visa" && preg_match("/^4/", $_POST["cardnumber"]) || $_POST["cardtype"] == "MasterCard" && preg_match("/^5/", $_POST["cardnumber"])))){ ?>
            <h1>Sorry</h1>
			   <p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>
         <?php }
         else { ?>

		      <h1>Thanks, looser!</h1>
		      <p>Your information has been recorded.</p>

		      <!-- Ex 2: display submitted data -->
		      <ul> 
		      	<li>Name: <?= $_POST["Name"]?> </li>
		      	<li>ID: <?= $_POST["ID"]?> </li>
		      	<!-- use the 'processCheckbox' function to display selected courses -->
		      	<li>Course: <?= processCheckbox($_POST["course"]) ?> </li>
		      	<li>Grade: <?= $_POST["grade"]?> </li>
		      	<li>Credit <?= $_POST["cardnumber"] .  "  (" . $_POST["cardtype"] . ")" ?> </li>
		      </ul>

            <p>Here are all the loosers who have submitted here:</p>
            <?php
               $filename = "loosers.txt";
               $infor = implode(";", array($_POST["Name"], $_POST["ID"], $_POST["cardnumber"], $_POST["cardtype"]))."\n";
		      	/* Ex 3: 
		      	 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
		      	 * For example, "Scott Lee;20110115238;4300523877775238;visa"
		      	 */
               file_put_contents("loosers.txt", $infor, FILE_APPEND);
               $send_infor = file_get_contents($filename);
		      ?>

		      <!-- Ex 3: Show the complete contents of "loosers.txt".
		      	 Place the file contents into an HTML <pre> element to preserve whitespace -->

               <pre><?= $send_infor ?></pre>
         <?php } ?>
		      <?php
		      	/* Ex 2: 
		      	 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
		      	 * 
		      	 * The function checks whether the checkbox is selected or not and 
		      	 * collects all the selected checkboxes into a single string with comma separation.
		      	 * For example, "cse326, cse603, cin870"
		      	 */
		      	function processCheckbox($names){
                  return implode(", ", $names);
                }
		      ?>
	</body>
</html>
