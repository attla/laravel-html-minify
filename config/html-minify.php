<?php

return [

    // enable the minifier
    'enable' => env('HTML_MINIFY', true),

    // preserve the html comments
    'preserve_comments' => env('HTML_MINIFY_COMMENTS', false),

    // reserve the html contidional comments
    'preserve_conditional_comments' => env('HTML_MINIFY_CONDITIONAL_COMMENTS', true),
];
