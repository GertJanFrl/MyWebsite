        <div id="carousel" class="carousel slide small" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/resize/7000x150/slider/coding.png" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1><?php echo $item->title; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="carousel-visible">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="block">
                            <?php echo $item->body; ?> 
                        </div>
                    </div>

                    <div class="col-md-4" id="sidebar">
                        <div class="block">
                            <a class="fancybox" href="/img/uploads/portfolio/<?php echo $item->thumbnail; ?>" title="<?php echo $item->title; ?>">
                                <img src="/resize/340x240/uploads/portfolio/<?php echo $item->thumbnail; ?>" alt="<?php echo $item->title; ?>" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>

                <?php if(count($item->images) > 0) { ?>
                <div class="row" id="gallery">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Impressies</h5>
                            </div>
                        </div>
                        <div class="row">
                        <?php
                        foreach($item->images as $image) {
                            echo '
                            <div class="col-md-3 col-sm-6">
                                <div class="block">
                                    <a class="fancybox" href="/img/uploads/portfolio/gallery/' . $image->image . '" data-fancybox-group="gallery" title="' .  $item->title . ': ' . $image->title . '">
                                        <img src="/resize/340x240/uploads/portfolio/gallery/' . $image->image . '" alt="' . $item->title . ': ' . $image->title . '" class="img-responsive">
                                        <h3 class="title">' . $image->title . '</h3>
                                    </a>
                                </div>
                            </div>';
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="row" id="portfolio">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Recente afgeronde projecten</h5>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            foreach($portfolio as $item) {
                                echo '<div class="col-md-3 col-sm-6">
                                        <div class="block">
                                            <a href="/portfolio/' . $item->url . '">
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