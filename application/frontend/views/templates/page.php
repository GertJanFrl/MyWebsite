    <?php if(!empty($page->thumbnail) && (empty($page->id_parent) || $page->id_parent == '6')) { ?>
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active" style="background: url(/resize/7000x1000/uploads/page/<?php echo $page->thumbnail; ?>) no-repeat; background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
            </div>
        </div>
    <?php } ?>

        <div id="content" class="<?php echo ((!empty($page->thumbnail) && (empty($page->id_parent) || $page->id_parent == '6')) ? 'carousel-visible' : ''); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <div class="block">
                            <h1><?php echo $page->title; ?></h1>
                            <?php if (!empty($page->thumbnail) && (!empty($page->id_parent) && $page->id_parent != '6')): ?><img src="/resize/250x300/uploads/page/<?php echo $page->thumbnail; ?>" alt="<?php echo $page->title; ?>" class="img-responsive article-image-left"><?php endif; ?>
                            <?php echo $page->body; ?>
                            <div class="clear"></div>
                        </div>
                        <?php if ($page->url == 'kerktelevisie'): ?>
                            <div class="block">
                                <script type="text/javascript" src="http://hdtv.webcam.nl/website/rw_common/themes/bravo/javascript.js"></script>
                                <script type="text/javascript" src="http://hdtv.webcam.nl/kerk/swfobject.js"></script>
                                <div id='mediaspace'>Helaas ondersteunt uw browser geen flash, dit kunt u downloaden via <a href="http://adobe.com/flashplayer/">http://adobe.com/flashplayer/</a>. Of u kunt andere mogelijkheden vinden op <a href="http://hdtv.webcam.nl/kerk/">http://hdtv.webcam.nl/kerk/</a>.</div>
                                <script type='text/javascript'>
                                    var so = new SWFObject('http://hdtv.webcam.nl/kerk/player.swf','mpl','100%','470','9');
                                    so.addParam('allowfullscreen','true');
                                    so.addParam('allowscriptaccess','always');
                                    so.addParam('wmode','opaque');
                                    so.addVariable('file','http://content.longtailvideo.com/videos/flvplayer.flv');
                                    so.addVariable('streamer','rtmp://streaming4.webcam.nl:80/franciscuskerk');
                                    so.addVariable('skin','http://hdtv.webcam.nl/kerk/glow.zip');
                                    so.addVariable('image','videoserver.gif');
                                    so.addVariable('stretching','exactfit');
                                    so.addVariable('file','franciscuskerk.stream&amp;autostart=true');
                                    so.write('mediaspace');
                                </script>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4 col-sm-4" id="sidebar">
                        <?php if(!empty($page->body_sidebar)) { ?>
                        <div class="block">
                            <?php echo $page->body_sidebar; ?>
                        </div>
                        <?php } ?>
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
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/extra/sidebar.php'; ?>
                    </div>
                </div>