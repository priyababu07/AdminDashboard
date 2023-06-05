<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aganwadi Worker Form</title>
</head>
<body>
    <h2>Aganwadi Worker Form</h2>
    <form action="process_worker.php" method="POST">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br>
        
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        
        <label for="age">Age:</label>
        <input type="number" name="age" required><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
