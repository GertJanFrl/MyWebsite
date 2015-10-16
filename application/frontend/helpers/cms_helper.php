<?php

function sendMail ($from, $subject, $message, $smtp) {
    $CI =& get_instance();
    $CI->load->library('email');

    $config['protocol']     = 'smtp';
    $config['smtp_host']    = $smtp['server'];
    $config['smtp_port']    = $smtp['port'];
    $config['smtp_timeout'] = '10';
    $config['smtp_user']    = $smtp['email'];
    $config['smtp_pass']    = $smtp['password'];
    $config['charset']      = 'utf-8';
    $config['newline']      = "\r\n";
    $config['mailtype']     = 'html';
    $config['validation']   = TRUE;

    $CI->email->initialize($config);
    $CI->email->from($from['email'], $from['name']);

    $CI->email->to($from['email']);

    $CI->email->subject($subject);

    $content  = '<html>';
    $content .= '<style style="text/css">
        html, body {margin: 0; padding: 0;}
        a img{border: 0;}
        html, body{background-color: #ffffff; text-align: center; color: #1d1f1a; }
        td{font-family: Verdana, Arial, sans-serif; font-size: 11px; line-height: 18px; color: #1f1f1f; }
        a, a:link, a:visited{color: #000c36;}
        h2 { color: #485eb1; padding-top: 10px; line-height: 1.4em; }
        h2:first-child { background: none; }
    </style>';
    $content .= '<body bgcolor="#e9e9e9" style="background-color: #e9e9e9;">';
    $content .= '<table cellpadding="0" cellspacing="0" border="0" width="660" style="margin: 0 auto; text-align: left; width: 660px; background: #e3e3e3;">';
    $content .= '    <tr>';
    $content .= '        <td valign="top" style="background: #ffffff;">';
    $content .= '            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="color: #5A4279; text-align: left;">';
    $content .= '                <tr>';
    $content .= '                    <td colspan="3" height="20"></td>';
    $content .= '                </tr>';
    $content .= '                <tr>';
    $content .= '                    <td width="10"></td>';
    $content .= '                    <td colspan="2" ><img src="' . base_url() . 'img/' . strtolower($from['name']) . '.png" alt="" title="" style="display: block" /></td>';
    $content .= '                </tr>';
    $content .= '                <tr>';
    $content .= '                    <td colspan="3" height="10"></td>';
    $content .= '                </tr>';
    $content .= '                <tr>';
    $content .= '                    <td width="20"> </td>';
    $content .= '                    <td style="color: #4c4c4c;">';
    $content .= '                       ' . $message;
    $content .= '                    </td>';
    $content .= '                    <td width="20"> </td>';
    $content .= '                </tr>';
    $content .= '                <tr>';
    $content .= '                    <td colspan="30" height="15"></td>';
    $content .= '                </tr>';
    $content .= '            </table>';
    $content .= '        </td>';
    $content .= '    </tr>';
    $content .= '    <tr>';
    $content .= '        <td style="background: #ffffff; height: 20px; text-align: center; color: #000;">';
    $content .= '            <p style="display: inline; font-size: 10px;">Dit is een automatisch verzonden e-mail</p>';
    $content .= '        </td>';
    $content .= '    </tr>';
    $content .= '</table>';
    $content .= '</body>';
    $content .= '</html>';

    $CI->email->message($content);

    if(!$CI->email->send())
        return 'false';
    else
        return 'true';
}

function add_meta_title($string, $page) {
    $CI =& get_instance();
    $CI->data['meta_title_website']     = $CI->data['meta_title'];
    $CI->data['meta_title_og']          = e($string);
    $CI->data['meta_title']             = e($string) . ($page != 'home' ? ' - ' . $CI->data['meta_title'] : '');
}
function add_meta_description($string) {
    $CI =& get_instance();
    $CI->data['meta_description'] = e($string);
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

function get_navigation($array, $child = FALSE) {
    $CI =& get_instance();
    $str = '';
    
    if (count($array)) {
        $str .= $child == FALSE ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
        
        foreach ($array as $item) {
            $active = ($child ? (!empty($CI->uri->segment(2)) ? ($CI->uri->segment(1) . '/' . $CI->uri->segment(2) == $item['url'] ? TRUE : FALSE) : ($CI->uri->segment(1) == $item['url'] ? TRUE : FALSE)) : ($CI->uri->segment(1) == $item['url'] ? TRUE : FALSE));
            if (isset($item['child']) && count($item['child'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a href="/' . $item['url'] . '" title="' . e($item['title']) . '">' . e($item['title']);
                $str .= ' <b class="caret"></b></a>' . PHP_EOL;
                $str .= get_navigation($item['child'], TRUE);
            } else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="/' . $item['url'] . '" title="' . e($item['title']) . '">' . e($item['title']) . '</a>';
            }
            $str .= '</li>' . PHP_EOL;
        }
        
        $str .= '</ul>' . PHP_EOL;
    }
    
    return $str;
}