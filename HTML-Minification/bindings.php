<?php
/*
** HTML Minification - add this to your project either in bindings or filters
** Defaults to production as you might want to see html output non-minimized in local environment
** Can be used as part of filters, I preferred to be in bindings
*/
    
    App::after(function($request, $response)
        {

            if(App::Environment() != 'local')
            {
                if($response instanceof Illuminate\Http\Response)
                {
                    $output = $response->getOriginalContent();
                    // Clean comments
                    $output = preg_replace('/<!--([^\[|(<!)].*)/', '', $output);
                    $output = preg_replace('/(?<!\S)\/\/\s*[^\r\n]*/', '', $output);
                    // Clean Whitespace
                    $output = preg_replace('/\s{2,}/', '', $output);
                    $output = preg_replace('/(\r?\n)/', '', $output);
                    $response->setContent($output);
                }
            }
        });
