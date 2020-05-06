<template>
    <div>
        <a v-if="authorize('accept',answer)" title="Mars this answer as best answer" :class="classess"
        @click.prevent="create"
        >
            <i class="fas fa-check fa-2x" aria-hidden="true"></i>
        </a>
        <a v-if="accepted" title="The Question owner is accept this  as best answer" :class="classess">
            <i class="fas fa-check fa-2x" aria-hidden="true"></i>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['answer'],
        data(){
            return{
                isBest: this.answer.is_best,
                id: this.answer.id,
            }
        },
        methods: {
            create(){
                axios.post(`/answers/${this.id}/accept`)
                .then(res => {
                    this.$toast.success(res.data.message,'Success',{
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    this.isBest = true;
                })
            }
        },
        computed: {
            canAccept(){
                return this.authorize('accept', this.answer);
            },
            accepted(){
                return !this.canAccept && this.isBest;
            },
            classess(){
                return[
                    'mt-2',
                    this.isBest ? 'vote-accepted' : '',
                ]
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>