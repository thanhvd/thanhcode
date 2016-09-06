<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Categories
Breadcrumbs::register('categories.index', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Categories Index', route('categories.index'));
});

Breadcrumbs::register('categories.create', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Categories Create', route('categories.create'));
});
