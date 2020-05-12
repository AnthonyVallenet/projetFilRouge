<?php
ob_start();
?>
    <section id="admin">
        <p>Admin</p>

        <a href="#tags"><button class="btnToggle active tags">Tags</button></a>
        <a href="#contacts"><button class="btnToggle contacts">Contacts</button></a>
        <a href="#users"><button class="btnToggle users">Utilisateurs</button></a>

        <div class="toggleDiv tags">
            <p>Tags</p>
        </div>

        <div class="toggleDiv contacts" style="display: none">
            <p>Contacts</p>
            <?php
                foreach ($info["contacts"] as $contact) {
                    ?>
                        <div style="border: 2px solid black">
                            <p><?php echo escape($contact->getId()); ?></p>
                            <p><?php echo escape($contact->getFirstName()); ?></p>
                            <p><?php echo escape($contact->getLastName()); ?></p>
                            <p><?php echo escape($contact->getEmail()); ?></p>
                            <p><?php echo escape($contact->getSujet()); ?></p>
                            <p><?php echo escape($contact->getMessage()); ?></p>
                        </div>
                    <?php
                }
            ?>
        </div>

        <div class="toggleDiv users" style="display: none">
            <p>Utilisateurs</p>

            <div class="allUser toggleDivUser">
                <a href="#createUser"><button class="btnToggleUser">créer</button></a>
                <?php
                    foreach ($info["users"] as $user) {
                        ?>
                            <div style="border: 2px solid black">
                                <p><?php echo escape($user->getId()); ?></p>
                                <p><?php echo escape($user->getFirstName()); ?></p>
                                <p><?php echo escape($user->getLastName()); ?></p>
                                <p><?php echo escape($user->getEmail()); ?></p>
                                <p><?php echo escape($user->getCreatedAt()); ?></p>
                                <p><?php echo escape($user->getAdmin()); ?></p>
                            </div>
                        <?php
                    }
                ?>
            </div>

            <div class="formUser toggleDivUser" style="display: none">
                <a href="#users"><button class="btnToggleUser">all user</button></a>
                <form action="/administration/user/create" method="post">
                    <input type="text" name="firstName" id="firstName" value="<?php echo old("firstName");?>" placeholder="Prénom">
                    <label for="firstName"><i class="fas fa-user-tie"></i></label>
                    <?php echo error("firstName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("firstName") .'</span>' : ""?>

                    <input type="text" name="lastName" id="lastName" value="<?php echo old("lastName");?>" placeholder="Nom de famille">
                    <label for="lastName"><i class="fas fa-user-tie"></i></label> 
                    <?php echo error("lastName") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("lastName") .'</span>' : ""?>

                    <input type="email" id="email" name="email" value="<?php echo old("email");?>" placeholder="Mail">
                    <label for="email"><i class="fas fa-envelope"></i></label>
                    <?php echo error("email") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("email") .'</span>' : ""?>

                    <label for="inputPassword"><i class="fas fa-key"></i></label>
                    <input id="inputPassword" class="inputPassword" type="password" name="password" value="<?php echo old("password");?>" placeholder="Mot de passe">
                    <button id="btnPassword" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
                    <?php echo error("password") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("password") .'</span>' : ""?>

                    <label for="inputPasswordConfirm"><i class="fas fa-key"></i></label>
                    <input id="inputPasswordConfirm" class="inputPassword" type="password" name="passwordConfirm" value="<?php echo old("passwordConfirm");?>" placeholder="Confirmation mot de passe">
                    <button id="btnPasswordConfirm" class="viewPassword" type="button" name="button"><i class="far fa-eye"></i></button>
                    <?php echo error("passwordConfirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("passwordConfirm") .'</span>' : ""?>
                    <?php echo error("confirm") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("confirm") .'</span>' : ""?>

                    <label for="roleSelect"><i class="fas fa-user-cog"></i></label>
                    <select name="roleSelect" id="roleSelect">
                        <option value="0">Utilisateur</option>
                        <option value="1">Administrateur</option>
                    </select>
                    <?php echo error("roleSelect") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("roleSelect") .'</span>' : ""?>

                    <button type="submit" name="button">Créer</button>
                </form>
            </div>
            
        </div>
        
    </section>

    <script>
        let btnToggle = document.querySelectorAll('.btnToggle');
        let divToggle = document.querySelectorAll('.toggleDiv');
        var url = document.location.href;
        var urlOrigin = document.location.origin;

        let btnToggleUser = document.querySelectorAll('.btnToggleUser');
        let toggleDivUser = document.querySelectorAll('.toggleDivUser');


        const clickToggle = (el, index) => {
            btnToggle.forEach(btn => {
                btn.classList.remove('active');
            })
            divToggle.forEach(div => {
                div.style.display = "none";
            })
            el.classList.add('active');
            divToggle[index].style.display = "block";
        }
        btnToggle.forEach((btn,index) => {
            btn.addEventListener('click',(e) => {
                
                clickToggle(e.currentTarget, index);
            });
        })

        const toggleUser = (el, index) => {
            toggleDivUser.forEach(div => {
                div.style.display = "block";
            })
            toggleDivUser[index].style.display = "none";
        }
        btnToggleUser.forEach((btn,index) => {
            btn.addEventListener('click',(e) => {
                
                toggleUser(e.currentTarget, index);
            });
        })

        if ((url === urlOrigin + "/administration/#tags") || (url === urlOrigin + "/administration#tags")) {
            let index = 0;
            
            btnToggle.forEach(btn => {
                btn.classList.remove('active');
            })
            divToggle.forEach(div => {
                div.style.display = "none";
            })

            btnToggle[index].classList.add('active');
            divToggle[index].style.display = "block";
        } else if ((url === urlOrigin + "/administration/#contacts") || (url === urlOrigin + "/administration#contacts")) {
            let index = 1;
            
            btnToggle.forEach(btn => {
                btn.classList.remove('active');
            })
            divToggle.forEach(div => {
                div.style.display = "none";
            })

            btnToggle[index].classList.add('active');
            divToggle[index].style.display = "block";
        } else if ((url === urlOrigin + "/administration/#users") || (url === urlOrigin + "/administration#users")) {
            let index = 2;
            
            btnToggle.forEach(btn => {
                btn.classList.remove('active');
            })
            divToggle.forEach(div => {
                div.style.display = "none";
            })

            btnToggle[index].classList.add('active');
            divToggle[index].style.display = "block";
        } else if ((url === urlOrigin + "/administration/#createUser") || (url === urlOrigin + "/administration#createUser")) {
            let index = 2;
            
            btnToggle.forEach(btn => {
                btn.classList.remove('active');
            })
            divToggle.forEach(div => {
                div.style.display = "none";
            })
            toggleDivUser.forEach(div => {
                div.style.display = "block";
            })

            btnToggle[index].classList.add('active');
            divToggle[index].style.display = "block";
            toggleDivUser[0].style.display = "none";
        }



        var btnPass = document.getElementById("btnPassword");
        var inputPass = document.getElementById("inputPassword");
        btnPass.onclick = function() {
            if (inputPass.type === "password") {
                inputPass.type = "text";
            } else {
                inputPass.type = "password";
            }
        };

        var btnPassConf = document.getElementById("btnPasswordConfirm");
        var inputPassConf = document.getElementById("inputPasswordConfirm");
        btnPassConf.onclick = function() {
            if (inputPassConf.type === "password") {
                inputPassConf.type = "text";
            } else {
                inputPassConf.type = "password";
            }
        };

    </script>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';