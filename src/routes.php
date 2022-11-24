<?php

return [
    '' => ['HomeController', 'index',],
    'questions' => ['LocationController', 'questionsPage'],
    'locations' => ['LocationController', 'index',],
    'locations/edit' => ['LocationController', 'edit', ['id']],
    'locations/add' => ['LocationController', 'add',],
    'locations/delete' => ['LocationController', 'delete',],
];
