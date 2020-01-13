<?php
ob_start();
require './assets/includes/config.inc.php';
require MYSQL;
require './assets/includes/form_functions.inc.php';


// form handling
$showArticle_errors = [];
$filterArticles_errors = [];
$max_shown = 50;
$customQuery;
$categoryAdded = false;
$tailEnd = '';

if (isset($_GET['filterSubmitBtn'])) {
  // $_GET['categorySelect'] = settype($_GET['categorySelect'], 'integer');
  $dateSelect = $_GET['dateSelect'];
  $cq = 'SELECT a.*, c.category as category FROM articles a JOIN categories c ON a.article_category = c.category_id WHERE ';
  $permittedDateValues = ['date', 'allTime', 'pastYear', 'pastMonth', 'pastWeek'];


  $q = "SELECT category_id FROM categories";
  $r = mysqli_query($dbc, $q);
  $permittedCategoryValues = mysqli_fetch_all ($r, MYSQLI_ASSOC);
  if (!empty($_GET['categorySelect']) && $_GET['categorySelect'] != 0) {
    $tailEnd .= "a.article_category = " . $_GET['categorySelect'];
    $categoryAdded = true;
    // echo $tailEnd;
  }

  if (!empty($dateSelect) && $dateSelect != 'date' && in_array($dateSelect, $permittedDateValues)) {
    if ($categoryAdded === true && $dateSelect !== 'allTime') $tailEnd .= ' && ';

    switch ($dateSelect) {
      case 'allTime':
        break;

      case 'pastYear':
        $tailEnd .= "a.`date_modified` > curdate() - interval 1 year";
        break;

      case 'pastMonth':
        $tailEnd .= "a.`date_modified` > curdate() - interval 1 month";
        break;

      case 'pastWeek':
        $tailEnd .= "a.`date_modified` > curdate() - interval 1 week";
        break;
      
      default: 
        break;
    }
  }

  if (!empty($tailEnd)) $customQuery = $cq . $tailEnd;
}
require './assets/views/showArticles.inc.php';


$page = 'News';
if ($page = 'News') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--news);
      --pageColor-shade: var(--news-shade);
      --pageColor-link: var(--news-link);
  }
</style>
<?php
}
require './assets/includes/head.php';

if (isset($_GET['filterSubmitBtn'])) {
echo '<body class="filterArticlesPages">';
} else {
  echo '<body>';
}
// <!------ Header ------------>
require './assets/includes/header.inc.php'; 
?>

<!-- Main body content -->
<article id="mainContent" class="multiContentPage mainContent newsPage">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Newsfeed</h2>
    </header>

    <div class="mainContent-wrapper">
      <div class="filter-container">
        <svg id="filterBtn" class="filterBtn" height="393pt" viewBox="-4 0 393 393.99003" width="393pt" xmlns="http://www.w3.org/2000/svg"><path d="m368.3125 0h-351.261719c-6.195312-.0117188-11.875 3.449219-14.707031 8.960938-2.871094 5.585937-2.3671875 12.3125 1.300781 17.414062l128.6875 181.28125c.042969.0625.089844.121094.132813.183594 4.675781 6.3125 7.203125 13.957031 7.21875 21.816406v147.796875c-.027344 4.378906 1.691406 8.582031 4.777344 11.6875 3.085937 3.105469 7.28125 4.847656 11.65625 4.847656 2.226562 0 4.425781-.445312 6.480468-1.296875l72.3125-27.574218c6.480469-1.976563 10.78125-8.089844 10.78125-15.453126v-120.007812c.011719-7.855469 2.542969-15.503906 7.214844-21.816406.042969-.0625.089844-.121094.132812-.183594l128.683594-181.289062c3.667969-5.097657 4.171875-11.820313 1.300782-17.40625-2.832032-5.511719-8.511719-8.9726568-14.710938-8.960938zm-131.53125 195.992188c-7.1875 9.753906-11.074219 21.546874-11.097656 33.664062v117.578125l-66 25.164063v-142.742188c-.023438-12.117188-3.910156-23.910156-11.101563-33.664062l-124.933593-175.992188h338.070312zm0 0"/></svg> 
        <p class="filter-heading">Sort Articles By: </p>
        <form class="newsfeedFilter-form" method="get">
          <div class="filter-dateSelect-container">
            <select name="dateSelect" id="dateSelect" class="filter-dateSelect">
              <option name="dataSelect" value="date">Date</option>
              <option name="dataSelect" value="allTime">All Time</option>
              <option name="dataSelect" value="pastYear">Past Year</option>
              <option name="dataSelect" value="pastMonth">Past Month</option>
              <option name="dataSelect" value="pastWeek">Past Week</option>
            </select>
            <i class="filter-arrow filter-dateSelect-arrow"></i>
          </div>
          
          <!-- <p class="filter-heading filter-subheading">Category</p> -->
          <div class="filter-categorySelect-container">
            <select name="categorySelect" id="categorySelect" class="filter-categorySelect">
              <option name="categorySelect" value="0">Category</option>
            <?php 
              $q = "SELECT * FROM categories";
              $r = mysqli_query($dbc, $q);
              if ($r) {
                while ($row = $r->fetch_assoc()) {
                  if (isset($_GET['categorySelect']) && $row['category_id'] == intval($_GET['categorySelect'])) {
                    echo '<option name="categorySelect" value="' . $row['category_id'] . '" selected>' . $row['category'] . '</option>';
                  } else {
                    echo '<option name="categorySelect" value="' . $row['category_id'] . '">' . $row['category'] . '</option>';
                  }
                }
              }
            ?>
            </select>
            <i class="filter-arrow  filter-categorySelect-arrow"></i>
          </div>
          <input type="submit" name="filterSubmitBtn" class="filterSubmitBtn" value="Filter">
        </form>

      </div>
        <?php  showArticles('description_only'); ?>
    </div>
</article>

<!-- NOTE -----------------------*************************************----------------- -->
<!-- This is what it currently looks like, with the added classes. If you want to change them and/or remove them then change it here and lemme know so i can update the code -->
<!-- END NOTE  ------------------*************************************----------------- -->
<!-- <section class="article6">
    <img class="article-img" src="" alt="Article Image">
    <p class="article-date">November 22nd, 2019</p>
    <h2 class="sec-title">Title of Article</h2>
    <p class="article-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tellus cras adipiscing enim eu turpis egestas pretium. Ac felis donec et odio pellentesque diam. Aliquam faucibus purus in massa tempor nec feugiat nisl. Dictum at tempor commodo ullamcorper a lacus vestibulum sed arcu. Semper feugiat nibh sed pulvinar. </p>
    <a class="readmore" href="../admin/view.php?view_type=read&media_type=article&media_id=WOOPS">Read More >></a>
</section> -->

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
</html>
