<?php
$route->get('', [Welcome::class, 'index'])->middleware('test');
