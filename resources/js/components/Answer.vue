<script>
    export default {
        props: ['answer'],
        data(){
            return {
                editing: false,
                body: this.answer.body,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache: null,
            }
        },
        methods: {
            edit(){
                this.beforeEditCache = this.body,
                this.editing = true
            },
            cancle(){
                this.body = this.beforeEditCache,
                this.editing = false
            },
            update(){
                axios.patch(this.endpoint,{
                    body: this.body,
                }).then(res => {
                    this.editing = false
                    this.body = res.data.body
                    alert(res.data.message)
                }).catch(err => {
                    console.log('something')
                })
            },
            destroy(){
                if(confirm('Are you sure to delete')){
                    axios.delete(this.endpoint)
                    .then(res => {
                        $(this.$el).fadeOut(500, ()=>{
                            alert(res.data.message);
                        })
                    })
                }
            }
        },
        computed: {
            inInvalid(){
                return this.body.length < 10;
            },
            endpoint(){
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        }
    }
</script>

<style scoped>

</style>