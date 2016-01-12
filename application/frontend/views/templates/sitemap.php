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
                    <div class="col-md-8 col-sm-8">
                        <div class="block">
                            <ul>
                                <?php if(count($pages)): foreach($pages as $page): ?>
                                <li>
                                    <a href="/<?php echo $page->url; ?>" alt="<?php echo (!empty($page->meta_title) ? $page->meta_title : $page->title); ?>">
                                        <?php echo (!empty($page->meta_title) ? $page->meta_title : $page->title); ?>
                                    </a>
                                    <?php
                                    if($page->url == 'portfolio') {
                                        foreach ($portfolio as $key => $item) {
                                            ?>
                                            <ul>
                                            <li>
                                                <a href="/<?php echo $page->url; ?>/<?php echo $item->url; ?>" alt="<?php echo (!empty($item->meta_title) ? $item->meta_title : $item->title); ?>">
                                                    <?php echo (!empty($item->meta_title) ? $item->meta_title : $item->title); ?>
                                                </a>
                                            </li>
                                            </ul>
                                            <?php
                                        }
                                    }
                                    foreach ($pages_sub as $key => $page_sub) {
                                        if($page_sub->id_parent == $page->id) {
                                            ?>
                                            <ul>
                                            <li>
                                                <a href="/<?php echo $page->url; ?>/<?php echo $page_sub->url; ?>" alt="<?php echo (!empty($page_sub->meta_title) ? $page_sub->meta_title : $page_sub->title); ?>">
                                                    <?php echo (!empty($page_sub->meta_title) ? $page_sub->meta_title : $page_sub->title); ?>
                                                </a>
                                            </li>
                                            </ul>
                                            <?php
                                        }
                                    }
                                    ?>
                                </li>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <li>Geen resultaten gevonden.</li>
                                <?php endif; ?> 
                                </ul>
                                <div class="clear"></div>
                            </div>
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