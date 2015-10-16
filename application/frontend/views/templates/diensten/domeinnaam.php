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
                        <div class="block">
                            <?php echo $page->body; ?> 
                        </div>
                        <div class="row">
                            <?php foreach ($domeinen as $domein) { ?>
                                <div class="col-md-4">
                                    <a>
                                        <div class="block">
                                            <h3><strong>.<?php echo $domein->tld; ?></strong></h3>
                                            <table style="width: 100%;">
                                                <?php
                                                if (($domein->price/100) == ($domein->price_renewal/100))
                                                {
                                                    echo '<tr>
                                                            <td>Prijs</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&euro; ' . number_format(($domein->price/100), 2, ',', ' ') . ($domein->registration_length > 1 ? ' <small>iedere ' . $domein->registration_length . ' jaar</small>' : '<smaller> ieder jaar</smaller>') . '</td>
                                                        </tr>';
                                                }
                                                else
                                                {
                                                    echo '<tr>
                                                            <td>Prijs</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&euro; ' . number_format(($domein->price/100), 2, ',', ' ') . ' <small>daarna &euro; ' . number_format(($domein->price_renewal/100), 2, ',', ' ') . ' per jaar</small></td>
                                                        </tr>';
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="2">
                                                        <small>Minimaal <?php echo $domein->registration_length; ?> jaar</small>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <?php echo $links; ?>
                    </div>

                    <div class="col-md-4 col-sm-4" id="sidebar">
                        <div class="block">
                            <h2>Populaire extensies</h2>
                            <table>
                                <tr>
                                    <th>TLD</th>
                                    <th style="text-align: right;">Prijs *</th>
                                    <th style="text-align: right;">Verlenging</th>
                                </tr>
                            <?php foreach ($domeinen_popular as $domein) { ?>
                                <tr>
                                    <td>.<?php echo $domein['tld']; ?></td>
                                    <td style="text-align: right;">&euro; <?php echo number_format(($domein['price']/100), 2, ',', ' '); ?></td>
                                    <td style="text-align: right;">&euro; <?php echo number_format(($domein['price_renewal']/100), 2, ',', ' '); ?></td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td colspan="3"><small>* Prijs voor eerste jaar</small></td>
                                </tr>
                            </table>
                        </div>
                        <?php if(!empty($page->body_sidebar)) { ?>
                        <div class="block">
                            <?php echo $page->body_sidebar; ?>
                        </div>
                        <?php } ?>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/extra/sidebar.php'; ?>
                    </div>
                </div>