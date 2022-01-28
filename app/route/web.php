<?php
$route->get('/', [Welcome::class, 'index'])->middleware('test');
$route->get('/test', [Welcome::class, 'index'])->name('test')->middleware('test');
// $route->get('/test/{number}', [Welcome::class, 'index'])->name('test')->whereNumber('number')->middleware('test'); // TODO for future SEO friendly URI
