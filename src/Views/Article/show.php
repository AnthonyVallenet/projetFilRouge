<?php
ob_start();

$comment = "checked";

$enabled = "checked";

if ($info["article"]->getComment()) {
    $info["article"]->getComment() == "1" ?: $comment = "";
} else {
    old("comment") == "on" ?: $comment = "";
}

if ($info["article"]->getEnabled()) {
    $info["article"]->getEnabled() == "1" ?: $comment = "";
} else {
    old("comment") == "on" ?: $comment = "";
}
?>
<div id='article'>
    <div class="bandeau">
        <div id='title'>
        <h1 class="titre1"><?php echo escape($info["article"]->getTitle()); ?></h1>
        </div>
    </div>

    <section class="article">
        <div class="buttonContainer">
            <button class="btnToggleEdit button">edit</button>
        </div>
        <!-- show -->
        <div class="toggleDivEdit">
            
            <p><?php echo escape($info["article"]->getId()); ?></p>
            <p><?php echo escape($info["article"]->getTitle()); ?></p>
            <p><?php echo escape($info["article"]->getDate()); ?></p>
            <p><?php echo escape($info["article"]->getContent()); ?></p>
            <p><?php echo escape($info["article"]->getEnabled()); ?></p>
            <p><?php echo escape($info["article"]->getComment()); ?></p>
            <img src="/img/article/<?php echo escape($info["article"]->getId());?>" alt="image article" style="width: 200px">
            <?php
                foreach ($info["tagsArticle"] as $tagArticle) {
                    ?>
                        <p><?php echo escape($tagArticle->getIdTag()); ?></p>
                        <p><?php echo escape($tagArticle->getName()); ?></p>
                        <p><?php echo escape($tagArticle->getColor()); ?></p>
                    <?php
                }
            ?>
        </div>
        
        <!-- edit -->
        <div class="toggleDivEdit" style="display: none">
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
                            <select style="display:none" name="tags[]" id="tags" multiple>
                            <?php
                            foreach ($info['allTags'] as $tag) {
                                ?>
                                    <option value="<?php echo escape($tag->getIdTag()); ?>"><?php echo escape($tag->getName()); ?></option>
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

                    <button class="button" type="submit">Envoyer</button>
                </div>


                <?php echo error("messageEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("messageEditArticle") .'</span>' : ""?>
            </form>
        </div>
    </section>
</div>

<script>
    let btnToggleEdit = document.querySelector('.btnToggleEdit');
    let toggleDivEdit = document.querySelectorAll('.toggleDivEdit');
    var url = document.location.href;
    var urlOrigin = document.location.origin;

    btnToggleEdit.onclick = function() {
        if (toggleDivEdit[0].style.display == "none") {
            window.location.href = urlOrigin + '/article/<?php echo escape($info["article"]->getId()); ?>';
            toggleDivEdit[1].style.display = "none";
            toggleDivEdit[0].style.display = "block";
            btnToggleEdit.innerHTML = "edit";
        } else if(toggleDivEdit[1].style.display == "none") {
            window.location.href = url + "?edit";
            toggleDivEdit[0].style.display = "none";
            toggleDivEdit[1].style.display = "block";
            btnToggleEdit.innerHTML = "show";
        }
    };

    var urlJS = '/article/<?php echo escape($info["article"]->getId()); ?>?edit';
    var regex = /^\/article\/[1-9]+\?edit$/;

    if (url === urlOrigin + urlJS.match(regex)) {
        toggleDivEdit[0].style.display = "none";
        toggleDivEdit[1].style.display = "block";
        btnToggleEdit.innerHTML = "show";
    }
</script>
<script src="/js/hover_image.js" charset="utf-8"></script>
<script src="/js/show_tag.js" charset="utf-8"></script>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
