let register = new Vue({
    el: "#register",
    data: {
        required: {
            name: "*", email: "*", pass: "*"
        },
        registerForm: {
            email: "", email: "", pass: ""
        },
        msgRequired: "Esse campo é obrigatório!"
    },
    methods: {
        SendForm() {
            this.clearRequired();

            if(!this.registerForm.name) {
                this.required.name = this.msgRequired;
            }
            
            if(!this.registerForm.email) {
                this.required.email = this.msgRequired;
            }

            if(!this.registerForm.pass) {
                this.required.pass = this.msgRequired;
            }

            if(this.registerForm.name && this.registerForm.email && this.registerForm.pass)
                $("#register .form").submit();                   

        },
        clearRequired() {
            this.required.name = "*";
            this.required.email = "*";
            this.required.pass = "*";
        }
    }
});