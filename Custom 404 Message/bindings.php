<?php
    /*
	* Show the custom error page located in errors in views folder
	* Can be used as part of filters, I preferred to be in bindings
	*/
	App::missing(function($exception)
        {
            return Response::view('errors.404', array(), 404);
        });
    if($_ENV['DEBUG']==false){
        App::error(function(Exception $exception)
            {
                Log::error($exception);
                return Response::view('errors.404', array(), 404);

            });
    }