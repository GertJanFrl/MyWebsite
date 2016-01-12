<?php

class Agenda extends Frontend_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('page_m');
        $this->load->model('article_m');
        // $this->output->cache(10);
        include($_SERVER['DOCUMENT_ROOT'] . '/system/Google/autoload.php');
    }

    public function index() {
        //TELL GOOGLE WHAT WE'RE DOING
        $client = new Google_Client();
        $client->setApplicationName("applicationname"); //DON'T THINK THIS MATTERS
        $client->setDeveloperKey('developerkey'); //GET AT AT DEVELOPERS.GOOGLE.COM
        $cal = new Google_Service_Calendar($client);
        //THE CALENDAR ID, FOUND IN CALENDAR SETTINGS. IF YOUR CALENDAR IS THROUGH GOOGLE APPS
        //YOU MAY NEED TO CHANGE THE CENTRAL SHARING SETTINGS. THE CALENDAR FOR THIS SCRIPT
        //MUST HAVE ALL EVENTS VIEWABLE IN SHARING SETTINGS.
        $calendarId = 'gmail@adres';

        $prevYear = ((date('m', time()) - 1) <= 0 ? (date('Y', time()) - 1) : (date('Y', time())));
        $prevMonth = ((date('m', time()) - 1) <= 0 ? '12' : (date('m', time()) - 1));

        $nextYear = ((date('m', time()) + 1) >= 13 ? (date('Y', time()) + 1) : (date('Y', time())));
        $nextMonth = ((date('m', time()) + 1) >= 13 ? '01' : (date('m', time()) + 1));

        $params = array(
            //CAN'T USE TIME MIN WITHOUT SINGLEEVENTS TURNED ON,
            //IT SAYS TO TREAT RECURRING EVENTS AS SINGLE EVENTS
            'singleEvents' => true,
            'orderBy' => 'startTime',
//            'timeMin' => (date('Y', time())) . '-' . (date('m', time())) . '-01T00:00:00+01:00',
            'timeMin' => date(DateTime::ATOM),
            'timeMax' => $nextYear . '-' . $nextMonth . '-01T00:00:00+01:00'

        );
        //THIS IS WHERE WE ACTUALLY PUT THE RESULTS INTO A VAR
        $events = $cal->events->listEvents($calendarId, $params);
        $calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR

        $this->data['prevYear'] = $prevYear;
        $this->data['prevMonth'] = sprintf("%02d", $prevMonth);

        $this->data['nextYear'] = $nextYear;
        $this->data['nextMonth'] = sprintf("%02d", $nextMonth);

        $this->data['events'] = $events;

        $this->data['subview'] = 'agenda/month';

        $dateObj   = DateTime::createFromFormat('!m', (date('m', time())));
        $monthName = strftime("%B", $dateObj->getTimestamp()); // March

        $this->data['current'] = ucfirst($monthName) . ' ' . $nextYear;

        add_meta_title(ucfirst($monthName) . ' ' . $nextYear . ' - Agenda overzicht', $this->data['subview']);
        add_meta_description('');

        $this->load->view('_main_layout', $this->data);
    }

    public function item() {
        // Sidebar nieuwsberichten
        $this->db->limit(5);
        $this->db->order_by('id', 'DESC');
        $this->db->where('active', '1');
        $this->data['articles'] = $this->article_m->get();

        //TELL GOOGLE WHAT WE'RE DOING
        $client = new Google_Client();
        $client->setApplicationName("HeiligejacobusparochieCalendar"); //DON'T THINK THIS MATTERS
        $client->setDeveloperKey('AIzaSyBpW8Jz0gIIdVYflGStfXMqptPjiKB2kCQ'); //GET AT AT DEVELOPERS.GOOGLE.COM
        $cal = new Google_Service_Calendar($client);
        //THE CALENDAR ID, FOUND IN CALENDAR SETTINGS. IF YOUR CALENDAR IS THROUGH GOOGLE APPS
        //YOU MAY NEED TO CHANGE THE CENTRAL SHARING SETTINGS. THE CALENDAR FOR THIS SCRIPT
        //MUST HAVE ALL EVENTS VIEWABLE IN SHARING SETTINGS.
        $calendarId = 'jacobmeerdere@gmail.com';

        $event = $cal->events->get($calendarId, $this->uri->segment(2), $optParams = array());
        if (!isset($event->error['code']) && $event->error['code'] != '404')
        {
            $calTimeZone = $event->timeZone;

            $this->data['event'] = $event;

            //Convert date to month and day
            $eventDateStr = $event->start->dateTime;
            if(empty($eventDateStr))
            {
                // it's an all day event
                $eventDateStr = $event->start->date;
            }

            //Convert date to month and day
            $eventDateStrEnd = $event->end->dateTime;
            if(empty($eventDateStrEnd))
            {
                // it's an all day event
                $eventDateStrEnd = $event->end->date;
            }

            $eventdate = new DateTime($eventDateStr,$calTimeZone);
            $eventdateEnd = new DateTime($eventDateStrEnd,$calTimeZone);
            $newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
            $newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
            $time_start = $eventdate->format("H:i");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
            $time_end = $eventdateEnd->format("H:i");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
            $this->data['fulldate'] = $eventdate;
            $this->data['month'] = $newmonth;
            $this->data['day'] = $newday;
            $this->data['time_start'] = $time_start;
            $this->data['time_end'] = $time_end;

            $this->data['subview'] = 'agenda/item';

            add_meta_title($event->summary . ' - Agenda', $this->data['subview']);
            add_meta_description('');
        }
        else
        {
            $this->output->set_status_header('404');

            add_meta_title('Geen agenda item gevonden', '');
            add_meta_description('');

            $this->data['subview'] = 'error/404';
        }

        $this->load->view('_main_layout', $this->data);
    }

    public function month() {
        //TELL GOOGLE WHAT WE'RE DOING
        $client = new Google_Client();
        $client->setApplicationName("HeiligejacobusparochieCalendar"); //DON'T THINK THIS MATTERS
        $client->setDeveloperKey('AIzaSyBpW8Jz0gIIdVYflGStfXMqptPjiKB2kCQ'); //GET AT AT DEVELOPERS.GOOGLE.COM
        $cal = new Google_Service_Calendar($client);
        //THE CALENDAR ID, FOUND IN CALENDAR SETTINGS. IF YOUR CALENDAR IS THROUGH GOOGLE APPS
        //YOU MAY NEED TO CHANGE THE CENTRAL SHARING SETTINGS. THE CALENDAR FOR THIS SCRIPT
        //MUST HAVE ALL EVENTS VIEWABLE IN SHARING SETTINGS.
        $calendarId = 'jacobmeerdere@gmail.com';

        $prevYear = (($this->uri->segment(3) - 1) <= 0 ? ($this->uri->segment(2) - 1) : $this->uri->segment(2));
        $prevMonth = (($this->uri->segment(3) - 1) <= 0 ? '12' : ($this->uri->segment(3) - 1));

        $nextYear = (($this->uri->segment(3) + 1) >= 13 ? ($this->uri->segment(2) + 1) : $this->uri->segment(2));
        $nextMonth = (($this->uri->segment(3) + 1) >= 13 ? '01' : ($this->uri->segment(3) + 1));

        $params = array(
            //CAN'T USE TIME MIN WITHOUT SINGLEEVENTS TURNED ON,
            //IT SAYS TO TREAT RECURRING EVENTS AS SINGLE EVENTS
            'singleEvents' => true,
            'orderBy' => 'startTime',
            'timeMin' => $this->uri->segment(2) . '-' . $this->uri->segment(3) . '-01T00:00:00+01:00',
            'timeMax' => $nextYear . '-' . $nextMonth . '-01T00:00:00+01:00'

        );
        //THIS IS WHERE WE ACTUALLY PUT THE RESULTS INTO A VAR
        $events = $cal->events->listEvents($calendarId, $params);
        $calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR

        $this->data['prevYear'] = $prevYear;
        $this->data['prevMonth'] = sprintf("%02d", $prevMonth);

        $this->data['nextYear'] = $nextYear;
        $this->data['nextMonth'] = sprintf("%02d", $nextMonth);

        $this->data['events'] = $events;

        $this->data['subview'] = 'agenda/month';

        $dateObj   = DateTime::createFromFormat('!m', $this->uri->segment(3));
        $monthName = strftime("%B", $dateObj->getTimestamp()); // March

        $this->data['current'] = ucfirst($monthName) . ' ' . $nextYear;

        add_meta_title(ucfirst($monthName) . ' ' . $nextYear . ' - Agenda overzicht', $this->data['subview']);
        add_meta_description('');

        $this->load->view('_main_layout', $this->data);
    }
}