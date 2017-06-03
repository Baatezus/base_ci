var app = new Vue({
    el: '#forgot-app',
    data: {
        email: '',     
    }, 
    
    computed: {
        // General computed properties
        validEmail: function() {
            var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return reg.test(this.email);
        },
        
         // Signin button computed property
        isDisabled: function() {
            return !(this.validEmail);
        }
    }  
});
