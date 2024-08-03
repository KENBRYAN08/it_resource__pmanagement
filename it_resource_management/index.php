<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it_resource_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add_resource'])) {
    $resource_name = $_POST['resource_name'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $allocated_to = $_POST['allocated_to'];
    $date_allocated = $_POST['date_allocated'];

    $sql = "INSERT INTO resources (resource_name, type, status, allocated_to, date_allocated) VALUES ('$resource_name', '$type', '$status', '$allocated_to', '$date_allocated')";
    $conn->query($sql);
}

if (isset($_POST['delete_resource'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM resources WHERE id=$id";
    $conn->query($sql);
}

if (isset($_POST['update_resource'])) {
    $id = $_POST['id'];
    $resource_name = $_POST['resource_name'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $allocated_to = $_POST['allocated_to'];
    $date_allocated = $_POST['date_allocated'];

    $sql = "UPDATE resources SET resource_name='$resource_name', type='$type', status='$status', allocated_to='$allocated_to', date_allocated='$date_allocated' WHERE id=$id";
    $conn->query($sql);
}

if (isset($_POST['clear_resources'])) {
    $sql = "TRUNCATE TABLE resources";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM resources");

?>


<!DOCTYPE html>
<html>
<head>
    <title>IT Resource Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px:
            text-align: left;
        }
    </style>
    <script type="text/javascript">
        function confirmClearAll() {
            return confirm('Are you sure you want to delete all data?');
        }
    </script>
</head>
<body>

<h2>IT Resource Management of PHINMA Union College</h2>

<h3>Add New Resource</h3>

<form action="index.php" method="post">

    <input type="text" name="resource_name" placeholder="Resource Name" required>
    <input type="text" name="type" placeholder="Type" required>
    <input type="text" name="status" placeholder="Status" required>
    <input type="text" name="allocated_to" placeholder="Allocated To">
    <input type="date" name="date_allocated" placeholder="Date Allocated">
    <input type="submit" name="add_resource" value="Add Resource">
</form>

<h3>Resources</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Resource Name</th>
        <th>Type</th>
        <th>Status</th>
        <th>Allocated To</th>
        <th>Date Allocated</th>
        <th>Actions</th>
    </tr>
    <?php

    $conn = new mysqli('localhost', 'root', '', 'it_resource_management');
    
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add_resource'])) {
    $resource_name = $_POST['resource_name'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $allocated_to = $_POST['allocated_to'];
    $date_allocated = $_POST['date_allocated'];

    $sql = "INSERT INTO resources (resource_name, type, status, allocated_to, date_allocated)

            VALUES ('$resource_name', '$type', '$status', '$allocated_to', '$date_allocated')";
    $conn->query($sql);
}

if (isset($_POST['delete_resource'])) {
   $id = $_POST['id'];
   $sql = "DELETE FROM resources WHERE id=$id";
   $conn->query($sql);
}

if (isset($_POST['update_resource'])) {
   $id = $_POST['id'];
   $resource_name = $_POST['resource_name'];
   $type = $_POST['type'];
   $status = $_POST['status'];
   $allocated_to = $_POST['allocated_to'];
   $date_allocated = $_POST['date_allocated'];

   $sql = "UPDATE resources SET resource_name='$resource_name', type='$type', status='$status', allocated_to='$allocated_to', date_allocated='$date_allocated' WHERE id=$id";
   $conn->query($sql);
}

if (isset($_POST['clear_all'])) {
    $sql = "DELETE FROM resources";
    $conn->query($sql);
}

   $result = $conn->query("SELECT * FROM resources");
   while ($row = $result->fetch_assoc()) {
       echo "<tr> 
           <td>{$row['id']}</td>
           <td>{$row['resource_name']}</td>
           <td>{$row['type']}</td>
           <td>{$row['status']}</td>
           <td>{$row['allocated_to']}</td>
           <td>{$row['date_allocated']}</td>
           <td>
               <form style='display:inline;' action='edit_resource.php' method='post'>
                   <input type='hidden' name='id' value='{$row['id']}'>
                   <input type='submit' value='Edit'>
               </form>
               <form style='display:inline;' action='index.php' method='post'>
                   <input type='hidden' name='id' value='{$row['id']}'>
                   <input type='submit' name='delete_resource' value='Delete'>
               </form>
             </td>
        </tr>";
}

   $conn->close();
   ?>
</table>
<br>
<form action="index.php" method="post" onsubmit="return confirmClearAll();">
    <input type="submit" name="clear_all" value="Clear All">
</form>

</body>
</html>