<?php

return [
    'index' => [
        'title' => 'Payments list',
        'page_header' => 'Payment',
        'page_header_description' => 'Index',
        'table' => [
            'head' => [
                'amount' => 'Amount',
                'paid_at' => 'Paid at',
                'note' => 'Note',
                'category' => 'Category',
            ]
        ],
        'confirm_message' => 'Are you sure you want to delete this payment?'
    ],
    'create' => [
        'title' => 'Create new Payment',
        'page_header' => 'Payment',
        'page_header_description' => 'Create',
        'labels' => [
            'amount' => 'Amount',
            'paid_at' => 'Paid at',
            'note' => 'Note',
            'category' => 'Category',
            'select_category' => 'Select category'
        ],
        'placeholders' => [
            'amount' => 'Enter Amount',
            'paid_at' => 'Enter Paid at',
            'note' => 'Enter Note'
        ],
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
