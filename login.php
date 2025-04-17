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
    <title>login</title>
</head>
<body>
    <i id="moon" class="fa-solid fa-moon"></i>
    <i id="sun" class="fa-solid fa-sun active"></i>
    <?php 
    session_start();
    if(isset($_SESSION["matricule"]))
        header("location:index.php");
    ?>
    <main>
        <div class="container">
            <div class="containerform">
                <form id="1" action="php/process.php" method="post" >
                    <input type="hidden" name="target" value="login">
                    <div class="logo">
                        <a href="#"><img src="picts/newlogo.svg" alt="LOGO"></a>
                    </div>
                    <span class="kite">Login to Zed</span>
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
                        <div class="matriculedata">
                            <input id="password" type="password" name="password" placeholder="Password" required>
                            <i class="fa-solid fa-eye-slash" id="show"></i>
                            <label for="matricule">Password:</label>
                        </div>
                        
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="rememberme" id="rememberme">
                        <label for="rememberme">Remember me</label>
                    </div>
                    <input type="submit" name="submit" value="Login">
                    <div class="forgot" ><a  href="signup.php">Don't have an account? <span>Signup<span></a></div>
                    
                </form>
            </div>
            <div class="contacts">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></i></a>
            </div>
        </div>
    </main>
    <script src="js/login.js"></script>
</body>
</html>