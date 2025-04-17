<?php 
    session_start();
    if(isset($_SESSION["matricule"]))
        header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="picts/newlogo.svg" type="image/x-icon">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet" />
    <title>signup</title>
</head>
<body>
    <i id="moon" class="fa-solid fa-moon"></i>
    <i id="sun" class="fa-solid fa-sun active"></i>
    <main>
        <div class="container">
            <div class="containerform">
                <form  class="sign-up" id="1" action="php/process.php" method="post" >
                    <input type="hidden" name="target" value="sign-up">
                    <div class="logo">
                        <a href="#"><img src="picts/newlogo.svg" alt="LOGO"></a>
                    </div>
                    <span class="kite">Sign-up to Zed</span>
                    <?php 
                        if(isset($_SESSION['Error'])){
                            echo "<span id='error-span'>$_SESSION[Error]</span>";
                            unset($_SESSION["Error"]); 
                        }
                    ?>
                    <div class="data">
                        <div class="matriculedata">
                            <input type="text" name ="matricule" id="matricule" placeholder="Matricule" required>
                            <label for="matricule">Matricule:</label>
                        </div>
                        <input type="hidden" name="styear" id="dropdownval">
                        <div class="dropdown">
                            <div class="select">
                                <span>Study Year</span>
                                <div class="arrow"></div>
                            </div>
                            <ul class="">
                                <li class="active" data-val="1">L1</li>
                                <li data-val="2" >L2</li>
                                <li data-val="3">L3</li>
                                <li data-val="4">M1</li>
                                <li data-val="5">M2</li>
                            </ul>
                        </div>
                        <div class="matriculedata elon-musk">
                            <div class="matriculedata">
                                <input type="text" name ="susername" id="susername" placeholder="Name" required>
                                <label for="matricule">Name:</label>
                            </div>
                            <div class="matriculedata elon-musk-IQ">
                                <input type="text" name ="surname" id="surname" placeholder="Surname" required>
                                <label for="matricule">Surname:</label>
                            </div>
                        </div>

                        <div class="matriculedata">
                            <input id="password" type="password" name="password" placeholder="Password" required>
                            <i class="fa-solid fa-eye-slash" id="show"></i>
                            <label for="matricule">Password:</label>
                        </div>
                        <div class="matriculedata">
                            <input id="password" type="password" name="confirm-password" placeholder="Confirm password" required>
                            <label for="matricule">Confirm password:</label>
                        </div>
                        
                    </div>
                    <input type="submit" name="submit" value="Sign up">
                    <div class="forgot" ><a  href="login.php">Already have account?</a></div>
                    
                </form>
            </div>
        </div>
    </main>
    <script src="js/login.js"></script>
    <script src="js/signup.js"></script>
</body>
</html>