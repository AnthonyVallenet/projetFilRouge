<?php
ob_start();
?>

<section class="search">
    <form action="/article/search" method="post">
        <input type="text" name="search" id="search" value="<?php echo escape($info["search"]);?>" placeholder="Search">
        <span class="error"><?php echo error("search");?></span>
        <button>send</button>
    </form>

    <?php
        if ($info["articles"] == null) {
            ?>
            <p>Impossible pour la recherche : <?php echo escape($info["search"]);?></p>
            <?php
        } else {
            foreach ($info["articles"] as $article) {
                ?>
                <div style="border: 1px solid black">
                    <a href="/article/<?php echo escape($article->getId());?>">Lien de l'article</a>
                    <p><?php echo escape($article->getId()); ?></p>
                    <p class="searchText"><?php echo escape($article->getTitle()); ?></p>
                    <p><?php echo escape($article->getDate()); ?></p>
                    <p class="searchText"><?php echo escape($article->getContent()); ?></p>
                    <p><?php echo escape($article->getEnabled()); ?></p>
                    <p><?php echo escape($article->getComment()); ?></p>
                    <img src="/img/article/<?php echo escape($article->getId());?>" alt="image article" style="width: 200px">
                </div>
                <?php
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
        }
    ?>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
