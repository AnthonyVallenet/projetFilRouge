<?php
ob_start();
?>

<section class="article">
    
    <div style="border: 2px solid black">
        <p><?php echo escape($info->getId()); ?></p>
        <p><?php echo escape($info->getTitle()); ?></p>
        <p><?php echo escape($info->getDate()); ?></p>
        <p><?php echo escape($info->getContent()); ?></p>
        <p><?php echo escape($info->getEnabled()); ?></p>
        <p><?php echo escape($info->getComment()); ?></p>
        <img src="/img/article/<?php echo escape($info->getId());?>" alt="image article" style="width: 200px">
    </div>
</section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
