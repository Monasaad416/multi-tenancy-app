<?php

use Illuminate\Support\Facades\Config;

function uploadFile($folder,$file) {
    $file->store('/',$folder);
    $fileName = $file->hashName();
    // $path ="images/".$folder."/".$fileName;
    return $fileName;
}


function languagesList(){
    return dd("all langs");
}

function getDefaultLanguage(){
    return config::get('app.locale');
}
