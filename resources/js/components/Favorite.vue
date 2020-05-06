<template>
    <a title="Click to mark as Favorite Question (Click anagin to undo)" :class="classess" @click="toggle">
        <i class="fas fa-star fa-2x" aria-hidden="true"></i>
        <span class="favorites-count">{{count}}</span>
    </a>
</template>

<script>
    export default {
        props: ['question'],
        data(){
            return{
                isFavorited: this.question.is_favorited,
                count: this.question.favorites_count,
                id: this.question.id
            }
        },
        computed: {
            classess(){
                return[
                    'favorite', 'mt-2',
                    ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
                ]
            },
            endpoint(){
                return `/questions/${this.id}/favorites`;
            },
        },
        methods: {
            toggle(){
                if( ! this.signedIn){
                    this.$toast.warning("Please Login to favorite this Question","Warning",{
                        timeout: 3000,
                        position: 'bottomLeft'
                    })
                }
                this.isFavorited ? this.destroy() : this.create();
            },
            destroy(){
                axios.delete(this.endpoint)
                .then(res => {
                    this.count--;
                    this.isFavorited = false
                })
            },
            create(){
                axios.post(this.endpoint)
                .then(res => {
                 this.count ++;
                    this.isFavorited = true
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>