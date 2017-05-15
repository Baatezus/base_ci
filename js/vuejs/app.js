var app = new Vue({
    el: '#app',
    
    data: {
        email: '',
        password: '',
        passconf: '',
        
    }, 
    
  
    computed: {
        // General computed properties
        validEmail: function() {
            var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return reg.test(this.email);
        },
        validPassword: function() {
            return this.password.length > 7;
        },
        validPassconf: function() {
            return this.passconf === this.password;
        },
        
        // Signup button computed property
        signupIsDisabled: function() {
            return !(this.validEmail && this.validPassword && this.validPassconf);
        }, 
        
        // Signin button computed property
        signinIsDisabled: function() {
            return !(this.validPassword && this.validEmail);
        },
        
        // Recover button computed property
        recoveryIsDisabled: function() {
            var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return !reg.test(this.email);
        },
        
        //New password button computed property
        newPwdIsDisabled: function() {
            return !(this.validPassword && this.validPassconf);
        }
    }   
});