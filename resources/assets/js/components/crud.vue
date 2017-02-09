<template>
    <div class="container">
        <h2>Data of University Tegal</h2>
        <p>This List of students</p>
        <!--<form action="student/search" method="get" v-on:submit.prevent="search()">-->

            <div class="form-group">
                <input type="text" name="search_input" class="form-control"
                       v-model="search_input" @keyup="fetchData()"
                       placeholder="Search"/>
            </div>


        <!--<ul class="list-group">
            <li class="list-group-item" v-for="student in students" v-if="search_input.length">{{student.name}}</li>
        </ul>-->
        <table class="table table-condensed">
            <thead>
            <tr>
                <!--<th v-for="column in columns">{{column}}</th>-->
                <th>No</th>
                <th>Nim</th>
                <th>Name</th>
                <th>Address</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <!--Isi Tabel-->
            <tr v-for="row in model.data">
                <!--<td v-for="(value, key) in row">{{value}}</td>-->
                <td>{{increment}}</td>
                <td>{{row.nim}}</td>
                <td>{{row.name}}</td>
                <td>{{row.address}}</td>
                <button @click="removeStudent(row.id)" class="btn"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </tr>
            </tbody>
        </table>
        <ul class="pager">
            <li @click="prev()"><a href="#">Previous</a></li>
            <li @click="next()"><a href="#">Next</a></li>
        </ul>

        <form v-on:submit.prevent="createStudent()">
            <div class="form-group">
                <label>Name:</label>
                <input name="name" type="text" class="form-control" v-model="newStudent.name">
            </div>
            <div class="form-group">
                <label>Nim:</label>
                <input type="text" class="form-control" name="nim" v-model="newStudent.nim">
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" name="address" v-model="newStudent.address">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
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
            address:''
        },
        data(){
            return {
                model: {},
                columns: {},
                number:1,
                students: [],
                search_input: '',
                id: '',
                url_search: 'student/search',
                newStudent:{'name':'','nim':'','address':''},
                pagination:{"total":0,"per_page":20,"current_page": 1,"page":1}

            }
        },
        computed:{
          increment:function () {
              return this.number++
          }
        },
        methods: {
            fetchData(){
                var vm = this
                //axios.get(this.source)
                axios.get(`${this.source}?search_input=${this.search_input}&page=${this.pagination.page}&per_page=${this.pagination.per_page}`)
                        .then(function (response) {
                            Vue.set(vm.$data, 'model', response.data.model)
                            Vue.set(vm.$data, 'columns', response.data.columns)
                        })
                        .catch(function (response) {
                            console.log(response)
                        })
            },
            createStudent: function () {
                var vm = this;
                var input = vm.newStudent;
                axios.post('api/student/saved',input)
                        .then(function (response) {
                            vm.fetchData()
                            vm.newStudent = {'name':'','nim':'','address':''}
                            console.log('sucess');
                        }).catch(function (response) {
                            console.log(response)

                })

            },
            removeStudent: function (id) {
                var vm = this
                axios.delete('api/student/delete/' + id)
                        .then(function (response) {
                            vm.fetchData()
                        }).catch(function (response) {
                    console.log(response)
                })
            },
            next(){
                if (this.model.next_page_url){
                    this.pagination.page++
                    this.fetchData()
                }
            },
            prev(){
                if (this.model.prev_page_url){
                    this.pagination.page--
                    this.fetchData()
                }
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