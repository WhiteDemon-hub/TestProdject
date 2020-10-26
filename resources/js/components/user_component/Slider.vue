<template>
    <div class="container p-3">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li v-for="item in GetSlider" :key="item.id" data-target="carouselExampleIndicators" @click="Change(item.id)" :data-slide-to="item.id" :class="{'active':item.id==GetSelect}"></li>
        </ol>
        <div class="carousel-inner w-100">
            <div v-for="slide in GetSlider" :key="slide.id" class="carousel-item" :class="{'active':slide.id==GetSelect}">

                    <div class="slides m-auto w-100" :id="'slide'+slide.id" v-bind:style='{ background: `url(${"storage/img/sider/" + slide.image})`}'>
                        <div class="slide-inner">
                            <div class="p-5">
                                <h3>{{slide.name}}</h3>
                                <p>{{slide.description}}</p>
                            </div>
                        </div>
                    </div>
            </div>
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
</template>

<script>
import {mapGetters, mapActions, mapMutations} from 'vuex'
export default {
    data()
    {
        return {
            count: 0
        }
    },
    computed:
    {
        ...mapGetters('slider', ['GetSlider', 'GetSelect']),
    },
    methods:
    {
        ...mapActions('slider', ['ActionsSliderLoad']),
        ...mapMutations('slider', ['MutationSelect']),

        Change(id)
        {
            this.MutationSelect(id);
        }
    },
    mounted()
    {
        this.ActionsSliderLoad();
    }
}
</script>