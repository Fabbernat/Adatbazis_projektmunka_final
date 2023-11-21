<?php
include_once "misc/navbar.php";
include_once "misc/connect_to_database[[maybe_deprecated]].php";
$databaseConnection = new ConnectToDatabase();

// Use the getter method to retrieve data
$conn = $databaseConnection->getConn();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticket_id = $_POST["ticket_id"];
    $station = $_POST["station"];
    $price = $_POST["price"];
    $available_quantity = $_POST["available_quantity"];

    // Insert data into the database
    $sql = "INSERT INTO jegyek (azonosito, helyazonosito, ar, elerheto_darab) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $ticket_id, $station, $price, $available_quantity);

    if ($stmt->execute()) {
        echo "Jegy sikeresen felvéve!";
    } else {
        echo "Hiba a jegy felvitele során: " . $stmt->error;
    }

    $stmt->close();
}

// Database connection close
$conn->close();
