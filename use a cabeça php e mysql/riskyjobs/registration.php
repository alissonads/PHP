<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Risky Jobs - Registration</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <img src="img/riskyjobs_title.gif" alt="Risky Jobs" />
        <img src="img/riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />

        <h3>Risky Jobs - Registration</h3>

        <?php
            if (isset($_POST['submit'])) {
                $first_name = $_POST['firstname'];
                $last_name = $_POST['lastname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $job = $_POST['job'];
                $resume = $_POST['resume'];
                $output_form = false;

                if (empty($first_name)) {
                    // $first_name está em branco
                    echo '<p class="error">You forgot to enter your first name.</p>';
                    $output_form = true;
                }

                if (empty($last_name)) {
                    // $last_name está em branco
                    echo '<p class="error">You forgot to enter your last name.</p>';
                    $output_form = true;
                }

                if (empty($email)) {
                    // $email está em branco
                    echo '<p class="error">You forgot to enter your email address.</p>';
                    $output_form = true;
                }

                if (empty($phone)) {
                    // $phone está em branco
                    echo '<p class="error">You forgot to enter your phone number.</p>';
                    $output_form = true;
                }

                if (empty($job)) {
                    // $job está em branco
                    echo '<p class="error">You forgot to enter your phone number.</p>';
                    $output_form = true;
                }

                if (empty($resume)) {
                    // $resume está em branco
                    echo '<p class="error">You forgot to enter your resume.</p>';
                    $output_form = true;
                }
            }
            else {
                $output_form = true;
            }

            if ($output_form) {
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>Register with Risky Jobs, and post your resume.</p>
            <div class="container">
                <!--line-->
                <div class="line">
                    <!--firs tname-->
                    <div class="cont_desc">
                        <label for="firstname">First Name: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" type="text" name="firstname" id="firstname"/>    
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--last name-->
                    <div class="cont_desc">
                        <label for="lastname">Last Name: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" type="text" name="lastname" id="lastname" />    
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--email-->
                    <div class="cont_desc">
                        <label for="email">Email: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" type="text" name="email" id="email" />    
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--phone-->
                    <div class="cont_desc">
                        <label for="phone">Phone: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" type="text" name="phone" id="phone" />    
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--job-->
                    <div class="cont_desc">
                        <label for="job">Desired Job: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" type="text" name="job" id="job" />    
                    </div>
                </div>
                <div style="width: 100%; border: 1px solid rgba(0, 0, 0, 0.13);"></div>

                <!--resume-->
                <div>
                    <p>
                        <div class="line">
                            <div class="cont_desc" style="width:100%; margin-bottom:0px !important;"><label for="resume">Paste your resume here:</label></div>
                        </div>
                        <textarea name="resume" id="resume" cols="40" rows="4">
                            <?php echo $resume; ?>
                        </textarea><br/>
                        <div class="line">
                            <div class="cont_data">
                                <input type="submit" name="submit" value="Submit" />
                            </div>
                        </div>
                    </p>
                </div>
            </div>
        </form>

        <?php } ?>
    </body>
</html>