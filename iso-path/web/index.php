<?php
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM employees WHERE id=$id";
    $conn->query($sql);
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $sql = "INSERT INTO employees (name, department) VALUES ('$name', '$department')";
    $conn->query($sql);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $sql = "UPDATE employees SET name='$name', department='$department' WHERE id=$id";
    $conn->query($sql);
}

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Задание 7 модуль 2</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header {
            background-color: #017d0c;
            color: white;
            text-align: center;
            padding: 20px;
            height: 10%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .header img { max-height: 100px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        .btn {
            color: white;
            background-color: #017d0c;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 5px;
        }
        .add-btn {
            background-color: #017d0c;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .form-container { margin-top: 20px; }
    </style>
</head>
<body>
<div class="header">
    <div style="display: flex; align-items: center; justify-content: center; gap: 20px;">
        <img src="logo.png" alt="Logo" style="height: 80px; width: auto; object-fit: contain;">
        <div>
            <h1 style="margin: 0;">Задание 7 модуль 2</h1>
            <h2 style="margin: 0;">База данных сотрудников</h2>
        </div>
    </div>
</div>
    <table>
        <tr>
            <th>ФИО</th>
            <th>Отдел</th>
            <th>Действия</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="name" placeholder="ФИО" value="<?php echo $row['name']; ?>">
                    <input type="text" name="department" placeholder="Отдел" value="<?php echo $row['department']; ?>">
                    <button type="submit" name="update" class="btn">Обновить</button>
                    <button type="submit" name="delete" class="btn">Удалить</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="form-container">
        <form method="post">
            <input type="text" name="name" placeholder="ФИО" required>
            <input type="text" name="department" placeholder="Отдел" required>
            <button type="submit" name="add" class="add-btn">Добавить сотрудника</button>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>