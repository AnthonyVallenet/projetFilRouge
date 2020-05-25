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
            <form action="/administration/tag/create" method="post">
                <label for="name"><i class="fas fa-user-tie"></i></label>
                <input type="text" name="name" id="name" value="<?php echo old("name");?>" placeholder="Name">
                <?php echo error("name") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("name") .'</span>' : ""?>

                <label for="color"><i class="fas fa-palette"></i></label>
                <input type="color" id="color" name="color" value="<?php echo old("color");?>">
                <?php echo error("color") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("color") .'</span>' : ""?>

                <button type="submit" name="button">Créer</button>
            </form>
            
            <?php
                foreach ($info["tags"] as $tag) {
                    ?>
                        <div style="border: 2px solid black">
                            <p><?php echo escape($tag->getId()); ?></p>

                            <form action="/administration/tag/edit/<?php echo escape($tag->getId()); ?>" method="post">
                                <input type="text" name="nameEditTag-<?php echo escape($tag->getId()); ?>" id="nameEditTag-<?php echo escape($tag->getId()); ?>" value="<?php echo old("nameEditTag-" . escape($tag->getId())) ?: escape($tag->getName()); ?>" placeholder="Name">
                                <?php echo error("nameEditTag-" . escape($tag->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("nameEditTag-" . escape($tag->getId())) .'</span>' : ""?>

                                <input type="color" name="colorEditTag-<?php echo escape($tag->getId()); ?>" id="colorEditTag-<?php echo escape($tag->getId()); ?>" value="<?php echo old("colorEditTag-" . escape($tag->getId())) ?: escape($tag->getColor()); ?>">
                                <?php echo error("colorEditTag-" . escape($tag->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("colorEditTag-" . escape($tag->getId())) .'</span>' : ""?>

                                <?php echo error("messageErrorEditTag-" . escape($tag->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("messageEditTag-" . escape($tag->getId())) .'</span>' : ""?>

                                <button type="submit" name="button">Editer</button>
                            </form>
                            <form action="/administration/tag/delete/<?php echo escape($tag->getId()); ?>" method="post">
                                <button type="submit" name="button">delete</button>
                            </form>
                        </div>
                    <?php
                }
            ?>
        </div>

        <div class="toggleDiv contacts" style="display: none">
            <p>Contacts</p>
            <?php
                foreach ($info["contacts"] as $contact) {
                    ?>
                        <div style="border: 2px solid black">
                            <p><?php echo escape($contact->getId()); ?></p>

                            <form action="/administration/contact/edit/<?php echo escape($contact->getId()); ?>" method="post">
                                <label for="firstNameEditContact-<?php echo escape($contact->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                <input type="text" name="firstNameEditContact-<?php echo escape($contact->getId()); ?>" id="firstNameEditContact-<?php echo escape($contact->getId()); ?>" value="<?php echo old("firstNameEditContact-" . escape($contact->getId())) ?: escape($contact->getFirstName()); ?>" placeholder="Prénom">
                                <?php echo error("firstNameEditContact-" . escape($contact->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("firstNameEditContact-" . escape($contact->getId())) .'</span>' : ""?>

                                <label for="lastNameEditContact-<?php echo escape($contact->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                <input type="text" name="lastNameEditContact-<?php echo escape($contact->getId()); ?>" id="lastNameEditContact-<?php echo escape($contact->getId()); ?>" value="<?php echo old("lastNameEditContact-" . escape($contact->getId())) ?: escape($contact->getLastName()); ?>" placeholder="Name">
                                <?php echo error("lastNameEditContact-" . escape($contact->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("lastNameEditContact-" . escape($contact->getId())) .'</span>' : ""?>

                                <label for="emailEditContact-<?php echo escape($contact->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                <input type="email" name="emailEditContact-<?php echo escape($contact->getId()); ?>" id="emailEditContact-<?php echo escape($contact->getId()); ?>" value="<?php echo old("emailEditContact-" . escape($contact->getId())) ?: escape($contact->getEmail()); ?>" placeholder="Email">
                                <?php echo error("emailEditContact-" . escape($contact->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("emailEditContact-" . escape($contact->getId())) .'</span>' : ""?>

                                <label for="subjectEditContact-<?php echo escape($contact->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                <input type="text" name="subjectEditContact-<?php echo escape($contact->getId()); ?>" id="subjectEditContact-<?php echo escape($contact->getId()); ?>" value="<?php echo old("subjectEditContact-" . escape($contact->getId())) ?: escape($contact->getSubject()); ?>" placeholder="Sujet">
                                <?php echo error("subjectEditContact-" . escape($contact->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("subjectEditContact-" . escape($contact->getId())) .'</span>' : ""?>

                                <label for="messageEditContact-<?php echo escape($contact->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                <textarea name="messageEditContact-<?php echo escape($contact->getId()); ?>" id="messageEditContact-<?php echo escape($contact->getId()); ?>" cols="30" rows="10" placeholder="Messsage"><?php echo old("messageEditContact-" . escape($contact->getId())) ?: escape($contact->getMessage()); ?></textarea>
                                <?php echo error("messageEditContact-" . escape($contact->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("messageEditContact-" . escape($contact->getId())) .'</span>' : ""?>

                                <?php echo error("messageErrorEditContact-" . escape($contact->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("messageEditContact-" . escape($contact->getId())) .'</span>' : ""?>

                                <button type="submit" name="button">Editer</button>
                            </form>
                            <form action="/administration/contact/delete/<?php echo escape($contact->getId()); ?>" method="post">
                                <button type="submit" name="button">delete</button>
                            </form>
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

                                <form action="/administration/user/edit/<?php echo escape($user->getId()); ?>" method="post">
                                    <label for="firstNameEditUser-<?php echo escape($user->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                    <input type="text" name="firstNameEditUser-<?php echo escape($user->getId()); ?>" id="firstNameEditUser-<?php echo escape($user->getId()); ?>" value="<?php echo old("firstNameEditUser-" . escape($user->getId())) ?: escape($user->getFirstName()); ?>" placeholder="Prénom">
                                    <?php echo error("firstNameEditUser-" . escape($user->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("firstNameEditUser-" . escape($user->getId())) .'</span>' : ""?>

                                    <label for="lastNameEditUser-<?php echo escape($user->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                    <input type="text" name="lastNameEditUser-<?php echo escape($user->getId()); ?>" id="lastNameEditUser-<?php echo escape($user->getId()); ?>" value="<?php echo old("lastNameEditUser-" . escape($user->getId())) ?: escape($user->getlastName()); ?>" placeholder="Prénom">
                                    <?php echo error("lastNameEditUser-" . escape($user->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("lastNameEditUser-" . escape($user->getId())) .'</span>' : ""?>

                                    <label for="emailEditUser-<?php echo escape($user->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                    <input type="email" name="emailEditUser-<?php echo escape($user->getId()); ?>" id="emailEditUser-<?php echo escape($user->getId()); ?>" value="<?php echo old("emailEditUser-" . escape($user->getId())) ?: escape($user->getEmail()); ?>" placeholder="Prénom">
                                    <?php echo error("emailEditUser-" . escape($user->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("emailEditUser-" . escape($user->getId())) .'</span>' : ""?>

                                    <label for="roleEditUser-<?php echo escape($user->getId()); ?>"><i class="fas fa-user-tie"></i></label>
                                    <input type="checkbox" name="roleEditUser-<?php echo escape($user->getId()); ?>" id="roleEditUser-<?php echo escape($user->getId()); ?>" <?php if ($user->getAdmin() == 1) {echo "checked";}?>>
                                    <?php echo error("roleEditUser-" . escape($user->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("roleEditUser-" . escape($user->getId())) .'</span>' : ""?>

                                    <?php echo error("messageErrorEditUser-" . escape($user->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("messageEditUser-" . escape($user->getId())) .'</span>' : ""?>

                                    <button type="submit" name="button">Editer</button>
                                </form>
                                <form action="/administration/user/delete/<?php echo escape($user->getId()); ?>" method="post">
                                    <button type="submit" name="button">delete</button>
                                </form>
                                
                                <p><?php echo escape($user->getCreatedAt()); ?></p>
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