<?php

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * 
            FROM tRecipes
            WHERE rRecipeTitle = :rRecipeTitle";

    $rRecipeTitle = $_POST['rRecipeTitle'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':rRecipeTitle', $rRecipeTitle, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

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
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find a recipe based on its title</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <label for="rRecipeTitle">Recipe Title</label>
  <input type="text" id="rRecipeID" name="rRecipeTitle">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>