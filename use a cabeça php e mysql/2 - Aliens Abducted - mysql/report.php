<!DOCTYPE html PUBLIC "-//W3C//DTD XHTNL 1.0 Transitional"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Aliens Abducted Me - Report an Abduction</title>
    </head>

    <body>
        <h2>Aliens Abducted Me - Report an Abduction</h2>

        <div>
            <?php
            
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $dbname = 'aliendatabase';

                $dbc = new mysqli($host, $user, $password, $dbname) 
                         or die ('Could not connect to the database server ' . mysqli_connect_error());

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $when_it_happened = $_POST['whenithappened'];
                $how_long = $_POST['howlong'];
                $how_many = $_POST['howmany'];
                $alien_description = $_POST['aliendescription'];
                $what_they_did = $_POST['whattheydid'];
                $fang_spotted = $_POST['fangspotted'];
                $other = $_POST['other'];
                $email = $_POST['email'];

                if ($fang_spotted === 'yes') {

                    $query = "INSERT INTO aliens_abduction (first_name, last_name, when_it_happened, 
                                                            how_long, how_many, alien_description, 
                                                            what_they_did, fang_spotted, other, email) 
                            VALUES ('$firstname', '$lastname', '$when_it_happened', '$how_long', '$how_many',
                                    '$alien_description', '$what_they_did', '$fang_spotted', '$other', '$email')";

                    $result = $dbc->query($query)
                                or die('Error querying database.');
                }

                $dbc->close();

                echo 'Thanks for submitting the form.<br/>';
                echo 'You were abducted ' . $when_it_happened;
                echo ' and were gone for ' . $how_long . '<br/>';
                echo 'Number of aliens: ' . $how_many . '<br/>';
                echo 'Describe them: ' . $alien_description . '<br/>';
                echo 'The aliens did this: ' . $what_they_did . '<br/>';
                echo 'Was Fang there? ' . $fang_spotted . '<br/>';
                echo 'Other comments: ' . $other . '<br/>';
                echo 'Your email address is ' . $email;

            ?>
        </div>
    </body>
</html>