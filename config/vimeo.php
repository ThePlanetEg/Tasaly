<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id' => 'd5bb618972bc696250ebe7e93110f0f2b0b9f696',
            'client_secret' => 'uiEK+CY1MNWNgBkYKXCZe8vjoPTE5lTrlbKzujhTOPUIZHlqOSSYUZC5iM3TX5fQl4q3Et0vFj9DlV9tJYlylhSozgmIGQDxXTWm7HumRN2h8xO2COdLVBPytDzaJysb',
            'access_token' => '73a174027414eca798d4deb7b779d9e6',
        ],

        'alternative' => [
            'client_id' => 'd5bb618972bc696250ebe7e93110f0f2b0b9f696',
            'client_secret' => 'uiEK+CY1MNWNgBkYKXCZe8vjoPTE5lTrlbKzujhTOPUIZHlqOSSYUZC5iM3TX5fQl4q3Et0vFj9DlV9tJYlylhSozgmIGQDxXTWm7HumRN2h8xO2COdLVBPytDzaJysb',
            'access_token' => '73a174027414eca798d4deb7b779d9e6',
        ],

    ],

];
