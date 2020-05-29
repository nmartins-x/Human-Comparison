<?php

/**
 * String similarity/comparison algorithm. Returns percentage between 0 and 100.
 * 
 * @author Nuno Martins
 * @param String $s1
 * @param String $s2
 * @param bool $mixedMode
 * 
 * @return float
 */
function human_comparison(String $s1, String $s2, bool $mixedMode=true) :float {
    $s1 = strtoupper($s1);
    $s2 = strtoupper($s2);
    
    // replace alphanumeric charactors
    $s1clean = preg_replace("/[^A-Za-z0-9-]/", '', trim($s1));
    $s2clean = preg_replace("/[^A-Za-z0-9-]/", '', trim($s2));

    // remove double spaces
    while (strpos($s1clean, "  ") !== false) {
        $s1clean = str_replace("  ", " ", $s1clean);
    }
    
    while (strpos($s2clean, "  ") !== false) {
        $s2clean = str_replace("  ", " ", $s2clean);
    }
   
    // exact match
    if ($s1clean === $s2clean) {
        return 100;
    }

    // create arrays
    $ar1 = explode(" ", $s1clean);
    $ar2 = explode(" ", $s2clean);
    $s1_count = count($ar1);
    $s2_count = count($ar2);

    // flip the arrays if needed so ar1 is always largest.
    if ($s2_count > $s1_count) {
        $temp_ar = $ar2;
        $ar2 = $ar1;
        $ar1 = $temp_ar;
    }

    // flip array 2, to make the words the keys
    $ar2 = array_flip($ar2);

    $max_words = max($s1_count, $s2_count);
    $matches = 0;

    // find matching words
    foreach ($ar1 as $word) {
        if (array_key_exists($word, $ar2))
            $matches++;
    }
   
    // percentage of matching words
    $percent = ($matches / $max_words) * 50;
    
    // mix PHP's native similar text algorithm
    if ($mixedMode) {
        similar_text($s1clean, $s2clean, $similar);
        
        $similar = $matches>0 ? $similar * 0.5 : $similar;
        
        $percent = $percent + $similar;
    }
   
    return $percent;
}
