<template>
    <div class="w-100 d-flex flex-column overflow-hidden ">
        <div class="card-header text-center w-100 m-0">
                <h2>Редактировать слайдер</h2>
        </div>
        <div class="form-group text-light h-25 row d-flex flex-warp flex-row justify-content-around pb-4 pt-4 bg-dark">
            <button class="btn btn-primary" @click="NewSlide">Добавить слайд</button>
        </div>
        <!-- <div class="card-header text-center w-100 m-0">
                <h2>Редактировать слайдер</h2>
        </div>
        <div>
            <div class="form-group text-light h-25 row d-flex flex-warp flex-row justify-content-around pb-4 pt-4 bg-dark">
                <button class="btn btn-primary" @click="NewSlide">Добавить слайд</button>
            </div>
            <div class="slider">
                <SliderItrm 
                     v-for="item in GetSlider" :key="item.id"
                     v-bind:item="item"/>
                <div class="controls"> 
                    <div>
                        <label  v-for="item in GetSlider" :key="item.id" :for="'item-'+item.id" :class="{'bg-danger':select!=item.id}"></label>
                    </div>
                </div>
                <div class="card-header text-light bg-danger text-lift m-2" v-if="GetMessage.length > 0">
                        {{GetMessage}}
                </div>
            </div>    
        </div> -->
        <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
            <li v-for="item in GetSlider" :key="item.id" data-target="carouselExampleIndicators" @click="Change(item.id)" :data-slide-to="item.id" :class="{'active':item.id==select}"></li>
        </ol>
        <div class="carousel-inner w-100">
            <SliderItrm 
                     v-for="item in GetSlider" :key="item.id"
                     v-bind:item="item"/>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    </div>
    <div class="card-header text-light bg-danger text-lift m-2" v-if="GetMessage.length > 0">
        {{GetMessage}}
    </div>
    </div>
</template>

<script>
import Axios from 'axios'
import Vue from "vue"
import {mapGetters, mapActions, mapMutations} from 'vuex'
import SliderItrm from './SliderItem'
export default {
    data()
    {
        return {
            titel: '',
            count: 0,
        }
    },
    components:
    {
        SliderItrm,
    },
    methods:
    {
        ...mapActions('slider', ['ActionsSliderLoad']),
        ...mapMutations('slider', ['MutationSelect', 'MutationsCreateSlide', 'MutationSelect']),

        NewSlide()
        {
            const data = {
                id: 'newSlide' + this.count++,
                image: 'drop-files-here-extra.jpg',
                name: '',
                description: '',
                del: '0'
            }
            console.log(data);
            this.MutationsCreateSlide(data);
        },
        Change(id)
        {
            this.MutationSelect(id);
        }
    },
    computed:
    {
        ...mapGetters('slider', ['GetSelect', 'GetSlider', 'GetMessage']),

        select:
        {
            get()
            {
                return this.GetSelect;
            },
            set(value)
            {
                this.MutationSelect(value);
                console.log(value);
                return value;
            }

        }
    },
    mounted()
    {
        this.ActionsSliderLoad();
    }
}
</script>