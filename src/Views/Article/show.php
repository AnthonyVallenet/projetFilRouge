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

<section class="article">
    <button class="btnToggleEdit">edit</button>
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
    <div class="toggleDivEdit" style="display: none">
        <p>edit</p>
        <form action="/administration/article/edit/<?php echo escape($info["article"]->getId()); ?>" enctype="multipart/form-data" method="post">
            <input type="text" name="titleEditArticle" id="titleEditArticle" value="<?php echo old("titleEditArticle") ?: escape($info["article"]->getTitle()); ?>" placeholder="Titre">
            <?php echo error("titleEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("titleEditArticle") .'</span>' : ""?>

            <input type="date" name="dateEditArticle" id="dateEditArticle" value="<?php echo old("dateEditArticle") ?: escape($info["article"]->getDate()); ?>">
            <?php echo error("dateEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("dateEditArticle") .'</span>' : ""?>

            <textarea name="contentEditArticle" id="contentEditArticle" cols="30" rows="10"><?php echo old("contentEditArticle") ?: escape($info["article"]->getContent()); ?></textarea>
            <?php echo error("contentEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("contentEditArticle") .'</span>' : ""?>

            <input type="file" id="imgEditArticle" name="imgEditArticle" accept="image/png, image/jpeg"/>
            <?php echo error("imgEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("imgEditArticle") .'</span>' : ""?>

            <input type="checkbox" id="commentEditArticle" name="commentEditArticle" <?php echo $comment; ?>>
            <span class="error"><?php echo error("commentEditArticle");?></span>

            <input type="checkbox" id="enabledEditArticle" name="enabledEditArticle" <?php echo $enabled; ?>>
            <span class="error"><?php echo error("enabledEditArticle");?></span>

            <?php echo error("messageEditArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("messageEditArticle") .'</span>' : ""?>

            <button type="submit" name="button">Editer</button>
        </form>
    </div>
</section>

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

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
