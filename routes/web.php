<?php

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/home.php';

require __DIR__.'/processos.php';

require __DIR__.'/tribunais.php';

require __DIR__.'/acoes.php';

require __DIR__.'/andamentos.php';