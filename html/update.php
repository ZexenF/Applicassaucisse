<?php

require "config.php";
require "common.php";

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
        
<h2>Update recipe</h2>

<table>
    <thead>
        <tr>
          <th>ID</th>
          <th>Recipe Title</th>
          <th>Description</th>
          <th>Cooking Time</th>
          <th>Preparation Time</th>
          <th>Edit</th>
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
            <td><a href="update-mono.php?rRecipeID=<?php echo escape($row["rRecipeID"]); ?>">Edito Maximo</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>