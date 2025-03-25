<?php  
    function get_menu(array $pages){
        $menuItems = ''; 
        foreach($pages as $page_name => $page_url){
            // Pre každú stránku pridá odkaz do navigačného menu
            $menuItems .= '<li><a href="' . $page_url . '">' . $page_name . '</a></li>';
            //<li><a href="index.html">Domov</a><li>
        }
        // Vráti vygenerovaný HTML kód pre navigačné menu
        return $menuItems;
    }
?>