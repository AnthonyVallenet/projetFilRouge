<?php
ob_start();
?>

<section class="article">
    
    <div style="border: 2px solid black">
        <p><?php echo escape($info["article"]->getId()); ?></p>
        <p><?php echo escape($info["article"]->getTitle()); ?></p>
        <p><?php echo escape($info["article"]->getDate()); ?></p>
        <p><?php echo escape($info["article"]->getContent()); ?></p>
        <p><?php echo escape($info["article"]->getEnabled()); ?></p>
        <p><?php echo escape($info["article"]->getComment()); ?></p>
        <img src="/img/article/<?php echo escape($info["article"]->getId());?>" alt="image article" style="width: 200px">
        <?php
        foreach ($info["tags"] as $tag) {
            ?>
                <p><?php echo escape($tag->getId()); ?></p>
                <p><?php echo escape($tag->getName()); ?></p>
                <p><?php echo escape($tag->getColor()); ?></p>
            <?php
        }
    ?>
    </div>
</section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
