<?php
/** set your paypal credential **/

$config['client_id'] = 'Aa7r4GfojBCCe33MVyqkXEBatstL1i36ZQqidXwRe3RaEzzi-ZuAEII1o2WUcsGu7Td_DrbQfnjvKZRl';
$config['secret'] = 'EDGMapLc2S6M-In6U1g0cBs36qaYQWyoupglF5ScYYewNQo2AIJQnYMYmhSEQjFriY7wPEaUitoiFnf8';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'live',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
