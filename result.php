<?php

// Start the session to access the search results
session_start();

// Display the search results

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the title and content of each matching record
        echo "<h2>".$row["Country"]."</h2>";
        echo "<p>".$row["content"]."</p>";
        
    }
} else {
    // Display a message if no matching records were found
    echo "No results found.";
}


// Clear the search results from the session
unset($_SESSION['result']);

?>
