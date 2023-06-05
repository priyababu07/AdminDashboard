<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Child Details</title>
</head>
<body>
  <h2>Add Child Details</h2>
  <form action="insert_child.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="age">Age:</label>
    <input type="number" name="age" required><br><br>

    <label for="gender">Gender:</label>
    <select name="gender" required>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select><br><br>

    <label for="parent_name">Parent/Guardian Name:</label>
    <input type="text" name="parent_name" required><br><br>

    <label for="address">Address:</label>
    <textarea name="address" required></textarea><br><br>

    <input type="submit" value="Submit">
  </form>
</body>
</html>
