<?php 
        function add_translations() {
            if (function_exists('pll_register_string')) {

                // EKSEMPLER
                pll_register_string('Kontakt', 'Kontakt', 'Theme');

                pll_register_string('Lokationer', 'Vi har %s lokationer i Danmark', 'Theme');
            }
        };
        add_action('init', 'add_translations');
?>