<?php $this->load->helper('form'); ?>

        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <?php
                        if($this->session->flashdata('success')) {
                            echo '<div class="block alert alert-default">Uw vraag of opmerking is succesvol verzonden, wij zullen zo spoedig mogelijk contact met u opnemen.</div>';
                        }
                        if(!empty($post_return)) {
                            echo '<div class="block alert alert-default">* ' . $post_return . '</div>';
                        }
                        ?>
                        <div class="block">
                            <h1><?php echo $page->title; ?></h1>
                            <?php echo $page->body; ?> 
                            <?php echo form_open(base_url() . 'contact', array('class' => 'contact-form')); ?>
                            <div class="form-group">
                                <label for="contactNaam">Naam *</label>
                                <input type="text" class="form-control" name="contactNaam" id="contactNaam" value="<?php echo (!empty($_POST['contactNaam']) ? $_POST['contactNaam'] : ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contactEmailadres">E-mailadres *</label>
                                <input type="email" class="form-control" name="contactEmailadres" id="contactEmailadres" value="<?php echo (!empty($_POST['contactEmailadres']) ? $_POST['contactEmailadres'] : ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contactSubject">Onderwerp</label>
                                <input type="text" class="form-control" name="contactSubject" id="contactSubject" value="<?php echo (!empty($_POST['contactSubject']) ? $_POST['contactSubject'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="contactTelefoon">Telefoonnummer</label>
                                <input type="tel" class="form-control" name="contactTelefoon" id="contactTelefoon" value="<?php echo (!empty($_POST['contactTelefoon']) ? $_POST['contactTelefoon'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="contactMessage">Uw vraag of opmerking *</label>
                                <textarea name="contactMessage" class="form-control" id="contactMessage" rows="5" required><?php echo (!empty($_POST['contactMessage']) ? $_POST['contactMessage'] : ''); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Anti-spam beveiliging *</label>
                                <div class="g-recaptcha" data-sitekey="6Le6NwATAAAAAGCZiPbKnM_j1MNoK8jtcD-N9z9k"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-submit btn-lg">Verzend het formulier</button>
                            </div>
                            <?php echo form_close(); ?> 
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4" id="sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="block">
                                    <h3>Agenda</h3>
                                    <p>
                                        Hieronder ziet u de komende 5 agenda punten, voor een volledig overzicht kunt u <a href="/agenda" title="Agenda">hier</a> kijken.
                                    </p>
                                    <?php
                                    $client = new Google_Client();
                                    $client->setApplicationName("HeiligejacobusparochieCalendar");
                                    $client->setDeveloperKey('AIzaSyBpW8Jz0gIIdVYflGStfXMqptPjiKB2kCQ');
                                    $cal = new Google_Service_Calendar($client);
                                    $calendarId = 'jacobmeerdere@gmail.com';
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
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/extra/sidebar.php'; ?>
                        <?php if(!empty($page->body_sidebar)) { ?>
                        <div class="block">
                            <?php echo $page->body_sidebar; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>