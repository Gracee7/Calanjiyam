<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'customers');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT firstName, lastName, address, email, requesttype FROM customers";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="navbar-brand">CRM</a>
            <div class="navbar-menu">
                <a href="index.html">Home</a>
                <a href="service_request.html">Service Request</a>
                <a href="login.html">Login</a>
                <a href="signup.html">Signup</a>
                <a href="dashboard.html">Dashboards</a>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <h2>Service Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Request Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                                <td><?php echo htmlspecialchars($row['lastName']); ?></td>
                                <td><?php echo htmlspecialchars($row['address']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['requesttype']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 CRM. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
