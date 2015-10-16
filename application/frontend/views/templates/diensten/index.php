    <?php if(!empty($page->thumbnail)) { ?>
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/resize/7000x700/uploads/page/<?php echo $page->thumbnail; ?>" alt="<?php echo $page->title; ?>" class="img-responsive">
                </div>
            </div>
        </div>
    <?php } else { ?>
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
    <?php } ?>

        <div id="content" class="carousel-visible">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <?php foreach ($diensten as $dienst) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="block">
                                        <h2><?php echo $dienst->title; ?></h2>
                                        <p><?php echo strip_tags(substr($dienst->body, 0, 350)); ?>&hellip;</p>
                                        <a href="/diensten/<?php echo $dienst->url; ?>" title="Bekijk dienst" class="btn btn-anchor">Bekijk dienst</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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