<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'active' => 'categories.*',
        'ability' => 'categories.view',
    ],
    [
        'icon' => 'fas fa-box nav-icon',
        'route' => 'products.index',
        'title' => 'Products',
        'active' => 'products.*',
        'ability' => 'products.view',
    ],
    [
        'icon' => 'fas fa-receipt nav-icon',
        'route' => 'categories.index',
        'title' => 'Orders',
        'active' => 'orders.*',
        'ability' => 'orders.view',
    ],

    [
        'icon' => 'fas fa-receipt nav-icon',
        'route' => 'brands.index',
        'title' => 'brands',
        'active' => 'brands.*',
        'ability' => 'brands.view',
    ],
    // [
    //     'icon' => 'fas fa-shield nav-icon',
    //     'route' => 'roles.index',
    //     'title' => 'Roles',
    //     'active' => 'roles.*',
    //     'ability' => 'roles.view',
    // ],
    // [
    //     'icon' => 'fas fa-users nav-icon',
    //     'route' => 'users.index',
    //     'title' => 'Users',
    //     'active' => 'users.*',
    //     'ability' => 'users.view',
    // ],
    // [
    //     'icon' => 'fas fa-users nav-icon',
    //     'route' => 'admins.index',
    //     'title' => 'Admins',
    //     'active' => 'admins.*',
    //     'ability' => 'admins.view',
    // ],
];
