<?php $this->load->view('components/page_head'); ?>
        <div class="mobile-nav">
            <button class="nav-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="user-info">
                Hallo, <a href="#" title="<?php echo $this->session->userdata('name'); ?>"><?php echo $this->session->userdata('name'); ?></a>
            </div>

            <div class="user-info"><a href="/">
                Bekijk de homepagina
            </a></div>
        </div>
        
        <div id="navigation" class="expanded">
            <a href="#" title="#"><img src="/_admin/img/mywebsite.png" class="logo" /></a>
            <ul>
                <li<?php echo (empty($this->data['currentpage']) || $this->data['currentpage'] == 'dashboard' ? ' class="active"' : '') ?>>
                    <a href="/_admin/dashboard/" title="Dashboard">
                        <span>Dashboard</span>
                        <i class="fa fa-tachometer"></i>
                    </a>
                </li>
                <?php 
                if(in_multiarray('article', $this->data['modules_enabled'])) { 
                    ?>
                    <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'article' ? ' class="active"' : '') ?>>
                        <a href="/_admin/article/" title="Blog">
                            <span>Blog</span>
                            <i class="fa fa-newspaper-o"></i>
                        </a>
                        <ul>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'article' && $this->data['currentsubpage'] == 'overview' ? ' class="active"' : '') ?>>
                                <a href="/_admin/article/" title="Blog: Alle berichten">
                                    Alle berichten
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentsubpage']) && $this->data['currentpage'] == 'article' && $this->data['currentsubpage'] == 'nieuw' ? ' class="active"' : '') ?>>
                                <a href="/_admin/article/edit/" title="Blog: Nieuw bericht">
                                    Nieuw bericht
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                }
                if(in_multiarray('page', $this->data['modules_enabled'])) { 
                    ?>
                    <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'page' ? ' class="active"' : '') ?>>
                        <a href="/_admin/page/" title="Pagina's">
                            <span>Pagina's</span>
                            <i class="fa fa-file-text-o"></i>
                        </a>
                        <ul>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'page' && $this->data['currentsubpage'] == 'overview' ? ' class="active"' : '') ?>>
                                <a href="/_admin/page/" title="Pagina's: Alle pagina's">
                                    Alle pagina's
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentsubpage']) && $this->data['currentpage'] == 'page' && $this->data['currentsubpage'] == 'trash' ? ' class="active"' : '') ?>>
                                <a href="/_admin/page/trash/" title="Pagina's: Prullenbak">
                                    Prullenbak
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentsubpage']) && $this->data['currentpage'] == 'page' && $this->data['currentsubpage'] == 'nieuw' ? ' class="active"' : '') ?>>
                                <a href="/_admin/page/edit/" title="Pagina's: Nieuwe pagina">
                                    Nieuwe pagina
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                }
                if(in_multiarray('portfolio', $this->data['modules_enabled'])) { 
                    ?>
                    <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'portfolio' ? ' class="active"' : '') ?>>
                        <a href="/_admin/portfolio/" title="Portfolio">
                            <span>Portfolio</span>
                            <i class="fa fa-paint-brush"></i>
                        </a>
                        <ul>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'portfolio' && $this->data['currentsubpage'] == 'overview' ? ' class="active"' : '') ?>>
                                <a href="/_admin/portfolio/" title="Portfolio: Alle portfolio items">
                                    Alle portfolio items
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentsubpage']) && $this->data['currentpage'] == 'portfolio' && $this->data['currentsubpage'] == 'trash' ? ' class="active"' : '') ?>>
                                <a href="/_admin/portfolio/trash/" title="portfolio: Prullenbak">
                                    Prullenbak
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentsubpage']) && $this->data['currentpage'] == 'portfolio' && $this->data['currentsubpage'] == 'nieuw' ? ' class="active"' : '') ?>>
                                <a href="/_admin/portfolio/edit/" title="Portfolio: Nieuwe portfolio item">
                                    Nieuwe portfolio item
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                }
                if(in_multiarray('diensten', $this->data['modules_enabled'])) { 
                    ?>
                    <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'diensten' ? ' class="active"' : '') ?>>
                        <a href="/_admin/diensten/" title="Diensten">
                            <span>Diensten</span>
                            <i class="fa fa-paint-brush"></i>
                        </a>
                        <ul>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'diensten' && $this->data['currentsubpage'] == 'domein' ? ' class="active"' : '') ?>>
                                <a href="/_admin/diensten/" title="Domeinen: Alle TLD's">
                                    Domeinen
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'diensten' && $this->data['currentsubpage'] == 'hosting_web' ? ' class="active"' : '') ?>>
                                <a href="/_admin/diensten/hosting/web/" title="Webhosting">
                                    Webhosting
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'diensten' && $this->data['currentsubpage'] == 'hosting_reseller' ? ' class="active"' : '') ?>>
                                <a href="/_admin/diensten/hosting/reseller/" title="Reseller hosting">
                                    Reseller hosting
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'diensten' && $this->data['currentsubpage'] == 'hosting_vps' ? ' class="active"' : '') ?>>
                                <a href="/_admin/diensten/hosting/vps/" title="VPS hosting">
                                    VPS Hosting
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                }
                if(in_multiarray('media', $this->data['modules_enabled'])) { 
                    ?>
                    <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'media' ? ' class="active"' : '') ?>>
                        <a href="#" title="Media">
                            <span>Media</span>
                            <i class="fa fa-camera-retro"></i>
                        </a>
                    </li>
                    <?php 
                }
                if(in_multiarray('slideshow', $this->data['modules_enabled'])) { 
                    ?>
                    <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'slideshow' ? ' class="active"' : '') ?>>
                        <a href="#" title="Slideshow">
                            <span>Slideshow</span>
                            <i class="fa fa-picture-o"></i>
                        </a>
                        <ul>
                            <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'slideshow' && $this->data['currentsubpage'] == 'overview' ? ' class="active"' : '') ?>>
                                <a href="#" title="Slideshow: Alle sliders">
                                    Alle sliders
                                </a>
                            </li>
                            <li<?php echo (!empty($this->data['currentsubpage']) && $this->data['currentpage'] == 'slideshow' && $this->data['currentsubpage'] == 'nieuw' ? ' class="active"' : '') ?>>
                                <a href="#" title="Slideshow: Nieuwe slider">
                                    Nieuwe slider
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                }
                ?>
            </ul>
            <ul>
                <?php if($this->session->userdata('rights') >= 2) { ?>
                <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'user' ? ' class="active"' : '') ?>>
                    <a href="/_admin/user/" title="Gebruikers">
                        <span>Gebruikers</span>
                        <i class="fa fa-users"></i>
                    </a>
                </li>
                <?php } ?>
                <?php if($this->session->userdata('rights') >= 3) { ?>
                <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'system' ? ' class="active"' : '') ?>>
                    <a href="/_admin/system/" title="Voorkeuren">
                        <span>Voorkeuren</span>
                        <i class="fa fa-cogs"></i>
                    </a>
                    <ul>
                        <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'system' && $this->data['currentsubpage'] == 'general' ? ' class="active"' : '') ?>>
                            <a href="/_admin/system/" title="Voorkeuren: Algemeen">
                                Algemeen
                            </a>
                        </li>
                        <li<?php echo (!empty($this->data['currentsubpage']) && $this->data['currentpage'] == 'system' && $this->data['currentsubpage'] == 'modules' ? ' class="active"' : '') ?>>
                            <a href="/_admin/system/modules/" title="Voorkeuren: Modules">
                                Modules
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li<?php echo (!empty($this->data['currentpage']) && $this->data['currentpage'] == 'logout' ? ' class="active"' : '') ?>>
                    <a href="/_admin/user/logout/" title="">
                        <span>Uitloggen</span>
                        <i class="fa fa-sign-out"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div id="navigation-block"></div>

        
        <div id="page" class="nav-expanded">
			<div class="container-fluid"> 
                <div class="row">
                    <div class="col-md-12">    
						<?php $this->load->view($subview); ?>
                    </div>
                </div>
<?php $this->load->view('components/page_tail'); ?>