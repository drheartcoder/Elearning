<?php
return array(
    // set your paypal credential
    /* jait@web.... , jai@webwing*/
    /*'client_id'=>'AT0iR3o07ji3kQmdb-NyiyXQVVYRZ6EWLaInsDX1kki4KkcRAjhQmKjPksAJjbOslww9zFzGCyg4amI5',
    'secret' => 'ELWxXStDMmww2mqBHNo4iqukwkk-RVCuqYdFCzwWjCmbd9-qHq4YGV4s07BEbIFSGWw8ZEjjB-VX8Xmt',*/

    /*jayantm@webwingtechnologies.com ,  jayant@webwing*/
    'client_id' => 'AW07Mg4HcDnI01NjCwEl5ChUN1W3RS75_yiOJtzT8qCumSHvVYdO6awfojmjIrPseQqH4Zf-YCujsAWe',
    'secret' => 'ECqGVbPBuwft-LICTbfwSWAIRlZ0YHBqz0-9-PmiGOjATYfr4apvuylaB1D9sZn4Ek869MZwPyTHg71l',

    /*mayurip@webwingtechnologies.com ,  mayuri@webwing */
    /*'client_id' => 'EHBSsLoHuw35x4QZrwf4mZQfRA2qCcu5arYHnET26Exukw3hCAPTWcCBH2dDRyYdXdXcX1P-96AX42T1',
    'secret'=>'AWtTGwMhhPdvBKfwi4CRmI6fFeYe2YlFi0uosjkO2NxRJT6DqW-uuaBIgqcvz6HgjcQpY8tctd9kQCIH',*/

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);
