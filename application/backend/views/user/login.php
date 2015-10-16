                        <header id="page-header">
                            <h1 class="page-title">Inloggen</h1>
                        </header>

						<?php echo validation_errors(); ?>
						<?php echo form_open();?>
						<p>
							<label for="email">E-mailadres<br/>
								<?php echo form_input('email'); ?> <br />
							</label>
						</p>
						<p>
							<label for="password">Wachtwoord<br/>
								<?php echo form_password('password'); ?> <br />
							</label>
						</p>
						<p class="submit">
							<?php echo form_submit('submit', 'Inloggen', 'class="btn"'); ?> <br />
						</p>
						<?php echo form_close();?>