const {createApp} = Vue;

createApp({
    data() {
        return {
            todo: [],
            apiUrl: 'server.php',
            lastId: null,
            newTask: {
                text: "",
            },
            itemText: '',
            done: ''
        }
    },
    methods: {
        getData(){
            axios.get(this.apiUrl).then((res) => {
                this.todo = res.data;
            })
        }, 
        addTodo(){
            const task = { ...this.newTask };
            this.newTask = {
                text: "",
            },
            this.lastId += 1;
            task.id = this.lastId;
            this.todo.push(task);
            const data = new FormData();
            data.append('text', task.text)
            axios.post(this.apiUrl, data).then((res) => {
                console.log(res.data);
                this.lastId = this.todo.length - 1;
            })
        }
    },
    computed: {
        filteredTodo(){
            return this.todo.filter((el) => {
                if(this.done === ''){
                    return true;
                }
                if(this.done === 'false'){
                    return el.done === false
                }
                if(this.done === 'true'){
                    return el.done === true
                }
            })
        }
    },
    mounted() {
        console.log(this.todo);
        this.getData();
    },
}).mount('#app')