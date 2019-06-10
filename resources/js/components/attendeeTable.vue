<template>
    <div class="table-responsive">
        <table class="table table-hover mg-b-0">
            <thead>
                <tr class="tx-center">
                    <th>Employee Name</th>
                    <th>Employee Position</th>
                    <th>Employee Department</th>
                    <th>Registered</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="tx-center" v-for="(attendee) in attendees" :key="attendee.firstname">
                    <td class="pt-3">{{ attendee.firstname }} {{ attendee.middlename[0] }}. {{ attendee.lastname }}</td>
                    <td class="pt-3">{{ attendee.position[0].position }}</td>
                    <td class="pt-3">{{ attendee.department[0].department_name }}</td>
                    <td class="pt-3">{{ attendee.created_when }}</td>
                    <td>
                        <button class="btn btn-danger tx-light btn-sm delete" @click="deleteAttendee(attendee)">
                            Remove <i class="icon ion-md-close"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div><!-- table-responsive -->
</template>

<script>
    import { EventBus } from "./EventBus.js";
    export default {
        name: "attendeeTable",
        props: ['activityId'],
        created() {
           this.getAllAttendees()
           EventBus.$on('re-render', (employee) => {
               this.attendees.push(employee)
            })
        },
        destroyed(){
            EventBus.$off('re-render')
        },
        data(){
            return {
                attendees: [],
            }
        },
        methods:{
            deleteAttendee: function(attendee) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !swal.isLoading(),
                    preConfirm: () => {
                        return axios.post('/removeAttendee/'+attendee.id+'/'+this.activityId, {
                            _method: "DELETE",
                            attendeeId: attendee.id,
                            activityId: this.activityId
                        })
                        .then(res => {
                            let index = this.attendees.indexOf(attendee)
                            // console.log(index)
                            this.attendees.splice(index, 1)
                            EventBus.$emit('delete', attendee)
                        })
                    }
                    }).then((result) => {
                    if (result.value) {
                       swal.fire({
                            position: 'top',
                            toast: true,
                            type: 'success',
                            title: 'Employee Successfully Deleted!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                })
            },

            getAllAttendees: function() {
                axios.get('/activity/'+this.activityId+'/getAttendees')
                .then((result) => {
                    this.attendees = result.data
                    console.log(this.attendees)
                })
            }
        }
    }
</script>
