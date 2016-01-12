        <div id="carousel" class="carousel slide small" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/resize/7000x150/slider/coding.png" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1><?php echo $page->title; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="carousel-visible zoeken">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="block">
                                    <?php echo $page->body; ?>
                                    <div id="search-wrapper">
                                        <?php echo form_open(base_url() . 'zoeken'); ?>
                                            <input type="text" name="q" placeholder="Uw zoekterm..." class="form-control" />
                                        <?php echo form_close(); ?> 
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>

                        <?php 
                        if(!empty($this->uri->segment(2))) {
                            if($results == 0) {
                                echo '<div class="row">
                                        <div class="col-md-12">
                                            <div class="block">
                                                <p>Er zijn helaas geen zoekresultaten gevonden voor uw zoekterm. Probeert u het alstublieft opnieuw met het bovenstaande formulier.</p>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            if(!empty($articles)) { 
                                foreach($articles as $item) {
                                    echo '<div class="row">
                                            <div class="col-md-12">
                                                <div class="block">
                                                    <h1>' . $item->title . '</h1>
                                                    <p>'. substr(strip_tags($item->body), 0, 500) . '</p>
                                                    <p><a href="/' . $item->url . '" title="' . $item->title . '">Bekijk artikel</a></p>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            }
                            if(!empty($pages)) { 
                                foreach($pages as $item) {
                                    echo '<div class="row">
                                            <div class="col-md-12">
                                                <div class="block">
                                                    <h1><a href="/' . $item->url . '" title="' . $item->title . '">' . $item->title . '</a></h1>
                                                    <p>'. substr(strip_tags($item->body), 0, 500) . '</p>
                                                    <p><a href="/' . $item->url . '" title="' . $item->title . '">Bekijk pagina</a></p>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            }
                            if(!empty($pages_sub)) { 
                                foreach($pages_sub as $item) {
                                    echo '<div class="row">
                                            <div class="col-md-12">
                                                <div class="block">
                                                    <h1><a href="/' . $item->url . '" title="' . $item->title . '">' . $item->title . '</a></h1>
                                                    <p>'. substr(strip_tags($item->body), 0, 500) . '</p>
                                                    <p><a href="/' . $item->url . '" title="' . $item->title . '">Bekijk pagina</a></p>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            }
                            if(!empty($portfolio)) { 
                                foreach($portfolio as $item) {
                                    echo '<div class="row">
                                            <div class="col-md-12">
                                                <div class="block">
                                                    <img src="/resize/140x140/uploads/portfolio/' . $item->thumbnail . '" alt="' . $item->title . '" class="img-responsive" style="float: right;">
                                                    <h1><a href="/portfolio/' . $item->url . '" title="' . $item->title . '">' . $item->title . '</a></h1>
                                                    <p>'. substr(strip_tags($item->body), 0, 500) . '</p>
                                                    <p><a href="/portfolio/' . $item->url . '" title="' . $item->title . '">Bekijk portfolio item</a></p>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            }
                        }
                        ?>
                    </div>

                    <div class="col-md-4 col-sm-4" id="sidebar">
                        <?php if(!empty($page->body_sidebar)) { ?>
                        <div class="block">
                            <?php echo $page->body_sidebar; ?>
                        </div>
                        <?php } ?>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/extra/sidebar.php'; ?>
                    </div>
                </div>

                <?php if(!empty($portfolio) && empty($this->uri->segment(2))) { ?><div class="row" id="portfolio">
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
                </div><?php } ?>