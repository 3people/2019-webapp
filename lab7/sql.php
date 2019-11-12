<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SQL</title>
		<meta charset="utf-8"/>
	</head>
	<body>
    <form method="post">
      DB Name: <input type="text" name="name"/>
      DB Query: <input type="text" name="query"/>
      <input type="submit" value="submit"/>
    </form>
    <ul>
      <?php
      $dsn = 'mysql:dbname=' . $_POST['name'];
      $db = new PDO($dsn, "root", "root");
      $rows = $db->query($_POST['query']);
      foreach ($rows as $row) {
      ?>
        <li>
          <?php for($i=0; $i<count($row)/2; $i++) { ?>
            <?= $row[$i] ?>
          <?php } ?>
        </li>
      <?php } ?>
    </ul>
	</body>
</html>
