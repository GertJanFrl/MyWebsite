<?php $this->load->helper('form'); ?>
        <div id="map-canvas" style="height: 330px;"></div>

        <div id="content" class="carousel-visible">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <?php
                        if($this->session->flashdata('success') !== FALSE) {
                            echo '<div class="block alert alert-default">Uw vraag of opmerking is succesvol verzonden, wij zullen zo spoedig mogelijk contact met u opnemen.</div>';
                        }
                        if(!empty($post_return)) {
                            echo '<div class="block alert alert-default">* ' . $post_return . '</div>';
                        }
                        ?>
                        <div class="block">
                            <h1><?php echo $page->title; ?></h1>
                            <?php echo $page->body; ?> 
                            <?php echo form_open(base_url() . 'contact', array('class' => 'contact-form')); ?>
                            <div class="form-group">
                                <label for="contactNaam">Naam *</label>
                                <input type="text" class="form-control" name="contactNaam" id="contactNaam" value="<?php echo (!empty($_POST['contactNaam']) ? $_POST['contactNaam'] : ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contactEmailadres">E-mailadres *</label>
                                <input type="email" class="form-control" name="contactEmailadres" id="contactEmailadres" value="<?php echo (!empty($_POST['contactEmailadres']) ? $_POST['contactEmailadres'] : ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contactSubject">Onderwerp</label>
                                <input type="text" class="form-control" name="contactSubject" id="contactSubject" value="<?php echo (!empty($_POST['contactSubject']) ? $_POST['contactSubject'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="contactTelefoon">Telefoonnummer</label>
                                <input type="tel" class="form-control" name="contactTelefoon" id="contactTelefoon" value="<?php echo (!empty($_POST['contactTelefoon']) ? $_POST['contactTelefoon'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="contactMessage">Uw vraag of opmerking *</label>
                                <textarea name="contactMessage" class="form-control" id="contactMessage" rows="5" required><?php echo (!empty($_POST['contactMessage']) ? $_POST['contactMessage'] : ''); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Anti-spam beveiliging *</label>
                                <div class="g-recaptcha" data-sitekey="6Le6NwATAAAAAGCZiPbKnM_j1MNoK8jtcD-N9z9k"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-submit btn-lg">Verzend het formulier</button>
                            </div>
                            <?php echo form_close(); ?> 
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4" id="sidebar">
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/application/frontend/views/extra/sidebar.php'; ?>
                        <?php if(!empty($page->body_sidebar)) { ?>
                        <div class="block">
                            <?php echo $page->body_sidebar; ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>