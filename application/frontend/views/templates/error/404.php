        <div id="carousel" class="carousel slide small" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/resize/7000x150/slider/coding.png" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Pagina niet gevonden</h1>
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
                            <p>Helaas hebben wij deze pagina niet voor u kunnen vinden, dit kan de volgende redenen hebben:</p>
                            <ul>
                                <li>De URL van de pagina is verkeerd</li>
                                <li>De pagina is verwijderd</li>
                                <li>Er worden momenteel werkzaamheden aan deze pagina uitgevoerd</li>
                            </ul>

                            <p>Probeert u anders te zoeken naar de pagina die u bedoeld?</p>
                            <div id="search-wrapper">
                                <?php echo form_open(base_url() . 'zoeken'); ?>
                                    <input type="text" name="q" placeholder="Uw zoekterm..." class="form-control" />
                                <?php echo form_close(); ?> 
                            </div>
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
