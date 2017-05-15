<div class="row">
    <?php if(!$signup) {?> 
    <?php if(strlen(validation_errors()) > 0) { ?> 
    <div class="card-panel orange">
        <?= validation_errors() ?>
    </div>
    <?php } ?> 
    <?= form_open('user/signup', ["class" => "col s12 card-panel", "id" => "signup-form"]) ?>
    <div class="row">
        <div class="input-field col s9">
            <input name="email" id="email" type="email" class="validate" v-model="email" value="<?= set_value('email'); ?>">
            <label for="email">Enter your email</label>
        </div>
        <div v-if="email.length > 1" class="col s3">
            <p v-if="validEmail" class="green-text" >Valid email !<i class="material-icons left">done</i></p>
            <p v-else class="orange-text">Email is not valid<i class="material-icons left">clear</i></p>
        </div>
    </div>  
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
        <button type="submit" v-bind:disabled="signupIsDisabled" class="waves-effect waves-light btn">Envoyer</button>
    </form>
    <?php } else { ?>
    <h3 class="green-text text-align">
        You have successfully signed up
    </h3>
    <p>An email has been sent at <?= $email ?>, please visit the confirmation link
    to validate your registration</p>
    <?php } ?>
</div>
</div>    