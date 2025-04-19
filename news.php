<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="picts/newlogo.svg" type="image/x-icon">
    <link rel="stylesheet" href="libs/bootstrapv5/bootstrap.min.css">
    <link href="css/normalize.css" rel="stylesheet" />
    <link href="css/all.min.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/global2.css" rel="stylesheet" />
    <link href="css/header.css" rel="stylesheet" />
    <link href="css/news.css" rel="stylesheet" />

</head>

<body>
    <header>
        <div class="container">
            <a href="home.php" class="logo"><img src="picts/departement/logo1removed.png" alt=""></a>
            <div class="wrapper">
                <nav>
                    <a href="home.php">Home</a>
                    <a href="news.php">News</a>
                    <a href="events.php">Announcements</a>
                    <a href="space.php">Student Space</a>
                </nav>
                <div class="userCard">
                    <i class="fa-solid fa-user-graduate"></i>
                    <div class="userCords">
                        <p>Welcome</p>
                        <span>Gouffi mohamed ryad</span>
                    </div>
                    <a class="logout" href="php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h2>NEWS</h2>
        <div class="container">
            <div class="news">
                <div class="postNews">
                    <div class="info">
                        <img src="picts/person.png"  alt="" class="pfp">
                        <input type="text" value="Post something...">
                        <textarea name="postDesctiption" ></textarea>
                        <i class="fa-regular fa-paper-plane"></i>
                    </div>
                </div>
                <div class="newsCard" id="01">
                    <div class="info">
                        <img src="picts/person.png" alt="" class="pfp">
                        <div class="wrapper">
                            <span class="author">yahiatene youcef</span>
                            <span class="date">Mar 4</span>
                        </div>
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>

                    <p class="description">Salem
                        Saha Ramdhankoum
                        La consultation des copies d'examens est programmé demain matin (05/02/2025) à 9H30 bloc 4 RDC
                    </p>
                </div>
                <div class="newsCard" id="01">
                    <div class="info">
                        <span class="pfp"></span>
                        <div class="wrapper">
                            <span class="author">yahiatene youcef</span>
                            <span class="date">Mar 4</span>
                        </div>
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>

                    <p class="description">Bonsoir,
Voici le détail de vos notes de contrôle continu (CC) :

    Mini-projet : /20
    CC : /10
    Moyenne : (mini-projet + 2 × CC) / 2

Seuls les étudiants qui n'ont pas passé le deuxième contrôle continu et qui ont fourni une justification auront le droit de passer un test de remplacement après les examens.</p>
                </div>
                <div class="newsCard" id="01">
                    <div class="info">
                        <span class="pfp"></span>
                        <div class="wrapper">
                            <span class="author">yahiatene youcef</span>
                            <span class="date">Mar 4</span>
                        </div>
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>

                    <p class="description">Salem.
Pour le cours et les TP cette semaine et la prochaine je serai absent.
On vas récupérer ses séances.</p>
                </div>
            </div>
        </div>
    </main>

</body>