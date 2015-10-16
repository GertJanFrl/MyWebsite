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

        <div id="content" class="carousel-visible">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <?php echo $page->body; ?> 
                        </div>
                    </div>
                </div>

                <div class="row" id="portfolio">
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            foreach($portfolio as $item) {
                                // echo '<div class="col-md-6 col-sm-6">
                                //         <div class="block">
                                //             <a href="/portfolio/' . $item->url . '" title="' . $item->title . '">
                                //                 <img src="/resize/200x100/uploads/portfolio/' . $item->thumbnail . '" alt="' . $item->title . '" class="img-responsive" style="float: left; padding-right: 15px;">
                                //                 <h3 class="title">' . $item->title . '</h3>
                                //                 <p class="description">' . (!empty($item->meta_description) ? $item->meta_description : substr(strip_tags($item->body), 0, 500)) . '</p>
                                //             </a>
                                //         </div>
                                //     </div>';
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
                        <?php echo $links; ?>
                    </div>
                </div>