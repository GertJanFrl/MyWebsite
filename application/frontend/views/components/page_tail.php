<?php if($this->uri->segment(1) != 'portfolio') { ?>
                <div class="row" id="features">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="block">
                                            <span class="glyphicon glyphicon-phone"></span>
                                            <h5 class="title">Responsive</h5>
                                            <p class="description">Een mobiele-, tablet- en desktop-website is standaard</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="block">
                                            <span class="glyphicon glyphicon-lock"></span>
                                            <h5 class="title">Beveiliging</h5>
                                            <p class="description">Veiligheid van uw &amp; onze data staat bij ons voorop</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="block">
                                            <span class="glyphicon glyphicon-info-sign"></span>
                                            <h5 class="title">Support</h5>
                                            <p class="description">Moeilijke vragen verdienen een makkelijk maar duidelijk antwoord</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="block">
                                            <span class="glyphicon glyphicon-console"></span>
                                            <h5 class="title">Server's</h5>
                                            <p class="description">Onze server's zijn altijd up-to-date, deze worden dagelijks bijgewerkt</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php } ?>
            </div>
        </div>
    </section>

    <?php if($this->uri->segment(1) != 'contact') { ?>
    <?php $this->load->helper('form'); ?>
    <footer id="widgets">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Contact</h3>
                    <p><?php echo $this->system_m->get_value('contact_address')[0]['value']; ?></p>
                    <p><?php echo $this->system_m->get_value('contact_postcode')[0]['value']; ?></p>
                    <p></p>
                    <p>Telefoon: <a href="tel:<?php echo $this->system_m->get_value('contact_phone')[0]['value']; ?>"><?php echo $this->system_m->get_value('contact_phone')[0]['value']; ?></a></p>
                    <p>E-mailadres: <a href="mailto:<?php echo $this->system_m->get_value('contact_email')[0]['value']; ?>"><?php echo $this->system_m->get_value('contact_email')[0]['value']; ?></a></p>
                    <p></p>
                    <p>Kvk nummer: <a href="http://www.kvk.nl/orderstraat/bedrijf-kiezen/?q=62200151">62200151</a></p>
                    <p>BTW nummer: NL222490597B01</p>
                    <p></p>
                    <p><a href="/contact">Meer contact informatie >></a></p>
                    <p></p>
                </div>
                <div class="col-md-8">
                    <h3>Neem direct contact op</h3>
                    <?php 
                    if($this->uri->segment(1) == 'contact') {
                        echo 'Op deze pagina wordt het contact formulier al getoond.';
                    } else { ?>
                    <?php echo form_open(base_url() . 'contact'); ?>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" id="contactNaam" name="contactNaam" class="form-control" placeholder="Uw naam" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="email" id="contactEmailadres" name="contactEmailadres" class="form-control" placeholder="Uw e-mailadres" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="contactMessage" id="contactMessage" cols="30" rows="2" class="form-control" placeholder="Uw bericht"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-theme="dark" data-sitekey="6Le6NwATAAAAAGCZiPbKnM_j1MNoK8jtcD-N9z9k"></div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <button type="submit" class="btn btn-submit form-control">Verzend het formulier</button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer>
    <?php } ?>

    <footer id="copyright">
        <div class="container">
            &copy; Copyright 2011 - <?php echo date('Y'); ?>
            <ul class="list-inline">
                <li>
                    <a href="/algemene-voorwaarden">
                        Algemene voorwaarden
                    </a>
                </li>
                <li>
                    <a href="/disclaimer">
                        Disclaimer
                    </a>
                </li>
                <li>
                    <a href="/sitemap">
                        Sitemap
                    </a>
                </li>
            </ul>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="/js/vendor/bootstrap.min.js"></script>
    <script src="/js/vendor/retina.min.js"></script>
    <script src="/js/vendor/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script src="/js/main.js"></script>
</body>
</html>