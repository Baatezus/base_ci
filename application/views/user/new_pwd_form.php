<div class="form-container">
<?= validation_errors() ?>
<?= form_open('user/new_password', 'class="form-group"') ?>

    <div class="row">
        <div class="input-field col s9">
            <input name="password" id="password" type="password" class="validate" v-model="password" value="<?= set_value('password'); ?>">
            <label for="password">Choose your password (at least height characters)</label>
        </div>
        <div v-if="password.length > 1" class="col s3">
            <p v-if="validPassword" class="green-text" >Valid password !<i class="material-icons left">done</i></p>
            <p v-else class="orange-text">Password is not valid<i class="material-icons left">clear</i></p>
        </div>        
    </div>
    <div class="row">
        <div class="input-field col s9">
            <input name="passconf" id="passconf" type="password" class="validate" v-model="passconf" value="<?= set_value('passconf'); ?>">
            <label for="passconf">Password confirmation (must match password)</label>
        </div>
        <div v-if="password.length > 1" class="col s3">
            <p v-if="validPassconf" class="green-text" >Password and confirmation match !<i class="material-icons left">done</i></p>
            <p v-else class="orange-text">Password does not match confirmation<i class="material-icons left">clear</i></p>
        </div>        
    </div>
    <input hidden name="token" value="<?= $token ?>" />
    <input hidden name="user_id" value="<?= $user_id ?>" />
    <button type="submit" v-bind:disabled="newPwdIsDisabled" class="waves-effect waves-light btn">Envoyer</button>
</form>
</div>
</div>