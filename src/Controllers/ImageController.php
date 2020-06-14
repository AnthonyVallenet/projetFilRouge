<?php

namespace App\Controllers;

class ImageController extends Controller {

    public function __construct() {
        // récupère les donner du manager général et du managers "AuthManager"
        parent::__construct();
        $this->manager = $this->manager('ArticleManager');
    }
// fonction pour récupérer l'image de l'article
    public function imageArticle($slug)
    {
        $articleImage = $this->manager->getArticleBy($slug);
        header('Content-Type: ' . $articleImage->getImgType());
        echo $articleImage->getImgBlob();
        die;
    }
}
