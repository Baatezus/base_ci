<div class="" id="forgot-app">
<?= $message ?>
<?= validation_errors() ?>
<?php if(!$request_sent) { ?>
<?= form_open('user/forgot', 'class="form-group"') ?>

    <div class="row">
        <div class="input-field col s12">
            <input name="email" id="email" type="email" class="validate" v-model="email"  value="<?= set_value('email') ?>">
            <label for="email">Enter your email</label>
        </div>
    </div>  

    <button type="submit" v-bind:disabled="isDisabled" class="waves-effect waves-light btn">
        Send me a email to change my password
    </button>
</form>
</div>
<?php } else { ?>
<h3>Changer son mot de passe.</h3>
<p>Un email vous à été envoyé à <span class="" style="color: #20BB46"><?= $email ?></span>.<br />
    Il contient les instruction pour obtenir un nouveau mot de passe.
</p>
<?= $url ?>
<?php } ?>
</div>
</div>