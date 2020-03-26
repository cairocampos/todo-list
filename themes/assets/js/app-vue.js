import Helpers from "./helpers.js";

var preload = {
    data:  {
      loading: false
    }
  }

Vue.component("preloader", {
    template: "<div class='preloader'><span></span><span></span><span></span></div>"
})

let Register = new Vue({
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

let Tasks = new Vue({
    el: "#tasks",
    mixins: [preload],
    data: {
        tasks: [],
        item: {},
        form: {
            task: ""
        },
        edit: {
            id: "",
            title: "",
            status: 0
        },
        alertRequired: false
    },
    methods: {
        requestSuccess() {
            document.querySelector(".toast-custom").classList.add("active");
            setTimeout(() => {document.querySelector(".toast-custom").classList.remove("active");}, 2800);
        },
        async SendTask() {
            this.alertRequired = false;

            if(!this.form.task) {
                this.alertRequired = true;
                return;
            } else {
                let form = new FormData(document.querySelector("#tasks form"));
                let data = await Helpers.request("/api/tasks", "POST", form);
                this.tasks.push({id: data.id, title: data.title, status: data.status});
                this.form.task = "";         
            }           

            this.alertRequired = false;

            this.requestSuccess();

        },
        async getTasks() {
            this.loading = true;
            let data = await Helpers.request("api/tasks", "GET", {});
            if(data) {
                this.tasks = data;
            }

            this.loading = false
        },
        async del(id) {
            await Helpers.request("/api/tasks", "DELETE", `id=${id}`);
            this.tasks.filter((item, index) => {
                if(item.id == id) this.tasks.splice(index, 1);
            });

            this.requestSuccess();

        },
        async update(id) {
            this.edit.id = id;
            let data = await Helpers.request("/api/tasks", "PUT", Helpers.serialize(this.edit));
            delete data.created_at;
            delete data.updated_at;
            delete data.id_user;
            this.tasks.find((item, index) => {
                if(item.id == id) {
                    this.tasks[index] = Object.assign(item, data);
                } 
            });

            this.requestSuccess();
            this.edit.id = "";
            this.edit.title = "";
            this.edit.status = 0;
            this.closeEdit();

        },
        startUpdate(id) {
            let filter = this.tasks.filter((item, index) => {
                if(item.id == id) {
                    this.edit.title = this.tasks[index].title
                    return this.tasks[index]["edit"] = true
                }
                else 
                    return delete this.tasks[index].edit
            });             
            this.tasks = filter;
        },
        closeEdit() {
            this.startUpdate(null);
        },
        async handlerCheck(element) {
            this.edit.title = element.title;
            this.edit.status = element.status == 1 ? 0 : 1;
            
            this.update(element.id);
        }
    },
    created() {
        this.getTasks();
    }
});
