<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Projet fil rouge Groupe1" />
        <title>Projet Fil Rouge</title>
        <link rel="stylesheet" href="/css/style.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/726b142b0a.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    </head>
    <body onload="checkCookie()">
        <nav id="nav" class="close">
            <div>
                <a href="/"><img src="/image/eodenLogo.png" alt="Logo EODEN"></a>

                <div id="burger">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
            <div class="navSlide">
                <?php
                if (!isset($_SESSION["user"])) {
                    ?>
                        <a href="/">
                            <i class="icon fas fa-home"></i>
                            <p>Accueil</p>
                        </a>

                        <a href="/articles">
                            <i class="icon far fa-newspaper"></i>
                            <p>Articles</p>
                        </a>

                        <a href="/contact">
                            <i class="icon fas fa-address-book"></i>
                            <p>Contact</p>
                        </a>
                    <?php
                } else {
                    ?>
                        <a href="/">
                            <i class="icon fas fa-home"></i>
                            <p>Accueil</p>
                        </a>

                        <a href="/articles">
                            <i class="icon far fa-newspaper"></i>
                            <p>Articles</p>
                        </a>

                        <a href="/contact">
                            <i class="icon fas fa-address-book"></i>
                            <p>Contact</p>
                        </a>
                    <?php
                }
                ?>
            </div>

            <button id="buttonNav">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div>
            <?php
                if (!isset($_SESSION["user"])) {
                    ?>
                        <a href="/login">
                            <i class="icon fas fa-user"></i>
                            <p>Login</p>
                        </a>
                    <?php
                } else {
                    if ($_SESSION["user"]["admin"] == 1) {
                        ?>
                            <a href="/administration">
                                <i class="icon fas fa-user-cog"></i>
                                <p>Administration</p>
                            </a>

                            <a href="/article/create">
                                <i class="icon fas fa-plus-circle"></i>
                                <p>Création</p>
                            </a>
                        <?php
                    }
                    ?>
                        <a href="/logout">
                            <i class="icon fas fa-user-slash"></i>
                            <p>Déconnexion</p>
                        </a>
                    <?php
                }
                ?>
            </div>
        </nav>

        <main id="main" class="close">
            <?php echo $content; ?>
        </main>

        <footer id="footer" class="close">
            <a href="">
                <img src="/image/logo_edenSchool.png" alt="Logo Eden School">
                Ce site a été réalisé par les élèves d'EDEN School
            </a>
        </footer>
    </body>
    <script>
        var nav = document.getElementById("nav");
        var main = document.getElementById("main");
        var footer = document.getElementById("footer");
        var buttonNav = document.getElementById("buttonNav");
        var burger = document.getElementById("burger");

        function setCookie(cname,cvalue,exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            var navCookie = getCookie("navCookie");
            if (navCookie == "close") {
                nav.classList.add("close");
                main.classList.add("close");
                footer.classList.add("close");
            } else if (navCookie == "") {
                nav.classList.remove("close");
                main.classList.remove("close");
                footer.classList.remove("close");
            }
        }

        if (document.cookie.indexOf("navCookie") == -1) {
            setCookie("navCookie", "close", 30);
		}

        buttonNav.onclick = function() {
            nav.classList.toggle("close");
            main.classList.toggle("close");
            footer.classList.toggle("close");
            burger.classList.toggle("change");
            var navCookie = nav.classList;
            setCookie("navCookie", navCookie, 30);
        };

        burger.onclick = function() {
            burger.classList.toggle("change");
            nav.classList.toggle("close");
        };

    </script>
</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
