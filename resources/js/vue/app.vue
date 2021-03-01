<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">{{__('T1')}}</h2>
            <app-itemform
            v-on:reloadlist="getList()"/>
        </div>

        <list-view
            :items="items"
            v-on:reloadlist="getList()"/>
    </div>
</template>

<script>

import AppItemform from './appItemForm.vue';
import ListView from './listView.vue';


export default {
    data: function(){
        return {
            items: []
        }
    },
    components: {
        AppItemform,
        ListView
    },
    methods: {
        getList(){
            axios.get('api/items')
                .then (response => {
                    this.items = response.data
                })
                .catch(error => {
                    console.log(error);
                })

        }
    },
    created() {
        this.getList();
        console.log(this.__('T1'));
    }
}
</script>

<style scoped>
    .todoListContainer {
        width: 350px;
        margin: auto;
    }
    .heading {
        background: #e6e6e6;
        padding: 10px;
    }
    #title{
        text-align: center;
    }
</style>
