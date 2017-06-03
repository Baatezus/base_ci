var app = new Vue({
    el: '#signin-app',
    data: {
        email: '',
        password: '',
        passconf: ''
        
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
        
         // Signin button computed property
        isDisabled: function() {
            return !(this.validPassword && this.validEmail);
        }
    }  
});
