<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your Answer</h3>
                    </div>
                    <hr>
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <textarea id="" class="form-control" rows="7" name="body" v-model="body"></textarea>
                        </div>
                        <div class="form-group">
                            <button :disabled="isInvalid" class="btn btn-lg btn-outline-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['questionId'],
        data(){
            return{
                body: ''
            }
        },
        methods: {
            create(){
                axios.post(`/questions/${this.questionId}/answers`,{
                    body: this.body
                })
                .then(({data}) => {
                        this.$toast.success(data.message,'Success');
                    this.body = '';
                    this.$emit('created',data.answer);
                })
                .catch(error => {
                        this.$toast.error(error.response.data.message,'Error');
                    })
            }
        },
        computed: {
            isInvalid(){
                return !this.signedIn || this.body.length <10;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>