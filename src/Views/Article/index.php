<?php
ob_start();
?>

<div class="bandeau">
    <div id="title">
        <h1 class="titre1">Les articles</h1>
    </div>
</div>
<section class="allArticles sectionPage">
    <form action="/article/search" method="post">
        <div>
            <input type="text" name="search" id="search" value="<?php echo old("name");?>" placeholder="Search">
            <button><i class="fas fa-search"></i></button>
        </div>
        <span class="error"><?php echo error("search");?></span>
    </form>

    <div>
        <div>
            <div>
                <?php
                    foreach ($info["tags"] as $tag) {
                        ?>
                            <a style="color: <?php echo escape($tag->getColor()) ?>" href="/article/searchTag/<?php echo escape($tag->getName()) ?>">#<?php echo escape($tag->getName()) ?></a>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div>
            <?php
                foreach ($info["articles"] as $article) {
                    if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1){
                        ?>
                        <div>
                            <div class="cardArticle" style="background-image: url('/img/article/<?php echo escape($article->getId());?>')">
                                <div class="infos">
                                    <div>
                                        <a href="/article/<?php echo escape($article->getId());?>"><h2 class="title"><?php echo escape($article->getTitle()); ?> <i class="fas fa-eye fade"></i></h2></a>
                                        <h3 class="date text-alt"><?php echo strftime("%d %b %G", strtotime(escape($article->getDate())));?></h3>
                                    </div>
                                    <div class="fade">
                                        <p class="txt"><?php echo substr(escape($article->getContent()), 0, 70) . (strlen(escape($article->getContent())) > 70 ? "..." : ""); ?></p>
                                        <?php
                                        if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) {
                                            ?>
                                                <div>
                                                    <form action="/administration/article/delete/<?php echo escape($article->getId()); ?>" method="post">
                                                        <button type="submit" name="button">SUPPRIMER</button>
                                                    </form>
                                                    <a href="/article/<?php echo escape($article->getId());?>?edit" class="edit">MODIFIER</a>
                                                </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }elseif ((isset($_SESSION["user"]) && $_SESSION["user"]["admin"] != 1) || !isset($_SESSION["user"])){
                        if (escape($article->getEnabled()) != 1){
                            ?>
                            <div>
                                <div class="cardArticle" style="background-image: url('/img/article/<?php echo escape($article->getId());?>')">
                                    <div class="infos">
                                        <div>
                                            <a href="/article/<?php echo escape($article->getId());?>"><h2 class="title"><?php echo escape($article->getTitle()); ?> <i class="fas fa-eye fade"></i></h2></a>
                                            <h3 class="date text-alt"><?php echo strftime("%d %b %G", strtotime(escape($article->getDate())));?></h3>
                                        </div>
                                        <div class="fade">
                                            <p class="txt"><?php echo substr(escape($article->getContent()), 0, 70) . (strlen(escape($article->getContent())) > 70 ? "..." : ""); ?></p>
                                            <?php
                                            if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) {
                                                ?>
                                                    <div>
                                                        <form action="/administration/article/delete/<?php echo escape($article->getId()); ?>" method="post">
                                                            <button type="submit" name="button">SUPPRIMER</button>
                                                        </form>
                                                        <a href="/article/<?php echo escape($article->getId());?>?edit" class="edit">MODIFIER</a>
                                                    </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    
                }
            ?>
        </div>
    </div>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
