<?php
define('STRING_TODAY',     "today");
define('STRING_YESTERDAY', "yesterday");
define('STRING_DAYS',      "%d days ago");
define('STRING_WEEK',      "1 week ago");
define('STRING_WEEKS',     "%d weeks ago");
define('DATE_FORMAT',      "m-d-Y");

    /* Private functions */
    function get_link($text) {
        preg_match_all('!https?://\S+!', $text, $matches);
        return $matches[0][0];
    }

    function getUrl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $a = curl_exec($ch);
        return get_link($a);
    }
    
    function get_news($url) {
        $response = Unirest\Request::get($url, 
                                         array("Accept" => "application/json"));

        return ($response);

    }
    
    /* The functions takes the date as a timestamp */        
    function date_to_words($pubDate)
    {
        $date = new DateTime($pubDate);
        $time = $date->getTimestamp();
        $_word = "";

        /* Get the difference between the current time 
           and the time given in days */
        $days = intval((time() - $time) / 86400);

        /* If some forward time is given return error */
        if($days < 0) {
            return -1;
        }

        switch($days) {
            case 0: $_word = STRING_TODAY;
                    break;
            case 1: $_word = STRING_YESTERDAY;
                    break;
            case ($days >= 2 && $days <= 6): 
                  $_word =  sprintf(STRING_DAYS, $days);
                  break;
            case ($days >= 7 && $days < 14): 
                  $_word= STRING_WEEK;
                  break;
            case ($days >= 14 && $days <= 365): 
                  $_word =  sprintf(STRING_WEEKS, intval($days / 7));
                  break;
            default : return date(DATE_FORMAT, $time);

        }

        return $_word;
    }
?>