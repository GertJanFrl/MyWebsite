<?php
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

foreach($pages as $page) {
    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://' . $_SERVER['HTTP_HOST'] . '/' . $page->url);
    $url->addChild('changefreq', 'weekly');
    $url->addChild('priority', (empty($page->url) ? '1.0' : '0.8'));

    if(!empty($page->thumbnail)) {
        $image = $url->addChild('image:image', null, 'http://www.google.com/schemas/sitemap-image/1.1');
        $image->addChild('image:loc', 'http://' . $_SERVER['HTTP_HOST'] . '/img/uploads/page/' . $page->thumbnail);
        $image->addChild('image:caption', $page->title);
    }
        
    foreach ($pages_sub as $key => $page_sub) {
        if($page_sub->id_parent == $page->id) {
            $url = $xml->addChild('url');
            $url->addChild('loc', 'http://' . $_SERVER['HTTP_HOST'] . '/' . $page->url . '/' . $page_sub->url);
            $url->addChild('changefreq', 'weekly');
            $url->addChild('priority', '0.6');

            if(!empty($page_sub->thumbnail)) {
                $image = $url->addChild('image:image', null, 'http://www.google.com/schemas/sitemap-image/1.1');
                $image->addChild('image:loc', 'http://' . $_SERVER['HTTP_HOST'] . '/img/uploads/page/' . $page_sub->thumbnail);
                $image->addChild('image:caption', $page_sub->title);
            }
        }
    }
}

foreach($portfolio as $item) {
    $url = $xml->addChild('url');
    $url->addChild('loc', 'http://' . $_SERVER['HTTP_HOST'] . '/portfolio/' . $item->url);
    $url->addChild('changefreq', 'weekly');
    $url->addChild('priority', '0.6');

    if(!empty($item->thumbnail)) {
        $image = $url->addChild('image:image', null, 'http://www.google.com/schemas/sitemap-image/1.1');
        $image->addChild('image:loc', 'http://' . $_SERVER['HTTP_HOST'] . '/img/uploads/portfolio/' . $item->thumbnail);
        $image->addChild('image:caption', $item->title);
    }
}

$this->output->set_content_type('text/xml');
echo $xml->saveXML();
?>