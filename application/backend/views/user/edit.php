<?php echo form_open(); ?>
<?php echo validation_errors(); ?>
<?php
if(!empty($user->rights) && $user->rights == 3) {
    $rights_array = array(
        '0' => 'Gebruiker',
        '1' => 'Beheerder',
        '2' => 'Administrator',
    );
} else {
    $rights_array = array(
        '0' => 'Gebruiker',
        '1' => 'Beheerder',
    );
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="block">
            <h3 class="title">
                <span><?php echo empty($user->id) ? 'Nieuwe gebruiker aanmaken' : 'Bewerk gebruiker ' . $user->name; ?></span>
            </h3>
            <div class="content">
                <label for="name">Naam</label> <br />
                <?php echo form_input('name', set_value('name', (!empty($user->name) ? $user->name : '')), 'class="form-control" required'); ?><br />
                <br />
                <label for="email">E-mailadres</label> <br />
                <?php echo form_input('email', set_value('email', (!empty($user->email) ? $user->email : '')), 'class="form-control" required'); ?><br />
                <br />
                <label for="tel">Telefoonnummer</label> <br />
                <?php echo form_input('tel', set_value('tel', (!empty($user->tel) ? $user->tel : '')), 'class="form-control" required'); ?><br />
                <br />
                <label for="password">Wachtwoord</label> <br />
                <?php echo form_password('password', '', 'class="form-control"'); ?><br />
                <br />
                <?php if (!isset($user->rights) || $user->rights == 3 && $user->id !== $this->session->userdata('id')) { ?>
                <label for="rights">Rechten niveau</label> <br />
                <?php echo form_dropdown('rights', $rights_array, (!empty($user->rights) ? $user->rights : '1'), 'class="form-control"'); ?><br />
                <br />
                <?php } ?>
                <div class="row">
                    <?php if(!empty($user->id) && $user->id != 1) { ?>
                    <div class="col-md-6">
                        <a href="/_admin/user/delete/<?php echo $user->id; ?>" class="btn btn-danger form-control">Verwijder gebruiker</a>
                    </div>
                    <?php } ?>
                    <div class="<?php echo (!empty($user->id) && $user->id != 1 ? 'col-md-6' : 'col-md-12') ?>">
                        <?php echo form_submit('submit', 'Opslaan', 'class="btn btn-primary form-control"'); ?><br />
                    </div>
                </div>
            </div>
        </div>
<?php echo form_close();?>