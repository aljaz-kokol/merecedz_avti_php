<?php
if (Route::get('/', 'HomeController', 'index')) {}
elseif (Route::get('auth/login', 'AuthController', 'showLogin')) {}
elseif (Route::post('auth/login', 'AuthController', 'login')) {}
elseif (Route::get('auth/register', 'AuthController', 'register')) {}
elseif (Route::post('auth/register', 'AuthController', 'store')) {}
elseif (Route::get('sign-out', 'AuthController', 'signOut')) {}
elseif (Route::get('class/{className}', 'CarController', 'getCars')) {}
elseif (Route::get('car/{carId}', 'CarController', 'details')) {}
elseif (Route::post('car/{carId}', 'ReviewController', 'comment')) {}
elseif (Route::get('reviews', 'ReviewController', 'reviews')) {}
elseif (Route::delete('reviews', 'ReviewController', 'remove')) {}
elseif (Route::get('control', 'ControlPanelController', 'panel')) {}
elseif (Route::get('control/news', 'ControlPanelController', 'newStory')) {}
elseif (Route::post('control/news', 'ControlPanelController', 'storeStory')) {}
elseif (Route::get('control/car', 'ControlPanelController', 'newCar')) {}
else {
    $view = new View('error/404', []);
    $view->render();
}