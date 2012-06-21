<?php

/*
  Plugin Name: Wiki Shortcode
  Plugin URI: http://www.planb.com.br
  Description: Plugin desenvolvido para o site Moip.com.br utilizando a classe da PEAR wiki
  Version: 1.0
  Author: Rodrigo Gomes Dias
  Author URI: http://www.planb.com.br
  License: GPL2
 */

// [wiki]
function wiki_func($args, $content = null) {

    if ($content) {
        if ('</p>' == substr($content, 0, 4)
                and '<p>' == substr($content, strlen($content) - 3))
            $content = substr($content, 4, strlen($content) - 7);
        if ('<br />' == substr($content, 0, 6)
                and '<br />' == trim(substr($content, strlen($content) - 7)))
            $content = substr($content, 6, strlen($content) - 13);

        require_once 'Text/Wiki.php';

        $wiki = & new Text_Wiki();
        $xhtml = $wiki->transform(strip_tags($content), 'xhtml');

        return $xhtml;
    }
}

add_shortcode('wiki', 'wiki_func');
?>