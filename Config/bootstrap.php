<?php
/**
 * Swagger bootstrap
 */

// Provide default coverage if not already overwritten
if (!Configure::read('swagger'))
{
    Configure::write('swagger', array(
        'paths' => array(
            ROOT.DS.APP_DIR.DS.'Controller',
            ROOT.DS.APP_DIR.DS.'Config'
        )
    ));
}