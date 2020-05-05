<?php
ob_start();
?>

<section class="allArticles">
    <?php
        foreach ($info as $article) {
            ?>
            <div style="border: 2px solid black">
                <a href="/article/<?php echo escape($article->getId());?>">Lien de l'article</a>
                <p><?php echo escape($article->getId()); ?></p>
                <p><?php echo escape($article->getTitle()); ?></p>
                <p><?php echo escape($article->getDate()); ?></p>
                <p><?php echo escape($article->getContent()); ?></p>
                <p><?php echo escape($article->getEnabled()); ?></p>
                <p><?php echo escape($article->getComment()); ?></p>
                <img src="/img/article/<?php echo escape($article->getId());?>" alt="image article" style="width: 200px">
            </div>
            <?php
        }
    ?>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
