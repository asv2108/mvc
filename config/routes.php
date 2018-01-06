<?php
// list system routing
return array(
    'index'=>'index/index',
    'view/([0-9]+)'=>'index/user/$1',
);

//'news/([0-9]+)/([0-9]+)'=>'controller/method/$1/$2',