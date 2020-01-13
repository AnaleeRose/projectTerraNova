<?php

function showArticles($displaytype) {
    global $dbc;
    global $article_id;
    global $max_shown;
    global $customQuery;
    $articlesCurrentlyShown = 0;

    $showArticle_errors = [];
    if ($displaytype === 'description_only') {
        $num = 1;
        if (empty($customQuery)) {
            $q = 'SELECT a.*, c.category as category FROM articles a JOIN categories c ON a.article_category = c.category_id ORDER BY date_modified DESC LIMIT 10';
        } else {
            $q = $customQuery;
        }
        $r = mysqli_query($dbc, $q);
        if ($r && mysqli_num_rows($r) > 0) {
            while ($row = $r->fetch_assoc()) {
                if ($row['error_flag'] === null && $num <= $max_shown) {
                    $articlesCurrentlyShown++;
                    ?>
                        <section class="article<?= $num; ?> indiArticle mainSection-container">
                            <a href="./readArticle.php?article_id=<?= $row['article_id']?>" class="indiArticle-imgLink"><img class="indiArticle-img" src="<?= IMG_PATH_HTML . $row['img_name']; ?>" alt="Article Image"></a>
                            <div class="indiArticle-content">
                                <a href="./readArticle.php?article_id=<?= $row['article_id']?>" class="indiArticle-titleLink"><h2 class="indiArticle-titleText"><?= $row['article_name']; ?></h2></a>
                                <p class="indiArticle-date"><?= date('F jS, Y', strtotime($row['date_added']));   ?></p>
                                <p class="indiArticle-description"><?= $row['article_description']; ?></p>
                                <div class="categoryReadBtn-container">
                                    <p class="indiArticle-category"><?= $row['category']; ?></p>
                                    <a class="indiArticle-readMore" href="./readArticle.php?article_id=<?= $row['article_id']?>">Read Article >></a>
                                </div>
                            </div>
                        </section>
                    <?php
                    $num++;
                } // END if no error flag
            } // END while
        } elseif (!$r) {
            echo $q;
            // ob_end_clean();
            // require '../admin/assets/includes/header.html';
            // require '../admin/assets/includes/error.inc.php';
            // $links = ['Return To Home' => 'index.php'];
            // produce_error_page('Hmm...something went wrong. We\'ll be sure to fix it soon!', $links);
            // require '../admin/assets/includes/footer.html';
            // exit();
        } // end if $r
    } elseif ($displaytype === 'full_article') {
        if (isset($article_id)) {
            $q = 'SELECT a.*,  c.category as category FROM `articles` a JOIN categories c ON c.category_id = a.article_category WHERE article_id = ' . $article_id;
            $r = mysqli_query($dbc, $q);
            if ($r && mysqli_num_rows($r) > 0) {
                while ($row = $r->fetch_assoc()) {
                    if ($row['error_flag'] === null) {
                        ?>
                            <article class="readArticle">
                                <h2 class="readArticleName"><?= $row['article_name']; ?></h2>
                                <h3 class="readArticle"><a href="econews.php?filter=true&category=<?= strtolower($row['category']); ?>"><?= $row['category']; ?></a></h3>
                                <img class="readArticleImg" src="<?= IMG_PATH_HTML . $row['img_name']; ?>" alt="Article Image">
                                <p class="readArticleCaption"><?= $row['caption']; ?></p>
                                <p class="readArticleDate">Posted: <?= date('M j, Y', strtotime($row['date_added'])); ?></p>
                                <hr>
                                <?php
                                    $q = 'SELECT * FROM `article_content` WHERE article_id = ' . $article_id;
                                    $r = mysqli_query($dbc, $q);
                                    if ($r && mysqli_num_rows($r) > 0) {
                                        require './assets/includes/articleBuilder.inc.php';
                                    }
                                ?>
                            </article>
                        <?php
                    } // END if no error flag
                } // END while
            } else {
                $showArticle_errors['Database'] = 'That article does not exist.';
            } // END if $r
        } else {
            $showArticle_errors['article_id'] = 'That article does not exist.';
        };// END if article_id
    } // END if full_article

    if (isset($showArticle_errors) && !empty($showArticle_errors)) {
        foreach ($showArticle_errors as $key => $value) {
            echo '<p class="error">'. $key . ' | ' . $value . '</p>';
        }
    } // END show errors if

    if ($articlesCurrentlyShown < 1) {
        echo '<p class="noArticles_error">We don\'t have any articles matching those criteria. Check back soon for more content!</p>';
    }
} // END function

?>
