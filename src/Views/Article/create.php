<?php
ob_start();
$comment = "checked";

$enabled = "checked";

old("comment") == "on" ?: $comment = "";
old("enabled") == "on" ?: $enabled = "";
?>
<div id="createArticle">
  <div class="bandeau">
    <div id='title'>
      <h1 class="titre1">Créez votre article</h1>
    </div>
  </div>
  <section class="createArticle">

    <form action="/article/create" enctype="multipart/form-data" method="post">

    <div class="enableAndTag">
      <div class="input enabled">
        <input type="checkbox" id="enabled" name="enabled" <?php echo $enabled; ?>>
        <label for="enabled">Mettre en pause l'article</label>
        <span class="error"><?php echo error("enabled");?></span>
      </div>
      <div class="input tag" id="tag">
        <p>#Tags:</p>
        <select style="display:none" name="tags[]" id="tags" multiple>
          <?php
          foreach ($info as $tag) {
            ?>
                <option value="<?php echo escape($tag->getIdTag()); ?>"><?php echo escape($tag->getName()); ?></option>
            <?php
          }
          ?>
        </select>
        <i class="fas fa-arrow-down" id="arrow" onclick="rotate()"></i>
        
      </div>
    </div>


    <div class="titreDate">
      <div class="titre input">
        <label for="title"></label>
        <input type="text" name="title" id="title" value="<?php echo old("title");?>" placeholder="Titre">
        <span class="error"><?php echo error("title");?></span>
      </div>
      <div class="date input">
        <label for="date">Date: </label>
        <input type="date" name="date" id="date" value="<?php echo old("date");?>">
        <span class="error"><?php echo error("date");?></span>
      </div>
    </div>


      <div class="imgDescription">
        <div class="container">
          <div  class="result" >
            <img id="output" src="https://media.discordapp.net/attachments/700677739471962192/714830061496303647/image-not-found.png?width=1055&height=703" alt="">
            <input type="file" id="file" name="" accept="image/png, image/jpeg"/>
            <label for="file" id="labelFile" class="fileButton"><i class="fas fa-image"></i></label>
         </div>
        </div>


        <div class="description">
          <label for="content"></label>
          <textarea name="content" class="input" id="content" cols="30" rows="10" placeholder="content"><?php echo old("content");?></textarea>
          <span class="error"><?php echo error("content");?></span>
        </div>
      </div>
      <div class="commentSend">
        <label for="comment"><span>Autoriser les commentaires</span>
          <input type="checkbox" id="comment" name="comment" <?php echo $comment; ?>>
        </label>
        <span class="error"><?php echo error("comment");?></span>

        <button class="button" type="submit">send</button>
      </div>
<!-- 
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
        </select> -->


      </div>
    </form>
  </section>
</div>
<script src="/js/hover_image.js" charset="utf-8"></script>
<script src="/js/show_tag.js" charset="utf-8"></script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
