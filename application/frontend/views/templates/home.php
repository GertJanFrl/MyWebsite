        <div id="carousel" class="carousel slide" data-ride="carousel" data-page="home">
            <div class="carousel-inner">
                <div class="item active">
                    <video autobuffer autoplay loop id="bgvid" poster="/img/slider/coding.png">
                        <source type="video/webm" src="/img/slider/coding.webm">
                        <source type="video/mp4" src="/img/slider/coding.mp4">
                    </video>
                    <div class="container">
                        <div class="carousel-caption">
                            <span class="title">Webdevelopment &amp; webdesign</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="carousel-visible">
            <div class="container">
                <?php if(!empty($page->body)) { ?>
                <div class="row">
                    <div class="<?php echo (empty($page->body_sidebar) ? 'col-md-12' : 'col-md-8') ?>">
                        <div class="block">
                            <?php echo $page->body; ?>
                        </div>
                    </div>

                    <?php if(!empty($page->body_sidebar)) { ?>
                    <div class="col-md-4" id="sidebar">
                        <div class="block">
                            <?php echo $page->body_sidebar; ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <div class="row" id="portfolio">
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            foreach($portfolio as $item) {
                                echo '<div class="col-md-3 col-sm-6">
                                        <div class="block">
                                            <a href="/portfolio/' . $item->url . '" title="' . $item->title . '">
                                                <img src="/resize/340x240/uploads/portfolio/' . $item->thumbnail . '" alt="' . $item->title . '" class="img-responsive">
                                                <h3 class="title">' . $item->title . '</h3>
                                                <p class="description">' . (!empty($item->meta_description) ? $item->meta_description : substr(strip_tags($item->body), 0, 500)) . '</p>
                                            </a>
                                        </div>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>