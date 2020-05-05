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
                axios.patch(`/questions/${this.questionId}/answers/${this.id}`,{
                    body: this.body,
                }).then(res => {
                    this.editing = false
                    this.body = res.data.body
                    alert(res.data.message)
                }).catch(err => {
                    console.log('something')
                })
            }
        },
        computed: {
            inInvalid(){
                return this.body.length < 10;
            }
        }
    }
</script>

<style scoped>

</style>