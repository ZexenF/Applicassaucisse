<?php

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $recipe =[
      "rRecipeID"			=> $_POST['rRecipeID'],
      "rRecipeTitle"		=> $_POST['rRecipeTitle'],
      "rRecipeDescription"  => $_POST['rRecipeDescription'],
      "rCookTime"			=> $_POST['rCookTime'],
      "rPrepTime"			=> $_POST['rPrepTime'],
    ];

    $sql = "UPDATE tRecipes 
            SET rRecipeID = :rRecipeID, 
				rRecipeTitle = :rRecipeTitle, 
				rRecipeDescription = :rRecipeDescription,
				rCookTime = :rCookTime, 
				rPrepTime = :rPrepTime
            WHERE rRecipeID = :rRecipeID";
  
  $statement = $connection->prepare($sql);
  $statement->execute($recipe);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['rRecipeID'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['rRecipeID'];

    $sql = "SELECT * FROM tRecipes WHERE rRecipeID = :rRecipeID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':rRecipeID', $id);
    $statement->execute();
    
    $recipe = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['rRecipeTitle']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit a recipe</h2>

 <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($recipe as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" rRecipeID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'rRecipeID' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
 
<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
