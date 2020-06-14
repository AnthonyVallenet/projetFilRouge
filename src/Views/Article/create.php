<?php
ob_start();
$comment = "checked";

$enabled = "checked";

old("comment") == "on" ?: $comment = "";
old("enabled") == "on" ?: $enabled = "";
?>
<div id="article">
  <div class="bandeau">
    <div id='title'>
      <h1 class="titre1">Créez votre article</h1>
    </div>
  </div>
  <section class="article">

    <form action="/article/create" enctype="multipart/form-data" method="post">

    <div class="enableAndTag">
      <div class="input enabled">
        <input type="checkbox" id="enabled" name="enabled" <?php echo $enabled; ?>>
        <label for="enabled">Mettre en pause l'article</label>
      </div>
      <div class="input tag" id="tag">
        <p>#Tags:</p>
        <select name="tags[]" id="tags" multiple>
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
      <div class="block">
        <div class="titre input">
          <label for="title"></label>
          <input type="text" name="title" id="title" value="<?php echo old("title");?>" placeholder="Titre">
        </div>
        <?php echo error("title") ? '<span class="error" style="margin-top: 10px"><i class="fas fa-exclamation-circle"></i>'. error("title") .'</span>' : ""?>
      </div>
      
      <div class="block">
        <div class="date input">
          <label for="date">Date: </label>
          <input type="date" name="date" id="date" value="<?php echo old("date");?>">
        </div>
        <?php echo error("date") ? '<span class="error" style="margin-top: 10px"><i class="fas fa-exclamation-circle"></i>'. error("date") .'</span>' : ""?>
    </div>

      </div>


      <div class="imgDescription">
        <div class="container">
          <div  class="result" >
            <img id="output" src="https://media.discordapp.net/attachments/700677739471962192/714830061496303647/image-not-found.png?width=1055&height=703" alt="">
            <input type="file" id="file" name="imgArticle" accept="image/png, image/jpeg"/>
            <label for="file" id="labelFile" class="fileButton"><i class="fas fa-image"></i></label>
         </div>
         <?php echo error("imgArticle") ? '<span class="error"><i class="fas fa-exclamation-circle"></i>'. error("imgArticle") .'</span>' : ""?>
        </div>


        <div class="description">
          <label for="content"></label>
          <textarea name="content" class="input" id="content" cols="30" rows="10" placeholder="Contenu"><?php echo old("content");?></textarea>
          <?php echo error("content") ? '<span class="error" style="margin-top: 10px"><i class="fas fa-exclamation-circle"></i>'. error("content") .'</span>' : ""?>
        </div>
      </div>
      <div class="commentSend">
        <label for="comment"><span>Autoriser les commentaires</span>
          <input type="checkbox" id="comment" name="comment" <?php echo $comment; ?>>
        </label>

        <button class="button" type="submit">Envoyer</button>
      </div>
<!-- 
        <label for="imgArticle">Img :</label>
        <input type="file" id="imgArticle" name="imgArticle" accept="image/png, image/jpeg"/>
        <span class="error" style="margin-top: 10px"><?php echo error("imgArticle");?></span>

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
