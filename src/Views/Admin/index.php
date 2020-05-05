<?php
ob_start();
?>
    <section id="admin">
        <p>Admin</p>

        
        <button class="btnToggle active">Tags</button>
        <button class="btnToggle">Contacts</button>
        <button class="btnToggle">Utilisateurs</button>

        <div class="toggleDiv active">
            <p>Tags</p>
        </div>

        <div class="toggleDiv" style="display: none">
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

        <div class="toggleDiv" style="display: none">
            <p>Utilisateurs</p>
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
        
    </section>

    <script>
        let btnToggle = document.querySelectorAll('.btnToggle');
        let divToggle = document.querySelectorAll('.toggleDiv')


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
                e.preventDefault();
                
                clickToggle(e.currentTarget, index);
            });
        })
    </script>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';