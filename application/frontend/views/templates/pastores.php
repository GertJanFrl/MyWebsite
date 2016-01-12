<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="block">
                    <h1><?php echo $page->title; ?></h1>
                    <?php echo $page->body; ?>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4" id="sidebar">
                <div class="block sidebar">
                    <h3>Laatste nieuws</h3>
                    <?php
                    foreach ($articles as $key => $article):
                        echo '<div class="news-row"><a href="/nieuws/' . $article->url . '">';
                        echo '<h5>' . $article->title . '</h5>';
                        echo '<p>' . substr(strip_tags($article->body), 0, 200) . '</p>';
                        echo '</a></div>';
                    endforeach;
                    ?>
                    <p><a href="/nieuws" class="btn btn-anchor">Meer nieuws >></a></p>
                </div>
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/extra/sidebar.php'; ?>
            </div>
        </div>
        <?php
        if (!empty($subpages)):
            echo '<div class="row">';
            foreach ($subpages as $key => $page):
                echo '<div class="col-lg-4 col-md-4 col-sm-4"><a href="/pastores/' . $page->url . '" class="block background" style="height: 300px; background-image: url(\'/resize/360x360/uploads/page/' . $page->thumbnail . '\');"><div class="text">';
                echo '<h3>' . $page->title . '</h3>';
                echo '<p>' . substr(strip_tags($page->body), 0, 350) . '</p>';
                echo '</div></a></div>';
            endforeach;
            echo '</div>';
        endif;
        ?>