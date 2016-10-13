<?php

return [
    'index' => [
        'title' => 'Categories list',
        'page_header' => 'Category',
        'page_header_description' => 'Index',
        'table' => [
            'head' => [
                'name' => 'Name',
                'avatar' => 'Avatar',
                'parent' => 'Parent'
            ],
            'no_data' => 'No category found'
        ],
        'confirm_message' => 'Are you sure you want to delete this category?'
    ],
    'create' => [
        'title' => 'Create new Category',
        'page_header' => 'Category',
        'page_header_description' => 'Create',
        'labels' => [
            'name' => 'Name',
            'avatar' => 'Avatar',
            'parent' => 'Parent',
            'select_parent' => 'Select parent'
        ],
        'placeholders' => [ 'name' => 'Enter name' ],
        'descriptions' => [ 'avatar' => 'Upload avatar of this category' ],
        'buttons' => [ 'submit' => 'Submit' ],
        'success' => 'Successfully created category'
    ],
    'edit' => [
        'title' => 'Edit new Category',
        'page_header' => 'Category',
        'page_header_description' => 'Edit',
        'labels' => [
            'name' => 'Name',
            'avatar' => 'Avatar',
            'parent' => 'Parent',
            'select_parent' => 'Select parent'
        ],
        'placeholders' => [ 'name' => 'Enter name' ],
        'descriptions' => [ 'avatar' => 'Upload avatar of this category' ],
        'buttons' => [ 'submit' => 'Submit' ],
        'success' => 'Successfully edited category'
    ],
    'delete' => [
        'success' => 'Successfully deleted category',
        'children_exists' => 'Please delete children before delete this category'
    ]

];
