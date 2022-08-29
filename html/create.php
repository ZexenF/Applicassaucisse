<?php

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_recipe = array(
      "rRecipeTitle" 		=> $_POST['rRecipeTitle'],
      "rRecipeDescription"  => $_POST['rRecipeDescription'],
      "rCookTime"     		=> $_POST['rCookTime'],
      "rPrepTime"      		=> $_POST['rPrepTime'],
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "tRecipes",
      implode(", ", array_keys($new_recipe)),
      ":" . implode(", :", array_keys($new_recipe))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_recipe);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['rRecipeTitle']); ?> successfully added.</blockquote>
  <?php endif; ?>

  <h2>Add a recipe</h2>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="rRecipeTitle">Recipe Title</label>
    <input type="text" name="rRecipeTitle" id="rRecipeTitle">
    <label for="rRecipeDescription">Description</label>
    <input type="text" name="rRecipeDescription" id="rRecipeDescription">
    <label for="rCookTime">Cooking Time</label>
    <input type="text" name="rCookTime" id="rCookTime">
    <label for="rPrepTime">Preparation Time</label>
    <input type="text" name="rPrepTime" id="rPrepTime">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>