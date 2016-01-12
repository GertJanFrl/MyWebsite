<div class="row">
    <div class="col-md-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#systeem" aria-controls="systeem" role="tab" data-toggle="tab">Systeem</a></li>
            <?php if(count($logs_article) || in_multiarray('article', $this->data['modules_enabled'])): ?><li role="presentation"><a href="#article" aria-controls="article" role="tab" data-toggle="tab">Blog</a></li><?php endif; ?>
            <?php if(count($logs_page) || in_multiarray('page', $this->data['modules_enabled'])): ?><li role="presentation"><a href="#pages" aria-controls="pages" role="tab" data-toggle="tab">Pagina's</a></li><?php endif; ?>
            <?php if(count($logs_portfolio) || in_multiarray('portfolio', $this->data['modules_enabled'])): ?><li role="presentation"><a href="#portfolio" aria-controls="portfolio" role="tab" data-toggle="tab">Portfolio</a></li><?php endif; ?>
            <li role="presentation"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">Gebruikers</a></li>
            <li role="presentation"><a href="#inlog" aria-controls="inlog" role="tab" data-toggle="tab">Login</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="systeem">
                <div class="block">
                    <h3 class="title">
                        <span>Systeem logs</span>
                    </h3>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sort">
                                <thead>
                                <tr>
                                    <th>Gebeurtenis</th>
                                    <th>Betreft</th>
                                    <th>Actie door</th>
                                    <th>Datum</th>
                                    <th colspan="2">Locatie (IP)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($logs_system)): foreach($logs_system as $log): ?>
                                    <tr data-id="<?php echo $log->id; ?>">
                                        <td><?php echo $this->system_m->parse_log_event($log->action_event); ?></td>
                                        <td><?php echo $this->system_m->parse_log_id('system', $log->action_id); ?></td>
                                        <td><?php echo (!empty($this->user_m->get_user($log->user_id)) ? $this->user_m->get_user($log->user_id)[0]['name'] : '<s>onbekend</s>'); ?></td>
                                        <td><?php echo $log->timestamp; ?></td>
                                        <td><span data-label="location"></span></td>
                                        <td><span data-label="ip"><?php echo $log->ip; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">Geen resultaten gevonden.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(count($logs_article) || in_multiarray('article', $this->data['modules_enabled'])): ?>
            <div role="tabpanel" class="tab-pane" id="article">
                <div class="block">
                    <h3 class="title">
                        <span>Blog logs</span>
                    </h3>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sort">
                                <thead>
                                <tr>
                                    <th>Gebeurtenis</th>
                                    <th>Betreft</th>
                                    <th>Actie door</th>
                                    <th>Datum</th>
                                    <th colspan="2">Locatie (IP)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($logs_article as $log): ?>
                                    <tr data-id="<?php echo $log->id; ?>">
                                        <td><?php echo $this->system_m->parse_log_event($log->action_event); ?></td>
                                        <td><?php echo $this->system_m->parse_log_id('article', $log->action_id); ?></td>
                                        <td><?php echo (!empty($this->user_m->get_user($log->user_id)) ? $this->user_m->get_user($log->user_id)[0]['name'] : '<s>onbekend</s>'); ?></td>
                                        <td><?php echo $log->timestamp; ?></td>
                                        <td><span data-label="location"></span></td>
                                        <td><span data-label="ip"><?php echo $log->ip; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(count($logs_page) || in_multiarray('page', $this->data['modules_enabled'])): ?>
            <div role="tabpanel" class="tab-pane" id="pages">
                <div class="block">
                    <h3 class="title">
                        <span>Pagina logs</span>
                    </h3>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sort">
                                <thead>
                                <tr>
                                    <th>Gebeurtenis</th>
                                    <th>Betreft</th>
                                    <th>Actie door</th>
                                    <th>Datum</th>
                                    <th colspan="2">Locatie (IP)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($logs_page as $log): ?>
                                    <tr data-id="<?php echo $log->id; ?>">
                                        <td><?php echo $this->system_m->parse_log_event($log->action_event); ?></td>
                                        <td><?php echo $this->system_m->parse_log_id('page', $log->action_id); ?></td>
                                        <td><?php echo (!empty($this->user_m->get_user($log->user_id)) ? $this->user_m->get_user($log->user_id)[0]['name'] : '<s>onbekend</s>'); ?></td>
                                        <td><?php echo $log->timestamp; ?></td>
                                        <td><span data-label="location"></span></td>
                                        <td><span data-label="ip"><?php echo $log->ip; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(count($logs_portfolio) || in_multiarray('portfolio', $this->data['modules_enabled'])): ?>
            <div role="tabpanel" class="tab-pane" id="portfolio">
                <div class="block">
                    <h3 class="title">
                        <span>Portfolio logs</span>
                    </h3>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sort">
                                <thead>
                                <tr>
                                    <th>Gebeurtenis</th>
                                    <th>Betreft</th>
                                    <th>Actie door</th>
                                    <th>Datum</th>
                                    <th colspan="2">Locatie (IP)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($logs_portfolio as $log): ?>
                                    <tr data-id="<?php echo $log->id; ?>">
                                        <td><?php echo $this->system_m->parse_log_event($log->action_event); ?></td>
                                        <td><?php echo $this->system_m->parse_log_id('portfolio', $log->action_id); ?></td>
                                        <td><?php echo (!empty($this->user_m->get_user($log->user_id)) ? $this->user_m->get_user($log->user_id)[0]['name'] : '<s>onbekend</s>'); ?></td>
                                        <td><?php echo $log->timestamp; ?></td>
                                        <td><span data-label="location"></span></td>
                                        <td><span data-label="ip"><?php echo $log->ip; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div role="tabpanel" class="tab-pane" id="user">
                <div class="block">
                    <h3 class="title">
                        <span>Gebruikers logs</span>
                    </h3>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sort">
                                <thead>
                                <tr>
                                    <th>Gebeurtenis</th>
                                    <th>Betreft</th>
                                    <th>Actie door</th>
                                    <th>Datum</th>
                                    <th colspan="2">Locatie (IP)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($logs_user)): foreach($logs_user as $log): ?>
                                    <tr data-id="<?php echo $log->id; ?>">
                                        <td><?php echo $this->system_m->parse_log_event($log->action_event); ?></td>
                                        <td><?php echo $this->system_m->parse_log_id('user', $log->action_id); ?></td>
                                        <td><?php echo (!empty($this->user_m->get_user($log->user_id)) ? $this->user_m->get_user($log->user_id)[0]['name'] : '<s>onbekend</s>'); ?></td>
                                        <td><?php echo $log->timestamp; ?></td>
                                        <td><span data-label="location"></span></td>
                                        <td><span data-label="ip"><?php echo $log->ip; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">Geen resultaten gevonden.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="inlog">
                <div class="block">
                    <h3 class="title">
                        <span>Inlog logs</span>
                    </h3>
                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sort">
                                <thead>
                                <tr>
                                    <th>Gebeurtenis</th>
                                    <th>Actie door</th>
                                    <th>Datum</th>
                                    <th colspan="2">Locatie (IP)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($logs_login)): foreach($logs_login as $log): ?>
                                    <tr data-id="<?php echo $log->id; ?>">
                                        <td><?php echo $this->system_m->parse_log_event($log->action_event); ?></td>
                                        <td><?php echo (!empty($this->user_m->get_user($log->user_id)) ? $this->user_m->get_user($log->user_id)[0]['name'] : '<s>onbekend</s>'); ?></td>
                                        <td><?php echo $log->timestamp; ?></td>
                                        <td><span data-label="location"></span></td>
                                        <td><span data-label="ip"><?php echo $log->ip; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">Geen resultaten gevonden.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>