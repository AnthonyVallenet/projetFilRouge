<?php

namespace App\Controllers;

class ImageController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->manager = $this->manager('ArticleManager');
    }

    public function imageArticle($slug)
    {
        $articleImage = $this->manager->getArticleBy($slug);
        header('Content-Type: ' . $articleImage->getImgType());
        echo $articleImage->getImgBlob();
        die;
    }
}
