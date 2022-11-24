<?php

return [
    '' => ['HomeController', 'index',],
    'questions' => ['LocationController', 'show'],
    'locations' => ['LocationController', 'index',],
    'locations/edit' => ['LocationController', 'edit', ['id']],
    'locations/add' => ['LocationController', 'add',],
    'locations/delete' => ['LocationController', 'delete',],
];
