<?php

return [
    '' => ['HomeController', 'index',],
    'questions' => ['LocationController', 'questionsPage'],
    'locations' => ['LocationController', 'index',],
    'locations/edit' => ['LocationController', 'edit', ['id']],
    'locations/add' => ['LocationController', 'addLocation',],
    'locations/delete' => ['LocationController', 'delete',],
    'result' => ['LocationController', 'resultPage']
];
