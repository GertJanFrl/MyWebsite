<div id="content" class="agenda-overview">
    <div class="container">
        <div class="row nextprev">
            <div class="col-md-4">
                <div class="block">
                    <a href="/agenda/<?php echo $prevYear; ?>/<?php echo $prevMonth; ?>" class="btn btn-anchor"><< Vorige maand</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block">
                    <h3><?php echo $current; ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block">
                    <a href="/agenda/<?php echo $nextYear; ?>/<?php echo $nextMonth; ?>" class="btn btn-anchor">Volgende maand >></a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $i = 1;
            foreach ($events as $event):
                $eventDateStr = $event->start->dateTime;
                if(empty($eventDateStr))
                {
                    // it's an all day event
                    $eventDateStr = $event->start->date;
                }

                $eventdate = new DateTime($eventDateStr);
                //PREVENTS GOOGLE FROM DISPLAYING EVERYTHING IN GMT
                $newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
                $newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
                ?>
                <div class="col-md-4"><div class="block">
                    <div class="event-container">
                        <div class="eventDate">
                            <span class="month"><?php echo $newmonth; ?></span> <br />
                            <span class="day"><?php echo $newday; ?></span>
                            <span class="dayTrail"></span>
                        </div>
                        <div class="eventBody">
                            <a href="/agenda/<?php echo $event->id; ?>"><?php echo $event->summary; ?></a> <br />
                            <?php echo (!empty($event->location) ? 'Locatie: ' .$event->location : ''); ?>
                        </div>
                    </div>
                </div></div>
                <?php
                echo ( 0 ==$i%3 ? '</div><div class="row">' : '');
                $i++;
            endforeach;
            ?>
        </div>
