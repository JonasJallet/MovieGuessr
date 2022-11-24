<?php

return [
    '' => ['HomeController', 'index',],
    'locations' => ['LocationController', 'index',],
    'locations/edit' => ['LocationController', 'edit', ['id']],
    'locations/show' => ['LocationController', 'show', ['id']],
    'locations/add' => ['LocationController', 'add',],
    'locations/delete' => ['LocationController', 'delete',],
];
