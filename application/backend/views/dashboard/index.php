<div class="row">
	<div class="col-md-6 col-sm-12">
		<div id="dashboard_gertlily_support" class="block">
			<h3 class="title">
				<span>Gertlily Support</span>
			</h3>
			<div class="content">
				<div class="table table_content">
					<table>
						<tbody>
							<tr>
								<td class="t time">
									Openingstijden
								</td>
								<td class="b time">
									<?php echo $system['supportwidget_openingstijden']; ?>
								</td>
							</tr>
							<tr>
								<td class="t phone">
									Telefoonnummer
								</td>
								<td class="b phone">
									<a href="tel:<?php echo $system['supportwidget_phone']; ?>">
										<?php echo $system['supportwidget_phone']; ?>
									</a>
								</td>
							</tr>
							<tr>
								<td class="t email">
									E-mail adres
								</td>
								<td class="b email">
									<a href="mailto:<?php echo $system['supportwidget_email']; ?>" target="_blank">
										<?php echo $system['supportwidget_email']; ?>
									</a>
								</td>
							</tr>
							<tr>
								<td class="t website">
									Website
								</td>
								<td class="b website">
									<a href="<?php echo $system['supportwidget_website']; ?>" target="_blank">
										<?php echo $system['supportwidget_website']; ?>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12">
		<div class="block">
			<h3 class="title">
				<span>Statistieken</span>
			</h3>
			<div class="content">
				<ul>
					<li><?php echo count($count_articles); ?> blog-berichten</li>
					<li><?php echo count($count_pages); ?> pagina's</li>
					<li><?php echo count($count_pages_sub); ?> sub-pagina's</li>
					<li><?php echo count($count_users); ?> gebruikers</li>
				</ul>
			</div>
		</div>

		<div class="block">
			<h3 class="title">
				<span>Laatste<?php echo (count($articles) > 1 ? ' ' . count($articles) : ''); ?> blog <?php echo (count($articles) > 1 ? 'berichten' : 'bericht'); ?></span>
			</h3>
			<div class="content">
				<?php foreach ($articles as $key => $article) {
					echo '<p>';
					echo '<a href="/_admin/article/edit/' . $article->id . '">' . $article->title . '</a><br />';
					echo '&emsp;door ' . (!empty($this->user_m->get_user($article->author)) ? $this->user_m->get_user($article->author)[0]['name'] : '<s>onbekend</s>') . ' op ' . $article->pubdate;
					echo '</p>';
				}
				?>
			</div>
		</div>
	</div>
</div>