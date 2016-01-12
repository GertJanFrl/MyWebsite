<?php $this->load->helper('form'); ?><!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="nl-NL" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="nl-NL" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="nl-NL" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="nl-NL" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $meta_title; ?></title>
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="canonical" href="<?php echo base_url(); ?>" />
    <meta property="og:locale" content="nl_NL" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $meta_title_og; ?>" />
    <meta property="og:description" content="<?php echo $meta_description; ?>" />
    <meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'].str_replace('/index.php', '', $_SERVER['PHP_SELF']); ?>" />
    <meta property="og:site_name" content="<?php echo $meta_title_website; ?>" />
    <meta property="og:image" content="<?php echo base_url() . (!empty($meta_image) ? $meta_image : 'img/h-jacobusparochie-noordwest-friesland.png'); ?>" />
    <meta name="twitter:card" content="<?php echo ($this->uri->segment(1) == 'nieuws' && !empty($this->uri->segment(2)) ? 'summary_large_image' : 'summary') ?>"/>
    <meta name="twitter:description" content="<?php echo $meta_description; ?>"/>
    <meta name="twitter:title" content="<?php echo $meta_title_og; ?>"/>
    <meta name="twitter:site" content="@<?php echo $social_twitter; ?>"/>
    <meta name="twitter:domain" content="<?php echo $meta_title_website; ?>"/>
    <meta name="twitter:image" content="<?php echo base_url() . (!empty($meta_image) ? $meta_image : 'img/h-jacobusparochie-noordwest-friesland.png'); ?>" />


    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <script src="/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=nl'></script>

    <script type="application/ld+json">
    {
        "@context" : "http://schema.org",
        "@type" : "WebSite",
        "url" : "http://<?php echo $_SERVER['HTTP_HOST']; ?>/",
        "name" : "<?php echo $meta_title_website; ?>",
        "potentialAction" : {
            "@type" : "SearchAction",
            "target" : "http://<?php echo $_SERVER['HTTP_HOST']; ?>/zoeken/?q={search_term}",
            "query-input": "required name=search_term"
        }
    }</script>
    <script type="application/ld+json">
    {
        "@context" : "http://schema.org",
        "@type" : "Organization",
        "url" : "http://<?php echo $_SERVER['HTTP_HOST']; ?>/",
        "sameAs" : [
            <?php echo 
            (!empty($this->system_m->get_value('social_googleplus')[0]['value']) ? '"' . $this->system_m->get_value('social_googleplus')[0]['value'] . '"' : '') . 
            (!empty($this->system_m->get_value('social_facebook')[0]['value']) ? ', "' . $this->system_m->get_value('social_facebook')[0]['value'] . '"' : '') . 
            (!empty($this->system_m->get_value('social_twitter')[0]['value']) ? ', "' . $this->system_m->get_value('social_twitter')[0]['value'] . '"' : '') . 
            (!empty($this->system_m->get_value('social_linkedin')[0]['value']) ? ', "' . $this->system_m->get_value('social_linkedin')[0]['value'] . '"' : ''); 
            ?>
        ],
        <?php if (!empty($this->system_m->get_value('contact_phone')[0]['value'])): ?>"contactPoint" : [
            {
                "@type" : "ContactPoint",
                "telephone" : "<?php echo substr_replace($this->system_m->get_value('contact_phone')[0]['value'], '+31 ', 0, 1); ?>", 
                "contactType" : "customer support",
                "areaServed" : "NL",
                "availableLanguage" : "Dutch"
            }
        ],<?php endif ;?>
        "name" : "<?php echo $meta_title_website; ?>"
    }
    </script>
    <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-44944242-2', 'auto'); ga('send', 'pageview');</script>
</head>
<body<?php echo (!empty($this->uri->segment(1)) ? ' class="' . $this->uri->segment(1) . '"' : ''); ?>>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section id="wrapper">
        <header>
            <div class="container">
                <div class="row">
                    <div id="search-wrapper" class="hidden">
                        <?php echo form_open(base_url() . 'zoeken'); ?>
                            <input type="text" name="q" placeholder="Uw zoekterm..." class="form-control" />
                            <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            <button type="close"><span class="glyphicon glyphicon-remove"></span></button>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                        <a href="/  " title="<?php echo $meta_title_website; ?>" class="logo no-select">
                            <img src="/img/h-jacobusparochie-noordwest-friesland.png" alt="<?php echo $meta_title_website; ?>" class="img-responsive" style="max-height: 70px; float: left;"/>
							<span class="text">
								<h1><?php echo $meta_title_website; ?></h1>
								<h2><?php echo $meta_title_website_slogan; ?></h2>
							</span>
                        </a>
                        <div id="mobile-nav-button" class="visible-xs">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                        </div>
                    </div>
                    <nav id="mobile-nav" class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav navbar-nav search no-select">
                            <li><a class="glyphicon glyphicon-search"></a></li>
                        </ul>
                        <?php echo get_navigation($navigation); ?>
                    </nav>
                </div>
            </div>
        </header>
