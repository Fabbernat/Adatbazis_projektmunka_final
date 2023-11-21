<?php
include_once "misc/navbar.php";
include_once "misc/connect_to_database[[maybe_deprecated]].php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticket_id = $_POST["ticket_id"];

    // Check if the user has the necessary privileges to delete the ticket
    // You can implement an access control mechanism here (e.g., check admin privileges)

    // Delete the ticket
    $sql = "DELETE FROM jegyek WHERE azonosito = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ticket_id);

    if ($stmt->execute()) {
        echo "A jegy sikeresen törölve!";
    } else {
        echo "Hiba a jegy törlése során: " . $stmt->error;
    }

    $stmt->close();
}

// Database connection close
$conn->close();