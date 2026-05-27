<!DOCTYPE html>
<html lan="en">
    <head>
        <meta charset="UTF-8" />
        <title>Form Response</title>
        <link rel="stylesheet" href="index-style.css"/>
    </head>

    <body>
        <div id="header">
            <h1>Alessia Couchond<h1>
        </div>

        <div id="main-content">
            <div class="section">

                <?php
                    $name = isset($_POST["name"]) ? $_POST["name"] : '';
                    $email = isset($_POST["email"]) ? $_POST["email"] : '';
                    $message = isset($_POST["message"]) ? $_POST["message"] : '';

                    $errors = [];

                    if (empty($name)) {
                        $errors[] = "Name is required.";
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Email format is not valid.";
                    }

                    if (empty($message)) {
                        $errors[] = "Message is required.";
                    } 
                    
                    if (count($errors) > 0) {
                        echo "<h2>Oops! Please fix the following:</h2>";
                        echo "<ul>";
                        foreach ($errors as $error) {
                            echo "<li>" . $error . "</li>";
                        }
                        echo "</ul>";
                        echo "<a href='index.php'>Go back to the form</a>";
                    } else {
                        $safeName = htmlspecialchars($name);
                        $safeEmail = htmlspecialchars($email);
                        $safeMessage = htmlspecialchars($message);

                        echo "<h2>Thank you, " . $safeName . "! </h2>";
                        echo "<p>Your message has been received.</p>";
                        echo "<p><strong>Name:</strong>" . $safeName . "</p>";
                        echo "<p><strong>Email:</strong>" . $safeEmail . "</p>";
                        echo "<p><strong>Message:</strong>" . $safeMessage . "</p>";
                        echo "<br>";
                        echo "<a href='index.php'>Back to homepage</a>";
                    }
                ?>
            </div>
        </div>

    </body>
</html>