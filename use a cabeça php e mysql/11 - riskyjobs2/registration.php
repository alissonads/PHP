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
                $empty = false;
                $invalid_phone = false;
                $invalid_email = false;

                if (empty($first_name)) {
                    // $first_name está em branco
                    $output_form = true;
                    $empty = true;
                }

                if (empty($last_name)) {
                    // $last_name está em branco
                    $output_form = true;
                    $empty = true;
                }

                if (empty($email)) {
                    // $email está em branco
                    $output_form = true;
                    $empty = true;
                }
                //elseif (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@[a-zA-Z0-9]+\.[a-z]{2}[a-z]?\.?[a-z]{2}?[a-z]?$/', $email)) {
                elseif (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
                    // $email inválido
                    $output_form = true;
                    $invalid_email = true;
                }
                else {
                    // retira tudo do email, exceto o domínio.
                    $domain = preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', '', $email);
                    // verifica o dominio no Unix/Linux
                    //if (!checkdnsrr($domain)) {
                    //inclui um script para verificação do dominio no windows
                    require_once 'scripts/util.php';
                    //verifica se $domain está registrado
                    if (!win_checkdnsrr($domain)) {
                        $output_form = true;
                        $invalid_email = true;
                    }
                }

                if (empty($phone)) {
                    // $phone está em branco
                    $output_form = true;
                    $empty = true;
                }
                elseif (!preg_match('/^\(?[1-9]\d\)?[-\s]\d?\d{4}-\d{4}$/', $phone)){
                    // $phone inválido
                    $output_form = true;
                    $invalid_phone = true;
                }
                else {
                    $new_phone = preg_replace('/[\(\)\-\s]/', '', $phone);
                }

                if (empty($job)) {
                    // $job está em branco
                    $output_form = true;
                    $empty = true;
                }

                if (empty($resume)) {
                    // $resume está em branco
                    $output_form = true;
                    $empty = true;
                }
            }
            else {
                $output_form = true;
                $empty = false;
                $invalid_phone = false;
                $invalid_email = false;
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
                        <input class="data" <?php if ($empty && empty($first_name)) echo 'style="border-color: #f00;"'; ?>
                            type="text" name="firstname" id="firstname" placeholder="Your first name" value="<?php echo $first_name ?? ''; ?>"/>    
                        <?php
                            if ($empty && empty($first_name)) echo '<label class="empty">You forgot to enter your first name.</label>';
                        ?>
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--last name-->
                    <div class="cont_desc">
                        <label for="lastname">Last Name: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" <?php if ($empty && empty($last_name)) echo 'style="border-color: #f00;"'; ?> 
                            type="text" name="lastname" id="lastname" placeholder="Your last name" value="<?php echo $last_name ?? '';?>" />    
                        <?php
                            if ($empty && empty($last_name)) echo '<label class="empty">You forgot to enter your last name.</label>';
                        ?>
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--email-->
                    <div class="cont_desc">
                        <label for="email">Email: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" <?php if ($empty && empty($email)) echo 'style="border-color: #f00;"'; ?>
                            type="text" name="email" id="email" placeholder="your e-mail" value="<?php echo $email ?? '';?>" />    
                        <?php
                            if ($empty && empty($email)) echo '<label class="empty">You forgot to enter your email address.</label>';
                            elseif ($invalid_email) echo '<label class="empty">Your email address is invalid.</label>';
                        ?>
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--phone-->
                    <div class="cont_desc">
                        <label for="phone">Phone: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" <?php if ($empty && empty($phone)) echo 'style="border-color: #f00;"'; ?>
                            type="text" name="phone" id="phone" placeholder="(xx) xxxxx-xxxx or xx-xxxx-xxxx" value="<?php echo $phone ?? '';?>" />    
                        <?php
                            if ($empty && empty($phone))  echo '<label class="empty">You forgot to enter your phone number.</label>';
                            elseif ($invalid_phone) echo '<label class="empty">Your phone number is invalid.</label>';
                        ?>
                    </div>
                </div>
                <!--line-->
                <div class="line">
                    <!--job-->
                    <div class="cont_desc">
                        <label for="job">Desired Job: </label>
                    </div>
                    <div class="cont_data">
                        <input class="data" <?php if ($empty && empty($job)) echo 'style="border-color: #f00;"'; ?>
                            type="text" name="job" id="job" placeholder="Your desired Job" value="<?php echo $job ?? '';?>" />    
                        <?php
                            if ($empty && empty($job)) echo '<label class="empty">You forgot to enter your phone number.</label>';
                        ?>
                    </div>
                </div>
                <div style="width: 100%; border: 1px solid rgba(0, 0, 0, 0.13);"></div>

                <!--resume-->
                <div style="padding-right: 2rem; margin-top: 1rem;">
                    <div class="line" style="margin-bottom: 0px !important;">
                        <div class="cont_desc" style="width:100%; margin-bottom:0px !important;"><label for="resume">Paste your resume here:</label></div>
                    </div>
                    <textarea class="resume" <?php if ($empty && empty($resume)) echo 'style="border-color: #f00;"'; ?>
                        name="resume" id="resume" cols="40" rows="4"
                        placeholder="your resume">
                        <?php echo $resume ?? ''; ?>
                    </textarea><br/>
                    <?php
                        if ($empty && empty($resume)) echo '<label class="empty">You forgot to enter your resume.</label>';
                    ?>
                    <div class="line" style="/*padding-left: 7rem;*/ justify-content: center;">
                        <div style="width:50%; opacity:.9;">
                            <input class="btn" type="submit" name="submit" value="Submit" />
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php 
            }
            elseif (!$output_form) {
                echo "<p>$first_name $last_name, thanks for registering with Risky Jobs!</p>";
            }
        ?>

    </body>
</html>