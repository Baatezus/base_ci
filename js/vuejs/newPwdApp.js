var app = new Vue({
    el: '#new-pwd-app',
    data: {
        password: '',
        passconf: ''
        
    }, 
    
    computed: {
        // General computed properties
        validPassword: function() {
            return this.password.length > 7;
        },
        validPassconf: function() {
            return this.passconf === this.password;
        },
        
        // Signup button computed property
        isDisabled: function() {
            return !(this.validPassword && this.validPassconf);
        }
    }  
});
