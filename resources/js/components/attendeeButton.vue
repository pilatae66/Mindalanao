<template>
    <div>
        <button class="btn btn-danger tx-light btn-sm delete" @click="deleteAttendee">
            Remove <i class="icon ion-md-close"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['attendeeId', 'activityId'],
        name: "attendeeButton",
        data(){
            return {
                delete:{
                    attendeeId: this.attendeeId,
                    activityId: this.activityId,
                    _method: "DELETE"
                },
                url:'/removeAttendee/'+this.attendeeId+'/'+this.activityId
            }
        },
        methods:{
            deleteAttendee: function() {
                axios.post(this.url, this.delete)
                .then(res => {

                })
            }
        }
    }
</script>
