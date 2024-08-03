<!DOCTYPE html>
<html>
<head>
    <title>Edit Resource</title>
</head>
<body>

     <h2>Edit Resource</h2>


     <?php
    
    $conn= new mysqli('localhost', 'root','' , 'it_resource_management');

    if ($conn->connect_error) {
        die ("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $result = $conn->query("SELECT * FROM resources WHERE id=$id");
        $row = $result->fetch_assoc();
    }
    ?>
    
    <form action="index.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="resource_name" value="<?php echo $row['resource_name']; ?>" required>
        <input type="text" name="type" value="<?php echo $row['type']; ?>" required>
        <input type="text" name="status" value="<?php echo $row['status']; ?>" required>
        <input type="text" name="allocated_to" value="<?php echo $row['allocated_to']; ?>" required>
        <input type="date" name="date_allocated" value="<?php echo $row['date_allocated']; ?>" required>
        <input type="submit" name="update_resource" value="Update Resource">
</form>
</body>
</html>