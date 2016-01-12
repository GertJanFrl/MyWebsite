        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="block background" style="height: 330px; background-image: url('/resize/800x330/uploads/page/<?php echo $page->thumbnail; ?>');">
                                    <div class="text">
                                        <h3>Welkom bij de H. Jacobusparochie</h3>
                                        <?php echo $page->body; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            foreach ($blocks as $key => $block):
                                echo '<div class="col-lg-6 col-md-6 col-sm-6"><a href="/' . $block->url . '" class="block background" style="height: 300px; background-image: url(\'/resize/360x360/uploads/page/' . $block->thumbnail . '\');"><div class="text">';
                                echo '<h3>' . $block->title . '</h3>';
                                echo ($block->url != 'kerktelevisie' ? '<p>' . substr(strip_tags($block->body), 0, 350) . '</p>' : '');
                                echo '</div></a></div>';
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
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
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="block">
                                    <h3>Agenda</h3>
                                    <p>
                                        Hieronder ziet u de komende 5 agenda punten, voor een volledig overzicht kunt u <a href="/agenda" title="Agenda">hier</a> kijken.
                                    </p>
                                    <?php
                                    $client = new Google_Client();
                                    $client->setApplicationName("applicationname");
                                    $client->setDeveloperKey('developerkey');
                                    $cal = new Google_Service_Calendar($client);
                                    $calendarId = 'gmail@adres';
                                    $params = array(
                                        'singleEvents' => true,
                                        'orderBy' => 'startTime',
                                        'timeMin' => date(DateTime::ATOM),
                                        'maxResults' => 5

                                    );
                                    $events = $cal->events->listEvents($calendarId, $params);
                                    $calTimeZone = $events->timeZone;
                                    date_default_timezone_set($calTimeZone);
                                    foreach ($events->getItems() as $event):
                                        $eventDateStr = $event->start->dateTime;
                                        if(empty($eventDateStr))
                                        {
                                            $eventDateStr = $event->start->date;
                                        }
                                        $temp_timezone = $event->start->timeZone;
                                        if (!empty($temp_timezone))
                                        {
                                            $timezone = new DateTimeZone($temp_timezone);
                                        }
                                        else
                                        {
                                            $timezone = new DateTimeZone($calTimeZone);
                                        }
                                        $eventdate = new DateTime($eventDateStr,$timezone);
                                        $link = $event->htmlLink;
                                        $TZlink = $link . "&ctz=" . $calTimeZone;
                                        $newmonth = $eventdate->format("M");
                                        $newday = $eventdate->format("j");
                                        $time_start = $eventdate->format("H:i");
                                        ?>
                                        <div class="event-container">
                                            <div class="eventDate">
                                                <span class="month"><?php echo $newmonth; ?></span> <br />
                                                <span class="day"><?php echo $newday; ?></span>
                                                <span class="dayTrail"></span>
                                            </div>
                                            <div class="eventBody">
                                                <a href="/agenda/<?php echo $event->id; ?>"><?php echo $event->summary; ?></a> <br />
                                                Locatie: <?php echo $event->location; ?> <br />
                                                Begintijd: <?php echo $time_start; ?>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                    ?>
                                    <p><a href="/agenda" class="btn btn-anchor">Bekijk volledig agenda >></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
