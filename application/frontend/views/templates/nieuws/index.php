        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h1><?php echo $page->title; ?></h1>
                            <?php echo $page->body; ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                <div class="row" id="portfolio">
                    <div class="col-md-12">
                        <?php
                        if (!empty($nieuws)):
                        foreach ($nieuws as $article):
                            echo '<div class="block"><div class="news-row row"><a href="/nieuws/' . $article->url . '">';
                            echo (!empty($article->thumbnail) ? '<div class="col-md-2"><img src="/resize/200x200/uploads/blog/' . $article->thumbnail . '" class="img-responsive" alt="' . $article->title . '" /></div>' : '');
                            echo '<div class="' . (!empty($article->thumbnail) ? 'col-md-10' : 'col-md-12') . '">';
                            echo '<h2>' . $article->title . '</h2>';
                            echo '<p>' . (!empty($item->meta_description) ? $item->meta_description : substr(strip_tags($article->body), 0, 1000)) . '</p>';
                            echo '</div>';
                            echo '</a></div></div>';
                        endforeach;
                        endif;
                        ?>
                        <?php echo $links; ?>
                    </div>
                </div>