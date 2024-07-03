<?php
/*
Plugin Name: MOTD
Plugin URI: https://github.com/bretterer/wp-test-updating
Description: Lets see if this works now.  This is just a test!
Author: Brian Retterer
Version: 0.2.0
Author URI: https://bretterer.com
*/

include __DIR__."/githubPluginUpdater.php";
new GithubPluginUpdater('bretterer/wp-test-updating');

function motd_message() {
    $messages = [
        "The journey of a thousand miles begins with a single step.",
        "Believe you can and you're halfway there.",
        "Your only limit is your mind.",
        "Every day is a fresh start.",
        "Happiness is not by chance, but by choice.",
        "Don't watch the clock; do what it does. Keep going.",
        "Small things make a big difference.",
        "The best view comes after the hardest climb.",
        "Inhale courage, exhale fear.",
        "You are capable of amazing things."
    ];

    return wptexturize( $messages[ mt_rand( 0, count( $messages ) - 1 ) ] );
}

function motd() {
    $chosen = motd_message();

    $lang = '';
    if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
        $lang = ' lang="eng"';
    }

    printf(
        '<p id="motd"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
        __( 'MOTD:', 'motd' ),
        $lang,
        $chosen
    );
}

add_action( 'admin_notices', 'motd' );

function motd_css() {
    echo "
    <style type='text/css'>
    #motd {
        float: right;
        padding: 5px 10px;
        margin: 0;
        font-size: 12px;
        line-height: 1.6666;
    }
    .rtl #motd {
        float: left;
    }
    .block-editor-page #motd {
        display: none;
    }
    @media screen and (max-width: 782px) {
        #motd,
        .rtl #motd {
            float: none;
            padding-left: 0;
            padding-right: 0;
        }
    }
    </style>
    ";
}

add_action( 'admin_head', 'motd_css' );