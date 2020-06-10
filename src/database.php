<?php

try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=' . DATABASE, USER, PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tableUsers = "CREATE TABLE IF NOT EXISTS users (
        id INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        admin BOOLEAN DEFAULT 0
    );";

    $tableArticles = "CREATE TABLE IF NOT EXISTS articles (
        id INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        date DATE NOT NULL,
        content TEXT NOT NULL,
        img_type VARCHAR(25) NOT NULL,
        img_blob LONGBLOB NOT NULL,
        enabled BOOLEAN DEFAULT 0,
        comment BOOLEAN DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );";

    $tableContact = "CREATE TABLE IF NOT EXISTS contact (
        id INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );";

    $tableTag = "CREATE TABLE IF NOT EXISTS tag (
        id INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
        color VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL
    );";

    $tableComment = "CREATE TABLE IF NOT EXISTS comment (
        id INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        article_id INT UNSIGNED NOT NULL,
        content VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_comment_user_id FOREIGN KEY (user_id) REFERENCES users(id),
        CONSTRAINT fk_comment_article_id FOREIGN KEY (article_id) REFERENCES articles(id)
    );";

    $tableArticleTag = "CREATE TABLE IF NOT EXISTS article_tag (
        id INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
        tag_id INT UNSIGNED NOT NULL,
        article_id INT UNSIGNED NOT NULL,
        CONSTRAINT fk_article_tag_tag_id FOREIGN KEY (tag_id) REFERENCES tag(id),
        CONSTRAINT fk_article_tag_article_id FOREIGN KEY (article_id) REFERENCES articles(id)
    );";

    $bdd->exec($tableUsers);
    $bdd->exec($tableArticles);
    $bdd->exec($tableTag);
    $bdd->exec($tableContact);
    $bdd->exec($tableComment);
    $bdd->exec($tableArticleTag);

    $valUsers = $bdd->query('SELECT * FROM users')->fetch();

    if(!$valUsers) {
        $passwordAdmin = password_hash('password', PASSWORD_BCRYPT);
        $stmt = $bdd->prepare("INSERT INTO users(first_name, last_name, email, password, admin) VALUES ('Admin', 'Admin', 'admin@gmail.com', ?, '1')");
        $stmt->execute(array(
            $passwordAdmin
        ));
    }

} catch(PDOException $e) {
    echo  $e->getMessage();
}

$bdd = null;
