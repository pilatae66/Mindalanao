<template>
    <div class="table-responsive">
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
                <tr class="tx-center" v-for="employee in employees" :key="employee.id">
                    <td class="pt-3">{{ employee.firstname }} {{ employee.middlename[0] }}. {{ employee.lastname }}</td>
                    <td class="pt-3">{{ employee.position[0].position }}</td>
                    <td class="pt-3">{{ employee.department[0].department_name }}</td>
                    <td>
                        <div v-if="!employee.isAdded">
                            <button class="btn btn-success tx-light btn-sm" @click="addEmployee(employee.id)">
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
        },
        data(){
            return {
                employees: []
            }
        },
        methods:{
            addEmployee(employeeId){
                axios.post('/addEmployeeToActivity', {
                    activityId: this.activityId,
                    employeeId: employeeId
                })
                .then(res => {
                    alert("done")
                    this.getAllEmployees();
                    EventBus.$emit('re-render');
                })
            },
            getAllEmployees(){
                axios.get('/getAllEmployee/'+this.activityId)
                .then(res => {
                    this.employees = res.data
                })
            }
        }
    }
</script>
