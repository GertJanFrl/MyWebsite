                        <div class="block about">
                            <h3>Gertlily</h3>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <address>
                                        <p><?php echo $this->system_m->get_value('contact_address')[0]['value']; ?></p>
                                        <p><?php echo $this->system_m->get_value('contact_postcode')[0]['value']; ?></p>
                                    </address>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <p><strong>T:</strong> <a href="callto:<?php echo $this->system_m->get_value('contact_phone')[0]['value']; ?>"><?php echo $this->system_m->get_value('contact_phone')[0]['value']; ?></a></p>
                                    <p><strong>E:</strong> <a href="mailto:<?php echo $this->system_m->get_value('contact_email')[0]['value']; ?>"><?php echo $this->system_m->get_value('contact_email')[0]['value']; ?></a></p>
                                </div>
                            </div>
                        </div>
<?php if ($this->uri->segment(1) == 'contact') {?>
                        <div class="block extra-info">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-4"><strong>K.v.K.:</strong></div>
                                <div class="col-lg-9 col-md-8 col-sm-9 col-xs-8">62200151</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-4"><strong>BTW:</strong></div>
                                <div class="col-lg-9 col-md-8 col-sm-9 col-xs-8">NL222490597B01</div>
                            </div>
                        </div>
<?php } ?>
                        <div class="block social">
                            <h3>Social Media</h3>
                            <?php echo (!empty($this->system_m->get_value('social_googleplus')[0]['value']) ? '<a href="' . $this->system_m->get_value('social_googleplus')[0]['value'] . '" title="Google+" target="_blank" rel="publisher"><div class="icon-social googleplus"></div></a>' : ''); ?>
                            <?php echo (!empty($this->system_m->get_value('social_facebook')[0]['value']) ? '<a href="' . $this->system_m->get_value('social_facebook')[0]['value'] . '" title="Facebook" target="_blank"><div class="icon-social facebook"></div></a>' : ''); ?>
                            <?php echo (!empty($this->system_m->get_value('social_twitter')[0]['value']) ? '<a href="' . $this->system_m->get_value('social_twitter')[0]['value'] . '" title="Twitter" target="_blank"><div class="icon-social twitter"></div></a>' : ''); ?>
                            <?php echo (!empty($this->system_m->get_value('social_linkedin')[0]['value']) ? '<a href="' . $this->system_m->get_value('social_linkedin')[0]['value'] . '" title="LinkedIn" target="_blank"><div class="icon-social linkedin"></div></a>' : ''); ?>
                            <span class="clear"></span>
                        </div>