<!DOCTYPE html PUBLIC "-//W3C//DTD XHTNL 1.0 Transitional"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Aliens Abducted Me - Report an Abduction</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <h2>Aliens Abducted Me - Report an Abduction</h2>

        <div>
            <?php
                require_once 'scripts/connectvars.php';

                if (isset($_POST['submit'])) {
                    $dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
                            or die ('Could not connect to the database server ' . mysqli_connect_error());

                    $first_name = $_POST['firstname'];
                    $last_name = $_POST['lastname'];
                    $when_it_happened = $_POST['whenithappened'];
                    $how_long = $_POST['howlong'];
                    $how_many = $_POST['howmany'];
                    $alien_description = $_POST['aliendescription'];
                    $what_they_did = $_POST['whattheydid'];
                    $fang_spotted = $_POST['fangspotted'];
                    $other = $_POST['other'];
                    $email = $_POST['email'];

                    if (!empty($first_name) && 
                        !empty($last_name) && 
                        !empty($when_it_happened) && 
                        !empty($how_long) && 
                        !empty($what_they_did)) {

                        $query = "INSERT INTO aliens_abduction (first_name, last_name, when_it_happened, 
                                                                how_long, how_many, alien_description, 
                                                                what_they_did, fang_spotted, other, email) 
                                VALUES ('$first_name', '$last_name', '$when_it_happened', '$how_long', '$how_many',
                                        '$alien_description', '$what_they_did', '$fang_spotted', '$other', '$email')";

                        $result = $dbc->query($query)
                                    or die('Error querying database.');

                        echo '<p>Thanks for adding your abduction.</p>';
                        echo '<p><a href="index.php">&lt;&lt; Back to the home page</a></p>';
                        
                        $dbc->close();
                        exit();
                    }
                    else {
                        echo '<p class="error">
                                Please enter your full name, date of abduction, 
                                how long you were abducted, and a brief description of the aliens.
                            </p>';
                    }
                }
            ?>
            
            <div class="Container">
                <p>Share your story of alien abduction:</p>
                <input type="checkbox" name="" id="">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="firstname">First name:</label>
                    <input type="text" id="firstname" name="firstname" value="<?php echo $first_name ?? ''; ?>" /><br/><br/>
                    <label for="lastname">Last name:</label>
                    <input type="text" id="lastname" name="lastname" value="<?php echo $last_name ?? ''; ?>" /><br/><br/>
                    <label for="email">What is your email address:</label>
                    <input type="text" id="email" name="email" value="<?php echo $email ?? ''; ?>" /><br/><br/>
                    <label for="whenithappened">When did it happen?</label>
                    <input type="text" id="whenithappened" name="whenithappened" value="<?php echo $when_it_happened ?? ''; ?>" placeholder="YYYY-MM-DD" /><br/><br/>
                    <label for="howlong">How long were you gone?</label>
                    <input type="text" id="howlong" name="howlong" value="<?php echo $how_long ?? ''; ?>" /><br/><br/>
                    <label for="howmany">How many did you see?</label>
                    <input type="text" id="howmany" name="howmany" value="<?php echo $how_many ?? ''; ?>" /><br/><br/>
                    <label for="aliendescription">Describe them:</label>
                    <input type="text" id="aliendescription" name="aliendescription" size="32" value="<?php echo $alien_description ?? ''; ?>" /><br/><br/>
                    <label for="whattheydid">What did they do to you?</label>
                    <input type="text" id="whattheydid" name="whattheydid" size="32" value="<?php echo $what_they_did ?? ''; ?>" /><br/><br/>
                    <label for="fangspotted">Have you seen my dog Fang?</label>
                    Yes <input id="fangspotted" name="fangspotted" type="radio" value="yes" 
                            <?php if (!empty($fang_spotted)) echo ($fang_spotted == 'yes'? 'checked="checked"' : ''); ?> />
                    No <input id="fangspotted" name="fangspotted" type="radio" value="no" 
                            <?php if (!empty($fang_spotted)) echo ($fang_spotted == 'no'? 'checked="checked"' : ''); ?> /><br/><br/>

                    <img src="img/fang.jpg" width="200" height="350" alt="My abducted dog Fang." /><br/><br/>
                    <label for="other">Anything else you want to add?</label>
                    <textarea name="other" id="other" rows="5" cols="30">
                        <?php echo $other ?? ''; ?>
                    </textarea><br/><br/>
                    <input type="submit" value="Report Abduction" name="submit" />
                </form>
            </div>
        </div>
    </body>
</html>