#!/usr/bin/php
<?php
/*  CLI script to check domain expiry dates.
    Domain names with more days until expiry than threshold is marked green,
    otherwise it's marked in red.

    Copyright 2014 - Jack-Benny Persson <jack-benny@cyberinfo.se>
    Release under the GNU General Public Licence version 2, se LICENSE for 
    more information.

    Version: 0.1
*/

require("colors.php"); //A color-class
date_default_timezone_set('Europe/Stockholm'); //Change this to match your TZ 
$warnLevel = 30; //Numbers of days until warning

//List all the domains you want to check below
$domains = array("svt.se", "github.com", "sourceforge.net", 
                "wikipedia.org" ,"g.me");

//Let's iterate through all the domains
foreach($domains as $domain)
{
    $data = shell_exec("whois $domain");

    // For TLDs .org, .info
    if (preg_match("/(?:[-_a-z0-9])+(\.(org|info))+/i", $domain))
    {
        preg_match("/(Expiry Date:\s)([-0-9]+)/", $data, 
            $matches); //Second group is the date
    }
    // For TLDs .se, .net, .nu, .com, .me etc (trying to match all the rest)
    else 
    {
        preg_match("/(expir(?:es|y|ation)(?:[-:a-z\s])*)([-0-9a-z]+)/i", $data, 
            $matches); //Second group is the date
    }

    //Preparations needed for the calcultations
    $expiryDate = $matches[2]; //Second group is the date, see above
    $expiryUnixTime = strtotime($expiryDate) . "\n";
    $nowUnixTime = strtotime("now");

    //Calculate days to expire
    $diff =  $expiryUnixTime - $nowUnixTime;
    $days = $diff / 60 / 60 / 24; 

    $colors = new Colors; //Using the color class found on the net
    if ($days <= $warnLevel)
    {
        print $colors->getColoredString("$domain", "red");
    }
    else
    {
        print $colors->getColoredString("$domain", "green");
    }
    print (" will expire in ". floor($days) . " days.\n");
}

?>
