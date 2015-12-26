<?php
Route::get('/checkstatus', function(){
    return Pesapal::checkStatus();
});Route::get('/pesapal_redirect', function(){
    return Pesapal::redirectAfterPayment();
});
Route::get('/listenipn', function(){
    return Pesapal::listentToIpn();
});
Route::get('/iframe', function(){
    return Pesapal::Iframe();
});