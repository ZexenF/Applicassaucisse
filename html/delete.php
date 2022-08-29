<?php

require "config.php";
require "common.php";

$success = null;

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
 
    $id = $_POST["submit"];

    $sql = "DELETE FROM tRecipes WHERE rRecipeID = :rRecipeID";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':rRecipeID', $id);
    $statement->execute();

    $success = "Recipe successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM tRecipes";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Delete a recipe</h2>

<?php if ($success) echo $success; ?>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Recipe Title</th>
          <th>Description</th>
          <th>Cooking Time</th>
          <th>Preparation Time</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["rRecipeID"]); ?></td>
          <td><?php echo escape($row["rRecipeTitle"]); ?></td>
          <td><?php echo escape($row["rRecipeDescription"]); ?></td>
          <td><?php echo escape($row["rCookTime"]); ?></td>
          <td><?php echo escape($row["rPrepTime"]); ?></td>
        </tr>
        <td><button type="submit" name="submit" value="<?php echo escape($row["rRecipeID"]); ?>">Deleto Maximo</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>