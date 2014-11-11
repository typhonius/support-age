<?php

add_header();

$supportians = array(
  "Adam Malone" => array("birth" => "10-5-2011", "uid" => 1295980,),
  "Alex Dicianu" => array("birth" => "01-01-2008",),
  "Alejandro Garza" => array("birth" => "11-06-2008", "uid" => 153120,),
  "Amy Qualls" => array("birth" => "01-10-2006", "uid" => 201481,),
  "Barrett Smith" => array("birth" => "01-03-2006"),
  "Byron Norris" => array("birth" => "11-12-2009", "uid" => 1284312,),
  "Chad Goodrum" => array("birth" => "01-10-2008", "uid" => 402998,),
  "Char Cotrill" => array("birth" => "13-02-2008"),
  "Chris Hoffman" => array("birth" => "04-01-2011",),
  "Chris O'Neill" => array("birth" => "01-01-2007",),
  "Daniel Blomqvist" => array("birth" => "12-12-2011",),
  "Drew Webber" => array("birth" => "01-02-2006", "uid" => 255969,),
  "Gord Christmas" => array("birth" => "01-11-2005",),
  "Jamie Meredith" => array("birth" => "01-03-2005",),
  "Jacqi Jordan" => array("birth" => "20-09-2010",),
  "Jess Straatmann" => array("birth" => "01-02-2007",),
  "John Takousis" => array("birth" => "01-09-2011", "uid" => 1792608),
  "Jon Muir" => array("birth" => "11-01-2007", "uid" => 100919),
  "Jonathan Webb" => array("birth" => "29-05-2006", "uid" => 61512),
  "Matt Koltermann" => array("birth" => "01-09-2010"),
  "Matt Lucasiewicz" => array("birth" => "03-09-2011"),
  "Niels van Mourik" => array("birth" => "01-02-2007"),
  "Omar Bickell" => array("birth" => "01-11-2001"),
  "Sam Lerner" => array("birth" => "20-01-2007",),
  "Simon Cooper" => array("birth" => "01-10-2007",),
  "Scott Reese" => array("birth" => "10-02-2008",),
  "Scott Rouse" => array("birth" => "02-12-2007",),
  "Steve Cronen-Townsend" => array("birth" => "16-01-2009",),
  "Tim Millwood" => array("birth" => "01-01-2008"),
);

foreach ($supportians as $supportian => $info) {
  print wrap_field('person', $supportian, $info) . wrap_field('time', $info["birth"]);
}

add_footer();

function wrap_field($type, $data, $info = NULL) {
  switch ($type) {
    case 'person';
      if (isset($info["uid"]) && is_numeric($info["uid"])) {
        $data = '<a href="https://drupal.org/user/' . $info["uid"] . '" target="_blank" itemprop="url">' . $data . '</a>';
      }
      return '<div class="supportian" itemscope itemtype="http://schema.org/Person"><span itemprop="name">' . $data . '</span></div>';
      break;

    case 'time';
      // date should be PnYnMnD
      list($duration, $start) = get_duration($data);
      return '<div class="duration" itemscope itemtype="http://schema.org/Event"><meta itemprop="unix" content="' . $start . '" /><meta itemprop="duration" content="' . $duration . '" /><span class="age">' .  $start . '</span></div>';
      break;

    default;
    return '';
  }
}

function get_duration($date) {
  $d1 = new DateTime();
  $d2 = new DateTime($date);
  $diff = $d2->diff($d1);

  return array($diff->format('P%yY%mM%dD'), strtotime($date));

}

function add_header() {
  $header = '<html><head>';
  $header .= '<title>Supportian Experience | glo5</title>';
  $header .= '<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>';
  $header .= '<script src="/countdown.min.js"></script>';
  $header .= '<script src="/ages.js"></script>';
  $header .= '<style type="text/css">
                .supportian {float:left; padding-right:1em;}
                .supportian::after {content:": ";}
                .totalskillz {padding-top:2em;}
              </style>';
  $header .= '</head><body>';

  $header .= "<h2>Supportian Ages</h2>";
  $header .= "<p>Using the first install of Drupal or registration on Drupal.org as 'birth', this script calculates the singular and cumulative experience of Acquia Supportians.</p>";

  echo $header;
}

function add_footer() {
  $footer = '<div class="totalskillz">Combined experience: <span></span></div>';
  $footer .= '</body>';

  echo $footer;
}
