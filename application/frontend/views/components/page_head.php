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
    <meta property="og:image" content="<?php echo base_url() . (!empty($meta_image) ? $meta_image : 'resize/200x200/gertlily-logo.png'); ?>" />
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="<?php echo $meta_description; ?>"/>
    <meta name="twitter:title" content="<?php echo $meta_title_og; ?>"/>
    <meta name="twitter:site" content="@<?php echo $social_twitter; ?>"/>
    <meta name="twitter:domain" content="<?php echo $meta_title_website; ?>"/>
    <meta name="twitter:image:src" content="<?php echo base_url() . (!empty($meta_image) ? $meta_image : 'resize/200x200/gertlily-logo.png'); ?>" />

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/img/icon/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/icon/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/icon/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/icon/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/img/icon/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/img/icon/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/img/icon/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/img/icon/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="/img/icon/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="/img/icon/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="/img/icon/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/icon/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="/img/icon/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="<?php echo $meta_title_website; ?>"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="/img/icon/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="/img/icon/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="/img/icon/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="/img/icon/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="/img/icon/favicon/mstile-310x310.png" />
    <meta name="theme-color" content="#6699FF" />

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/gertlily.css">

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
        "logo" : "http://<?php echo $_SERVER['HTTP_HOST']; ?>/resize/200x200/gertlily-logo.png",
        "sameAs" : [
            <?php echo 
            (!empty($this->system_m->get_value('social_googleplus')[0]['value']) ? '"' . $this->system_m->get_value('social_googleplus')[0]['value'] . '"' : '') . 
            (!empty($this->system_m->get_value('social_facebook')[0]['value']) ? ', "' . $this->system_m->get_value('social_facebook')[0]['value'] . '"' : '') . 
            (!empty($this->system_m->get_value('social_twitter')[0]['value']) ? ', "' . $this->system_m->get_value('social_twitter')[0]['value'] . '"' : '') . 
            (!empty($this->system_m->get_value('social_linkedin')[0]['value']) ? ', "' . $this->system_m->get_value('social_linkedin')[0]['value'] . '"' : ''); 
            ?>
        ],
        "contactPoint" : [
            {
                "@type" : "ContactPoint",
                "telephone" : "<?php echo substr_replace($this->system_m->get_value('contact_phone')[0]['value'], '+31 ', 0, 1); ?>", 
                "contactType" : "customer support",
                "areaServed" : "NL",
                "availableLanguage" : "Dutch"
            } , {
                "@type" : "ContactPoint",
                "telephone" : "+31 6 250 321 58", 
                "contactType" : "emergency",
                "areaServed" : "NL",
                "availableLanguage" : "Dutch"
            }
        ],
        "name" : "<?php echo $meta_title_website; ?>"
    }
    </script>
    <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-31123351-2', 'auto'); ga('send', 'pageview');</script>
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
                        <?php echo form_close(); ?> 
                    </div>
                    <div class="col-md-3 col-sm-4 no-select">
                        <a class="logo" href="/" title="<?php echo $meta_title_website; ?>">
                            <img src="/img/gertlily.png" alt="<?php echo $meta_title_website; ?>" title="<?php echo $meta_title_website; ?>" class="img-responsive" />
                        </a>
                        <div id="mobile-nav-button" class="visible-xs">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                        </div>
                    </div>
                    <nav id="mobile-nav" class="col-md-9 col-sm-8">
                        <ul class="nav navbar-nav search no-select">
                            <li><a class="glyphicon glyphicon-search"></a></li>
                        </ul>
                        <?php echo get_navigation($navigation); ?>
                    </nav>
                </div>
            </div>
        </header>
