<?php
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

$channel = $xml->addChild('channel');
$channel->addChild('title', (!empty($page->meta_title) ? $page->meta_title : $page->title));
$channel->addChild('description', (!empty($page->meta_description) ? $page->meta_description : substr(strip_tags($this->data['page']->body), 0, 160)));
$channel->addChild('link', 'http://' . $_SERVER['HTTP_HOST'] . '/');

foreach($articles as $article) {
    $url = $channel->addChild('item');
    $url->addChild('title', $article->title);
    $url->addChild('link', 'http://' . $_SERVER['HTTP_HOST'] . '/' . $article->url);
    $url->addChild('pubDate', $article->pubdate);
    $url->addChild('description', htmlentities($article->body));

    if(!empty($article->thumbnail)) {
        $mime = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/blog/" . $article->thumbnail);

        $image = $url->addChild('enclosure', null);
        $image->addAttribute('url', 'http://' . $_SERVER['HTTP_HOST'] . '/img/uploads/blog/' . $article->thumbnail);
        $image->addAttribute('type', $mime['mime']);
        $image->addAttribute('length', filesize($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/blog/" . $article->thumbnail));
    }
}

$this->output->set_content_type('text/xml');
echo $xml->saveXML();
?>