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
                            <?php echo $page->body; ?> 
                        </div>
                        <?php if(!empty($page->body_sidebar)) { ?>
                        <div class="block">
                            <?php echo $page->body_sidebar; ?>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-4 col-sm-4" id="sidebar">
                        <div class="block">
                            <p>
                                <a class="fancybox" href="/img/uploads/page/<?php echo $page->thumbnail; ?>" title="Gert-Jan Anema">
                                    <img alt="Gert-Jan Anema" class="img-responsive" src="/resize/340x340/uploads/page/<?php echo $page->thumbnail; ?>" />
                                </a>
                            </p>
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/extra/sidebar.php'; ?>
                    </div>
                </div>