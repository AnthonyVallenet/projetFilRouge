<?php
ob_start();

$comment;
$enabled;

if (old("commentEditArticle")) {
    old("commentEditArticle") == "on" ? $comment = "checked" : $comment = "";
} else {
    $info["article"]->getComment() == "1" ? $comment = "checked" : $comment = "";
}

if (old("enabledEditArticle")) {
    old("enabledEditArticle") == "on" ? $enabled = "checked" : $enabled = "";
} else {
    $info["article"]->getEnabled() == "1" ? $enabled = "checked" : $enabled = "";
}
?>
<div id='article'>

<!-- show -->
    <div class="toggleDivEdit">
        <div class="bandeau show_title">
            <div id='title'>
                <h1 class="titre1"><?php echo escape($info["article"]->getTitle()); ?></h1>
            </div>
            <div class="subtitle"><?php echo escape($info["article"]->getDate()); ?></div>
        </div>

        <section class="article sectionPage">
            <?php 
            if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) {
                ?>
                    <div class="buttonContainer">
                        <button class="btnToggleEdit button">Modifier</button>
                    </div>
                <?php
            }
            ?>

            <div class="imgContent">
                <div class="img">
                    <img src="/img/article/<?php echo escape($info["article"]->getId());?>" alt="image article" style="width: 200px">
                </div>
                <div class="contentTag">
                    <div class="tagContainer">
                        <?php
                            foreach ($info["tagsArticle"] as $tagArticle) {
                                ?>
                                    <div class="articleTagItem" style="color: <?php echo escape($tagArticle->getColor()); ?>; border: 2px solid <?php echo escape($tagArticle->getColor()); ?>"><?php echo escape($tagArticle->getName()); ?></div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="content">
                        <p><?php echo nl2br(escape($info["article"]->getContent())); ?></p>
                    </div>
                </div>
            </div>

            
            <div class="comments">
                <h2>Commentaires</h2>
                <div class="allComments">
                    <?php
                        if (!$info["allComments"]) {
                            ?>
                                <p>Aucun commentaire n'a été ajouté à cet article. Soyez le premier !</p>
                            <?php
                        } else {
                            foreach ($info["allComments"] as $commentArticle) {
                                ?>
                                    <div class="comment">
                                        <h3>
                                            <i class="fas fa-user-alt"></i>
                                            <?php echo escape($commentArticle->getFirstNameComment()); ?>
                                            <?php
                                                if ($commentArticle->getEditing()) {
                                                    ?>
                                                        <span>(Modifié)</span>
                                                    <?php
                                                }
                                            ?>
                                        </h3>
                                        <?php
                                            if ((isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) || (escape($commentArticle->getUserId()) === $_SESSION['user']['id'])) {
                                                ?>
                                                    <form action="/article/<?php echo escape($info["article"]->getId()); ?>/delete/<?php echo escape($commentArticle->getId()); ?>" method="post">
                                                        <button type="submit"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                <?php
                                            }
                                        ?>
                                        <div class=commentContent>
                                            <?php
                                                if ((isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) || (escape($commentArticle->getUserId()) === $_SESSION['user']['id'])) {
                                                    ?>
                                                    <form action="/article/<?php echo escape($info["article"]->getId()); ?>/edit/<?php echo escape($commentArticle->getId()); ?>" method="post">
                                                        <div>
                                                            <input type="text" id="commentInputEdit-<?php echo escape($commentArticle->getId());?>" name="commentInputEdit-<?php echo escape($commentArticle->getId());?>" value="<?php echo old("commentInputEdit-" . escape($commentArticle->getId())) ?: escape($commentArticle->getContent());?>" class="input">
                                                            <button type="submit">Modifier</button>
                                                            <?php echo error("commentInputEdit-" . escape($commentArticle->getId())) ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("commentInputEdit-" . escape($commentArticle->getId())) .'</span>' : ""?>
                                                        </div>
                                                    </form>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <p><?php echo escape($commentArticle->getContent()); ?></p>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>

                <!-- input pour ecrire le commentaire -->
                <div class="sendComment">
                    <?php 
                        if ((isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) || (isset($_SESSION["user"]) && $info["article"]->getComment() == 1)) {
                            ?>
                                <form action="/article/<?php echo escape($info["article"]->getId()); ?>/send" method="post">
                                    <div>
                                        <input type="text" id="commentInput" name="commentInput" value="<?php echo old("commentInput");?>" class="input" placeholder="Commentaire">
                                        <?php echo error("commentInput") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("commentInput") .'</span>' : ""?>
                                    </div>
                                    <button type="submit" class="button">Commenter</button>
                                </form>
                            <?php
                        } else {
                            ?>
                                <p><a href="/login">Connectez-vous</a> pour mettre des commentaires !</p>
                            <?php
                        }
                    ?>
                </div>
            </div>
            
        </section>
    </div>

    <?php 
        if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) {
            ?>
                <!-- edit -->
                <div class="toggleDivEdit" style="display: none">

                    <section class="article">
                        <div class="buttonContainer">
                            <button class="btnToggleEdit button">Afficher</button>
                        </div>

                        <!-- edit -->
                        <div class="">
                            <form action="/administration/article/edit/<?php echo escape($info["article"]->getId()); ?>" enctype="multipart/form-data" method="post">
                            <!-- Pause et tag -->
                                <div class="enableAndTag" style="margin-top: 50px">
                                    <div class="input enabled">
                                        <input type="checkbox" id="enabledEditArticle" name="enabledEditArticle" <?php echo $enabled;?>>
                                        <label for="enabledEditArticle">Mettre en pause l'article</label>
                                        <!-- <span class="error"><?php echo error("enabledEditArticle");?></span> -->
                                    </div>
                                    <div class="input tag" id="tag">
                                        <p>#Tags:</p>
                                            <select name="tags[]" id="tags" multiple>
                                            <?php
                                            foreach ($info['allTags'] as $tag) {
                                                ?>
                                                    <option value="<?php echo escape($tag->getIdTag()); ?>" <?php if (in_array($tag, $info["tagsArticle"])) echo "selected"?>>
                                                        <?php echo escape($tag->getName()); ?>
                                                    </option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                        <i class="fas fa-arrow-down" id="arrow" onclick="rotate()"></i>
                                    </div>
                                </div>


                                <!-- titre et date -->
                                <div class="titreDate">
                                    <div class="block">
                                        <!-- titre -->
                                        <div class="titre input">
                                            <label for="titleEditArticle"></label>
                                            <input type="text" name="titleEditArticle" id="titleEditArticle" value="<?php echo old("titleEditArticle") ?: escape($info["article"]->getTitle()); ?>" placeholder="Titre">
                                        </div>
                                        <?php echo error("titleEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("titleEditArticle") .'</span>' : ""?>
                                    </div>
                                    
                                    <div class="block">
                                        <!-- date -->
                                        <div class="date input">
                                            <label for="dateEditArticle">Date: </label>
                                            <input type="date" name="dateEditArticle" id="dateEditArticle" value="<?php echo old("dateEditArticle") ?: escape($info["article"]->getDate()); ?>">
                                        </div>
                                        <?php echo error("dateEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("dateEditArticle") .'</span>' : ""?>
                                    </div>
                                </div>


                                <!--  image et description -->
                            
                                <div class="imgDescription">
                                    <div class="container">
                                        <div  class="result" >
                                            <img id="output" src="/img/article/<?php echo escape($info["article"]->getId());?>" alt="image article" alt="">
                                            <input type="file" id="file" name="imgEditArticle" accept="image/png, image/jpeg"/>
                                            <label for="file" id="labelFile" class="fileButton"><i class="fas fa-image"></i></label>
                                        </div>
                                        <?php echo error("imgEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("imgEditArticle") .'</span>' : ""?>
                                    </div>


                                    <div class="description">
                                        <label for="contentEditArticle"></label>
                                        <textarea class="input" name="contentEditArticle" id="contentEditArticle" cols="30" rows="10"><?php echo old("contentEditArticle") ?: escape($info["article"]->getContent()); ?></textarea>
                                        <?php echo error("contentEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("contentEditArticle") .'</span>' : ""?>
                                    </div>
                                </div>

                                <!-- activer les commentaires et sumbit -->
                                <div class="commentSend">
                                    <label for="commentEditArticle"><span>Autoriser les commentaires</span>
                                    <input type="checkbox" id="commentEditArticle" name="commentEditArticle" <?php echo $comment; ?>>
                                    </label>
                                    <?php echo error("commentEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("commentEditArticle") .'</span>' : ""?>
                                    <div>
                                        <button class="button edit" type="submit">Modifier</button>
                                        <form action="/administration/article/delete/<?php echo escape($info["article"]->getId()); ?>" method="post">
                                            <button type="submit" name="button" class="button delete">SUPPRIMER</button>
                                        </form>
                                    </div>
                                </div>


                                <?php echo error("messageEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("messageEditArticle") .'</span>' : ""?>
                            </form>
                        </div>
                    </section>
                </div>
            <?php
        }
    ?>

</div>

<?php 
    if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) {
        ?>
        <script>
            let btnToggleEdit = document.querySelectorAll('.btnToggleEdit');
            let toggleDivEdit = document.querySelectorAll('.toggleDivEdit');
            var url = document.location.href;
            var urlOrigin = document.location.origin;

            var urlJS = '/article/<?php echo escape($info["article"]->getId()); ?>?edit';
            var regex = /^\/article\/[1-9]+\?edit$/;
            
            btnToggleEdit.forEach((btn,index) => {
                btn.addEventListener('click',(e) => {
                    toggleEdit(e.currentTarget, index);
                });
            });

            const toggleEdit = (el, index) => {
                if(url === urlOrigin + urlJS.match(regex)){
                    window.location.href = urlOrigin + '/article/<?php echo escape($info["article"]->getId()); ?>';
                }else{
                    window.location.href = url + "?edit";
                }
            }

            if (url === urlOrigin + urlJS.match(regex)) {
                let index = 1;
                toggleDivEdit.forEach(div => {
                    div.style.display = "none";
                })
                toggleDivEdit[index].style.display = "block";
            }
        </script>
        <script src="/js/hover_image.js" charset="utf-8"></script>
        <script src="/js/show_tag.js" charset="utf-8"></script>
        <?php
    }
?>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
