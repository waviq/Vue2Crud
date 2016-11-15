<template>
    <div class="container">
        <h2>Data of University Tegal</h2>
        <p>This List of students</p>
        <!--<form action="student/search" method="get" v-on:submit.prevent="search()">-->
        <form action="" method="get" v-on:submit.prevent="fetchData()">
            <div class="form-group">
                <input type="text" name="search_input" class="form-control"
                       v-model="search_input" @keyup="fetchData()"
                       placeholder="Search"/>
            </div>
        </form>

        <!--<ul class="list-group">
            <li class="list-group-item" v-for="student in students" v-if="search_input.length">{{student.name}}</li>
        </ul>-->
        <table class="table table-condensed">
            <thead>
            <tr>
                <th v-for="column in columns">{{column}}</th>
            </tr>
            </thead>
            <tbody>
            <!--Isi Tabel-->
            <tr v-for="row in model.data">
                <td v-for="(value, key) in row">{{value}}</td>
                <button @click="removeStudent(row.id)">X</button>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'
    export default{
        props: ['source'],
        created(){
            this.fetchData()
            //this.search()
        },

        /*redy:function () {
          this.fetchData();
        },*/
        query: {
            search_input: '',
        },
        data(){
            return {
                model: {},
                columns: {},
                query: '',
                students: [],
                search_input: '',
                id: '',
                url_search: 'student/search',


            }
        },
        methods: {
            fetchData(){
                var vm = this
                //axios.get(this.source)
                axios.get(`${this.source}?search_input=${this.search_input}`)
                        .then(function (response) {
                            Vue.set(vm.$data, 'model', response.data.model)
                            Vue.set(vm.$data, 'columns', response.data.columns)
                        })
                        .catch(function (response) {
                            console.log(response)
                        })
            },
            removeStudent: function (id) {
                var vm = this
                axios.delete('api/student/delete/' + id)
                        .then(function (response) {
                            this.model.splice(this.model.indexOf(model.data.id), 1)
                        }).catch(function (response) {
                            console.log(response)
                })
            },
            search: function () {
                /*var vm = this
                 axios.get(`${this.url_search}?search_input=${this.search_input}`)
                 .then(function (response) {
                 Vue.set(vm.$data, 'model', response.data.model)
                 Vue.set(vm.$data,'columns', response.data.columns)
                 })
                 .catch(function (response) {
                 console.log(response)
                 })*/

                /*axios.post('student/search/',{query:this.query},  function (response) {
                 Vue.set(vm.$data, 'students', response.data.students);
                 //this.students = response.students;
                 });*/
            }
        }
    }
</script>