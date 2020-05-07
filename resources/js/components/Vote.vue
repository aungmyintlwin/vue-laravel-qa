<template>
    <div class="d-flex flex-column vote-controls">
        <a @click.prevent="voteUp" :title="title('up')" class="vote-up" :class="classess">
            <i class="fas fa-caret-up fa-3x" aria-hidden="true"></i>
        </a>
        <span class="votes-count">{{count}}</span>
        <a @click.prevent="voteDown" :title="title('down')" class="vote-dwon" :class="classess">
            <i class="fas fa-caret-down fa-3x" aria-hidden="true"></i>
        </a>
        <favorite v-if="name == 'question'" :question="model"></favorite>
        <accept v-else :answer="model"></accept>
    </div>
</template>

<script>
    export default {
        props: ['name','model'],
        data(){
            return{
                count: this.model.votes_count || 0,
                id: this.model.id
            }
        },
        computed: {
            classess(){
                return this.signedIn ? '' : 'off';
            },
            endpoint(){
                return `/${this.name}s/${this.id}/vote`;
            }
        },
        methods: {
            title(voteType){
                let titles = {
                    up: `This ${this.name} is useful`,
                    down: `This ${this.name} is not useful`
                }
                return titles[voteType];
            },
            voteUp(){
                this._vote(1);
            },
            voteDown(){
                this._vote(-1);
            },
            _vote(vote){
                if(!this.signedIn){
                    this.$toast.warning(`Please Login to vote ${this.name}`,'Warnging',{
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    return;
                }
                axios.post(this.endpoint,{vote})
                .then(res => {
                    this.$toast.success(res.data.message,'Success',{
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    this.count = res.data.votesCount;
                })
            }
        }       
    }
</script>

<style lang="scss" scoped>

</style>