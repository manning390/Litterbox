<?php

if(!function_exists('realTitleCase')){
    function realTitleCase($str){
        // These words will not be capitalized
        $smallwords = [
            'of','a','the','and','an','or','nor','but','is','if','then','else','when', 'at','from','by','on','off','for','in','out','over','to','into','with'
        ];
        // Trim whitespace off front and end
        $str = trim($str);
        // Convert any whitespace to single underscores
        $str = preg_replace('/[\s]+/', '_', $str);
        // Convert CamelCase to snake_case
        $str = preg_replace('/[A-Z]/', '_$0', $str);
        // Convert everything to lower
        $str = strtolower($str);
        // Get an array of the words
        $words = explode('_', $str);
        // Iterate through words
        foreach ($words as $key => $word)
        {
            // If this word is the first, or it's not one of our small words, capitalize it with ucwords
            if ($key == 0 or !in_array($word, $smallwords))
                $words[$key] = ucwords($word);
        }
        // Convert back to string and return
        return trim(implode(' ', $words));
    }
}

if(!function_exists('real_snake_case')){
    function real_snake_case($str){
        return preg_replace('/_+/', '_', snake_case(preg_replace('/(\s|-)+/', '_', $str)));
    }
}