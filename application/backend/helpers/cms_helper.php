<?php
function in_multiarray($needle, $haystack, $strict = false) {
	foreach ($haystack as $item) {
		if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_multiarray($needle, $item, $strict))) {
			return true;
		}
	}
	return false;
}

function dirtitel($titel, $seperator = '-') {
	$titel = iconv('utf-8', 'ascii//TRANSLIT', $titel);
	$titel = str_replace(array('&','@','$'), array(' en ',' at ','dollar'), $titel);
	$titel = preg_replace('/[^a-z0-9\s]/i' , '' , $titel);
	$titel = strtolower($titel);
	$titel = str_replace(' ' , $seperator , $titel);
	$titel = str_replace($seperator . $seperator, $seperator, $titel);

	if (empty($titel))
		$titel = 'onbekend';

	return $titel;
}

function deleteThumbCache($thumbnail, $cache)
{
	// Delete the original thumbnail image
	unlink($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/" . $thumbnail);

	// Delete the cache thumbnail files
	$files = glob($_SERVER['DOCUMENT_ROOT'] . '/img/cache/' . $cache . '/*');
	foreach ($files as $file)
	{
		is_dir($file) ? removeDirectory($file) : unlink($file);
	}
	rmdir($_SERVER['DOCUMENT_ROOT'] . '/img/cache/' . $cache);
	return;
}

function add_meta_title ($string) {
	$CI =& get_instance();
	$CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit ($uri) {
	return anchor($uri, 'Bewerken');
}

function btn_delete ($uri) {
	return anchor($uri, '<span style="color: #A00;">Verwijderen</span>');
}

function article_link($article) {
	return 'article/' . intval($article->id) . '/' . e($article->slug);
}
function article_links($articles) {
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '</li>';
	}
	$string .= '</ul>';
	return $string;
}

function get_excerpt($article, $numwords = 50) {
	$string = '';
	$url = article_link($article);
	$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
	$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
	return $string;
}

function limit_to_numwords($string, $numwords) {
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function e($string) {
	return htmlentities($string);
}

function get_menu ($array, $child = FALSE) {
	$CI =& get_instance();
	$str = '';
	
	if (count($array)) {
		$str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
		
		foreach ($array as $item) {
			
			$active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
			if (isset($item['children']) && count($item['children'])) {
				$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
				$str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '">' . e($item['title']);
				$str .= '<b class="caret"></b></a>' . PHP_EOL;
				$str .= get_menu($item['children'], TRUE);
			}
			else {
				$str .= $active ? '<li class="active">' : '<li>';
				$str .= '<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
			}
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ul>' . PHP_EOL;
	}
	
	return $str;
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE) {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}