<div class="row" id="signin-app">
    <?php if(strlen(validation_errors()) > 0) {?>
    <div class="card-panel orange">
        <?= validation_errors() ?>
    </div>
    <?php } else if($message) { ?>
    <div class="card-panel orange">
        <?= $message ?>
    </div>
    <?php } ?>
    <?= form_open('user/signin', ["class" => "col s12 card-panel", "id" => "signup-form"]) ?>
    <div class="row">
        <div class="input-field col s12">
            <input name="email" id="email" type="email" class="validate" v-model="email"  value="<?= set_value('email') ?>">
            <label for="email">Enter your email</label>
        </div>
    </div>  
    <div class="row">
        <div class="input-field col s12">
            <input name="password" id="password" type="password" class="validate" v-model="password"  value="<?= set_value('password') ?>">
            <label for="password">Enter your password</label>
        </div>      
    </div>
        <button type="submit" v-bind:disabled="isDisabled" class="waves-effect waves-light btn">Envoyer</button>
    </form>
    <a href="<?= base_url() ?>index.php/user/forgot" class="waves-effect waves-light btn">
        I forgot my password...
    </a>
</div>
</div>