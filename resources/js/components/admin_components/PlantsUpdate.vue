<template>
    <div class="card overflow-hidden">
        <div class="card-header text-center w-100 m-0">
            <h2>Расстения</h2> 
        </div>
        <div class="cart-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Номер</th>
                    <th>Название</th>
                    <th>Фотография</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    <Plant v-for="item in GetPlans" :key="item.id"
                    v-bind:item="item"/>
                </tbody>
            </table>
        </div>
        <div class="form-group text-light h-25 row d-flex flex-warp flex-row justify-content-around pb-4 pt-4 bg-dark">
            <form @submit.prevent="AddPlant">
                <button type="submit" class="btn btn-primary">Добаить</button>
            </form>
            
        </div>
        <div class="card-header text-light bg-danger text-lift m-2" v-if="GetMessagePlans.length > 0">
                {{GetMessagePlans}}
            </div>
    </div>
</template>

<script>
import Axios from 'axios'
import {mapGetters, mapActions, mapMutations} from 'vuex'
import Plant from './PlantRecord'
export default {
    data()
    {
        return {
            count: 0
        }
    },
    components:
    {
        Plant
    },
    computed:
    {
        ...mapGetters('plants', ['GetPlans', 'GetMessagePlans']),
    },
    methods:
    {
        ...mapActions('plants', ['ActionLoadPlants', 'ActionDeletePlant', 'ActionCreatePlants', 'ActionCancelDelete']),
        ...mapMutations('plants', ['MutationCreatePlants']),
        AddPlant()
        {
            const data = {
                id: 'newplant'+this.count++,
                name: '',
                image: 'drop-files-here-extra.jpg',
                del: '0'
            };
            this.MutationCreatePlants(data);
        }
    },
    mounted()
    {
        this.ActionLoadPlants();
    }
}
</script>