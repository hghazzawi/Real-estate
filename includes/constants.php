<?php 

/*database constants */

define("DB_HOST","127.0.0.1");
define("DB_NAME","ghazzawih_db");
define("DB_USER","ghazzawih");
define("DB_PASSWORD","100539306");


define ("SUPER","s");
define ("AGENT","a");
define ("PENDING_AGENT","p");
define ("CLIENT","c");
define ("DISABLED","d");


define ("CONTACT_BY_EMAIL",'e');
define ("CONTACT_BY_PHONE",'p');
define ("CONTACT_BY_MAIL",'l');


define ("LISTING_OPEN","o");
define ("LISTING_CLOSED","c");
define ("LISTING_DISABLED","d");
define ("LISTING_SOLD","s");


define ("DEFAULT_PROVINCE","ON");

define ("DEFAULT_CITY",8);

define ("COOKIE_DURATION",(86400 * 30));


/* Register page constants */

define("MINIMUM_ID_LENGTH",6);
define("MAXIMUM_ID_LENGTH",20);

define("MINIMUM_PASSWORD_LENGTH",8);
define("MAXIMUM_PASSWORD_LENGTH",16);

define("MIN_FIRST_NAME_LENGTH",1);
define("MAX_FIRST_NAME_LENGTH",25);

define("MIN_LAST_NAME_LENGTH",1);
define("MAX_LAST_NAME_LENGTH",50);

define ("MINIMUM_EMAIL_LENGTH",3);
define ("MAXIMUM_EMAIL_LENGTH",256);


define ("RESULTS_PER_PAGE",10);

define ("MAX_FILE_SIZE",100000);
define ("MAX_IMAGES",8);

define ("OPEN_REPORT",'o');
define ("CLOSED_REPORT",'c');





?>