<?php
ob_start();
$comment = "checked";

$enabled = "checked";

old("comment") == "on" ?: $comment = "";
old("enabled") == "on" ?: $enabled = "";
?>

<section class="createArticle">

    <form action="/article/create" enctype="multipart/form-data" method="post">

        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" value="<?php echo old("title");?>" placeholder="title">
        <span class="error"><?php echo error("title");?></span>

        <br>

        <label for="date">Date :</label>
        <input type="date" name="date" id="date" value="<?php echo old("date");?>">
        <span class="error"><?php echo error("date");?></span>

        <br>

        <label for="content">Description :</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="content"><?php echo old("content");?></textarea>
        <span class="error"><?php echo error("content");?></span>

        <br>

        <label for="comment">désactiver les commentaires :</label>
        <input type="checkbox" id="comment" name="comment" <?php echo $comment; ?>>
        <span class="error"><?php echo error("comment");?></span>

        <br>

        <label for="enabled">Mettre en pause l'article :</label>
        <input type="checkbox" id="enabled" name="enabled" <?php echo $enabled; ?>>
        <span class="error"><?php echo error("enabled");?></span>

        <br>

        <label for="imgArticle">Img :</label>
        <input type="file" id="imgArticle" name="imgArticle" accept="image/png, image/jpeg"/>
        <span class="error"><?php echo error("imgArticle");?></span>

        <br>

        <select name="tags[]" id="tags" multiple>
            <?php 
            foreach ($info as $tag) {
                ?>
                <option value="<?php echo escape($tag->getIdTag()); ?>"><?php echo escape($tag->getName()); ?></option>
                <?php
            }
            ?>
        </select>

        <button type="submit">send</button>
    </form>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
