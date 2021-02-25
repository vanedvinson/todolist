<template>
    <div class="addItem">
        <form @submit.prevent="addItem">
            <input type="text" v-model="item.name"/>
            <!-- <button type="submit">press me pls</button> -->
            <font-awesome-icon
            type="submit"
            icon="plus-square"
            @click="addItem()"
            :class="[item.name ? 'active' : 'inactive', 'plus']"/>
        </form>

    </div>
</template>

<script>
export default {
    data: function(){
        return{
            item: {}
        }
    },
    methods: {
        addItem(){
            console.log("starting add item");
            console.log("starting axios post");
            axios.post(`http://localhost:8000/api/item/store`, this.item)
                .then(Response => {
                    if(Response.status == 200 || Response.status == 201){
                        this.item.name = "";
                        this.$emit('reloadlist')
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>
.addItem{
    display: flex;
    justify-content: center;
    align-items: center;
}
.addItem input{
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.plus {
    font-size: 20px;

}
.active {
    color:green;
}
.inactive {
    color: lightgray;
}
</style>
