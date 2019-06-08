<template>
    <div class="table-responsive">
        <div class="float-right pb-4"><input type="text" class="form-control" v-model="search" placeholder="Search..."></div>
        <table class="table table-hover mg-b-0">
            <thead>
                <tr class="tx-center">
                    <th>Employee Name</th>
                    <th>Employee Position</th>
                    <th>Employee Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="tx-center" v-for="employee in filterEmployees" :key="employee.id">
                    <td class="pt-3">{{ employee.firstname }} {{ employee.middlename[0] }}. {{ employee.lastname }}</td>
                    <td class="pt-3">{{ employee.position[0].position }}</td>
                    <td class="pt-3">{{ employee.department[0].department_name }}</td>
                    <td>
                        <div v-if="!employee.isAdded">
                            <button class="btn btn-success tx-light btn-sm" @click="addEmployee(employee)">
                                Add to Activity <i class="icon ion-md-checkmark"></i>
                            </button>
                            </div>
                        <div class="pt-2 tx-success" v-else>Added  <i class="icon ion-md-checkmark"></i></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><!-- table-responsive -->
</template>

<script>
    import { EventBus } from "./EventBus.js";
    export default {
        props: ['activityId'],
        name: "attendeeModal",
        created(){
            this.getAllEmployees()
            EventBus.$on('delete', (employee) => {
                let index = this.employees.indexOf(employee)
                // console.log(this.employees[index].isAdded)
                this.employees[index].isAdded = !this.employees[index].isAdded
            })
        },
        destroyed(){
            EventBus.$off('delete')
        },
        data(){
            return {
                employees: [],
                search: ''
            }
        },
        methods:{
            addEmployee(employee){
                axios.post('/addEmployeeToActivity', {
                    activityId: this.activityId,
                    employeeId: employee.id
                })
                .then(res => {
                    swal.fire({
                        position: 'top',
                        toast: true,
                        type: 'success',
                        title: 'Employee Successfully Added!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    // console.log(employee)
                    employee.isAdded = !employee.isAdded
                    EventBus.$emit('re-render', employee);
                })
            },
            getAllEmployees(){
                axios.get('/getAllEmployee/'+this.activityId)
                .then(res => {
                    this.employees = res.data
                })
            }
        },
        computed: {
            filterEmployees(){
                return this.employees.filter(employee =>{
                    return employee.firstname.toUpperCase().match(this.search.toUpperCase())
                            || employee.lastname.toUpperCase().match(this.search.toUpperCase())
                            || employee.middlename[0].toUpperCase().match(this.search.toUpperCase())
                            || employee.position[0].position.toUpperCase().match(this.search.toUpperCase())
                            || employee.department[0].department_name.toUpperCase().match(this.search.toUpperCase())
                })
            }
        }
    }
</script>
