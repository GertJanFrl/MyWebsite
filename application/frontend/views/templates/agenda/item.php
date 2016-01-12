<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="block">
                    <div class="event-container">
                        <div class="eventDate">
                            <span class="month"><?php echo $month; ?></span> <br />
                            <span class="day"><?php echo $day; ?></span>
                            <span class="dayTrail"></span>
                        </div>
                        <div class="eventBody">
                            <h3><?php echo $event->summary; ?></h3>
                            <?php echo (!empty($event->description) ? '<p>' . nl2br($event->description) . '</p>' : ''); ?>
                            <?php echo (!empty($event->location) ? '<p>Locatie: ' .$event->location . '</p>' : ''); ?>
                            <p>
                                Starttijd: <?php echo $time_start; ?> <br />
                                Eindtijd: <?php echo $time_end; ?>
                            </p>
                        </div>
                    </div>
                </div>
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