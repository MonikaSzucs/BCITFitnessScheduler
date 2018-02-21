<?php
    // Refer to the PHP quickstart on how to setup the environment:
    // https://developers.google.com/google-apps/calendar/quickstart/php
    // Change the scope to Google_Service_Calendar::CALENDAR and delete any stored
    // credentials.

    $event = new Google_Service_Calendar_Event(array(
        'summary' => 'Tai Chi',
        'location' => '3700 Willingdon Ave, Burnaby, BC V5G 3H2',
        'description' => 'an internal Chinese martial art practiced for both its defense training and its health benefits. The term taiji refers to a philosophy of the forces of yin and yang, related to the moves. Though originally conceived as a martial art, it is also typically practiced for a variety of other personal reasons: competitive wrestling in the format of pushing hands , demonstration competitions, and achieving greater longevity. As a result, a multitude of training forms exist, both traditional and modern, which correspond to those aims with differing emphasis. Some training forms of are especially known for being practiced with relatively slow movements.',
        'start' => array(
        'dateTime' => '2018-02-23T13:00:00-08:00',
        'timeZone' => 'America/Vancouver',
      ),
      'end' => array(
        'dateTime' => '2018-02-23T14:00:00-08:00',
        'timeZone' => 'America/Vancouver',
      ),
      'attendees' => array(
        array('email' => 'darencapacio@gmail.com')
      ),
      'reminders' => array(
        'useDefault' => FALSE,
        'overrides' => array(
          array('method' => 'email', 'minutes' => 24 * 60),
          array('method' => 'popup', 'minutes' => 10),
        ),
      ),
    ));

    $calendarId = 'primary';
    $event = $service->events->insert($calendarId, $event);
    printf('Event created: %s\n', $event->htmlLink);
?>