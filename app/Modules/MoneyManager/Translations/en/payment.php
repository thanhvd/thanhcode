<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'index' => [
        'title' => 'Payments list',
        'table' => [
            'head' => [
                'name' => 'Name',
                'avatar' => 'Avatar',
                'parent' => 'Parent'
            ]
        ],
        'confirm_message' => 'Are you sure you want to delete this payment?'
    ],
    'create' => [
        'title' => 'Create new Payment',
        'page_header' => 'Payment',
        'page_header_description' => 'Create',
        'labels' => [
            'name' => 'Name',
            'avatar' => 'Avatar',
            'parent' => 'Parent',
            'select_parent' => 'Select parent'
        ],
        'placeholders' => [ 'name' => 'Enter name' ],
        'descriptions' => [ 'avatar' => 'Upload avatar of this payment' ],
        'buttons' => [ 'submit' => 'Submit' ],
        'success' => 'Successfully created payment'
    ],
    'edit' => [
        'title' => 'Edit new Payment',
        'page_header' => 'Payment',
        'page_header_description' => 'Edit',
        'labels' => [
            'name' => 'Name',
            'avatar' => 'Avatar',
            'parent' => 'Parent',
            'select_parent' => 'Select parent'
        ],
        'placeholders' => [ 'name' => 'Enter name' ],
        'descriptions' => [ 'avatar' => 'Upload avatar of this payment' ],
        'buttons' => [ 'submit' => 'Submit' ],
        'success' => 'Successfully edited payment'
    ],
    'delete' => [
        'success' => 'Successfully deleted payment',
        'children_exists' => 'Please delete children before delete this payment'
    ]

];
