<?php

return [
    '' => ['HomeController', 'index',],
    'questions' => ['LocationController', 'questionsPage'],
    'result' => ['LocationController', 'resultPage'],
    'add' => ['LocationController', 'addLocation'],
    'api/connect' => ['AjaxController', 'connectApi'],
    'api' => ['AjaxController', 'apiMovie'],
    'liked' => ['AjaxController', 'likeLocation', ['id']],
    'disliked' => ['AjaxController', 'dislikeLocation', ['id']],
];
