<template>
    <div class="container">
        
        <div class="input-group mb-3">
            <input type="text" v-model="find_text" class="form-control" placeholder="Поиск...">
            <div class="input-group-prepend">
                <div class="input-group-text bg-dark text-light rounded-right">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row flex-wrap justify-content-around">
            <div v-for="plant in GetPlansFind" :key="plant.id" class="m-2 d-flex flex-column justify-content-center text-center rounded border border-info">
                <div class="plant rounded-top  m-0 p-0"  v-bind:style='{ background: `url(${"storage/img/plants/" + plant.image})`,
                backgroundSize: `cover`}'>     
                </div>
                <a href="#" class="badge badge-info rounded-top-0"><p class="h5">{{plant.name}}</p></a>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions, mapMutations} from 'vuex'
export default {
    data()
    {
        return {
            find_text: ''
        }
    },
    computed:
    {
        ...mapGetters('plants', ['GetPlans', 'GetMessagePlans', 'GetPlansFind']),
    },
    watch: {
        find_text(newVal) {
            this.MutationFindPlant(newVal);
        },
    },
    methods:
    {
        ...mapActions('plants', ['ActionLoadPlants']),
        ...mapMutations('plants', ['MutationFindPlant']),
    },
    mounted()
    {
        this.ActionLoadPlants();
    }
}
</script>