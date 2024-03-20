<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV File Upload and Display</title>
</head>
<body>
    <h2>Upload a CSV File</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".csv" required>
        <button type="submit" name="submit">Upload</button>
    </form>

    <?php
    // Set maximum execution time and file upload size
    ini_set('max_execution_time', 300); // 300 seconds (5 minutes)
    ini_set('upload_max_filesize', '10M'); // 10 MB

    if(isset($_POST['submit'])) {
        // Check if file is uploaded successfully
        if ($_FILES['file']['error'] == 0) {
            $file = $_FILES['file']['tmp_name'];
            
            // Read CSV file with a buffer size limit
            if (($handle = fopen($file, "r")) !== FALSE) {
                echo "<h2>CSV File Data</h2>";
                echo "<table border='1'>";
                // Read each row
                while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) { // Increased buffer size
                    echo "<tr>";
                    foreach ($data as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                fclose($handle);
            } else {
                echo "<p>Error opening CSV file</p>";
            }
        } else {
            echo "<p>Error uploading file</p>";
        }
    }
    ?>
</body>
</html>
