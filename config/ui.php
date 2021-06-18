<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stub Path
    |--------------------------------------------------------------------------
    |
    | This value is the path to the stubs the package should use when executing
    | various commands. To use your own stubs, make sure you vendor:publish the
    | package stubs and update this value to: resource_path('stubs/vendor/ui')
    |
    */

    'stub_path' => env('UI_STUB_PATH', base_path('vendor/bastinald/ui/resources/stubs')),

    /*
    |--------------------------------------------------------------------------
    | Font Awesome Style
    |--------------------------------------------------------------------------
    |
    | This value is the styling that Font Awesome icons use by default via the
    | x-ui::icon component. Using the regular or light variations require a
    | Font Awesome Pro license.
    |
    | Supported: "solid", "regular", "light"
    |
    */

    'font_awesome_style' => env('UI_FONT_AWESOME_STYLE', 'solid'),

];
