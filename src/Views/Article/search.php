<?php
ob_start();
?>

<div class="bandeau">
    <div id='title'>
    <h1 class="titre1">Recherche</h1>
    </div>
</div>
<section class="sectionSearch sectionPage">
    <form action="/article/search" method="post">
        <div>
            <input type="text" name="search" id="search" value="<?php echo old("name") ?: escape($info["search"]);?>" placeholder="Search">
            <button><i class="fas fa-search"></i></button>
        </div>
        <span class="error"><?php echo error("search");?></span>
    </form>

    <div>
        <div>
            <h2><?php echo count($info["articles"])?> <?php echo count($info["articles"]) <= 1 ? "résultat" : "résultats";?> de recherche pour :</h2>
            <p><?php echo $info["search"]?></p>
        </div>
        <?php
            if ($info["articles"] != null) {
                ?>
                    <div>
                        <?php 
                            foreach ($info["articles"] as $article) {
                                if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1){
                                    ?>
                                    <div>
                                        <div class="cardArticle" style="background-image: url('/img/article/<?php echo escape($article->getId());?>'); <?php echo escape($article->getEnabled()) != 1 ? "" : "border: 2px solid red"?>">
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
                                <script>
                                    var searchTextStart = document.getElementsByClassName('searchText');
                                    window.onload = highlight();
            
                                    function replace(i) {
                                        var search = document.getElementById('search').value;
                                        search = search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                                        var re = new RegExp(search, 'g');
                                        return searchTextStart[i].innerHTML.replace(re, `<mark>$&</mark>`);
                                    }

                                    function highlight() {
                                        var search = document.getElementById('search').value;
                                        search = search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                                        
                                        var searchText = document.getElementsByClassName('searchText');
                                        for (var i = 0; i < searchText.length; i++) {
                                            if (search.length > 0) {
                                                searchText[i].innerHTML = replace(i);
                                            }
                                        }
                                    }
                                </script>
                            <?php
                        ?>
                    </div>
                <?php
            }
        ?>
    </div>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
