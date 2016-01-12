        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="block">
                            <h1><?php echo $item->title; ?></h1>
                            <?php if (!empty($item->thumbnail)): ?><img src="/resize/200x350/uploads/blog/<?php echo $item->thumbnail; ?>" alt="<?php echo $item->title; ?>" class="img-responsive article-image-left"><?php endif; ?>
                            <?php echo $item->body; ?>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
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
                    </div>
                </div>
