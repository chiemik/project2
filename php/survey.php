
            <section class="travel-guests">

            <?php
            
            $servername = getenv('chiemi-cloned-chiemik.c9users.io');
            $username = 'chiemik';
            $password = "";
            $database = "c9";
            $dbport = 3306;
            $dbname = "surveydata";
            
            // Create an object that will hold the variables above for evaluation.
            $db = new mysqli($servername, $username, $password, $database, $dbport);
            
            // Check the connection using an if conditional and the echo and die methods.
            if ($db->connect_error) {
                die("Connection Failed: " . $db->connect_error);
            }
            
            echo ("Connected Successfully: " . $db->host_info);
            
            mysqli_select_db($db, $dbname);
            
                        // Create a Table inside of the database called "TravelGuests" if one does not already exist.
                  if (empty($result)) {
                $sql = "CREATE TABLE TravelGuests(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    placetogo VARCHAR(30),
                    region VARCHAR(30),
                    purpose VARCHAR(30),
                    period VARCHAR(30),
                    companion VARCHAR(30)
                    )";  
                    
            if ($db->query($sql) === TRUE) {
                print_r("<br>Table TravelGuests was created successfully.");
            } else {
                print_r("<br>There was an error creating the table: " . $db->error);
            }
                    
            }
            
            // Escape the user's input from the form for security purposes. This will prevent users from entering false information in order to gain access to our database.
            $placetogo = $_POST['PlacetoGo'];
            $region = $_POST['Region'];
            $purpose = $_POST['Purpose'];
            $period = $_POST['Period'];
            $companion = $_POST['Companion'];
            
            // Insert the user's input into the database's table using a SQL query.
            $travel_insert = "INSERT INTO TravelGuests (placetogo, region, purpose, period, companion) VALUES ('$placetogo', '$region', '$purpose', '$period', '$companion')";
            
            // Check to make sure user inputs were stored into the database table correctly.
            if (mysqli_query($db, $travel_insert)) {
                print_r("<br>Record added successfully.");
            } else {
                print_r("<br>Error: " . mysqli_error($db));
            }
            
            print_r("<h1>Our Current result</h1>");
            
            // Locate and pull data from the TravelGuests Table inside of the storedata database.
            $sql = "SELECT id, placetogo, region, purpose, period, companion FROM TravelGuests";
            $travelresult = $db->query($sql);
            
            // Check to make sure $travelresult is not empty. If it is not empty, then display the guest information.
            if ($travelresult->num_rows > 0) {
                
                while ($row = $travelresult->fetch_assoc()) {
                echo "ID: " . $row["id"] . "<br>question 1: " . $row["placetogo"] . "<br>question 2: " . $row["region"] . "<br>question3: " . $row["purpose"] . "<br>question4: " . $row["period"] .   "<br>question5: " . $row["companion"] .  "<br><br>";
                }
                
            } else {
                print_r("<br>No results to display.");
            }
            
            // Closes the database connection when are done working on it.
            $db->close();
            ?>

            <a href="../index.html">Back to Form</a>
       </section>
        <script src="../js/main.js"></script>
    </body>
</html>
            
            
            
            

