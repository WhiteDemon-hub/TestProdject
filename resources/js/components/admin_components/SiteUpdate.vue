<template>
    <div class="overflow-hidden">
        <div class="row justify-content-center mt-2">
            <div class="card-header text-center w-100 m-0">
                <h2>Обновление информации на сайте</h2>
            </div>
            <form class="card-body p-0 m-0 bg-light h-100" @submit.prevent="Update"> 
                <div class="form-group h-25 pb-4 pt-4 text-light row d-flex flex-warp flex-row justify-content-around bg-dark m-auto">
                    <h3 class="w-100 text-center">Замена логотипа</h3>
                    <label for="select-logo" class="mt-auto mb-auto btn btn-primary"><i class="fa fa-cloud-upload"></i> Выберете файл</label>
                    <input type="file" id="select-logo" accept="image/png" @change="SelectLogo" ref="file" class="form-control-file d-none">
                    <img :src="Logo" width="150px" class="w-25 wh-max" ref="dd">
                    <img :src="'/storage/'+GetInfo.logo" width="150px" ref="target" draggable="true" class="wh-max">
                </div>
                <div class="form-group pb-4 h-25 pt-4 text-dark row d-flex flex-warp flex-row justify-content-around bg-light m-auto">
                     <h3 class="w-100 text-center">Почта</h3>
                     <input type="email" v-model="email" placeholder="new email" autocomplete="email">
                     <p class="p-0">{{email}}</p>
                     <p class="p-0">{{GetInfo.email}}</p>
                </div>
                <div class="form-group pb-4 pt-4 text-light row d-flex flex-warp flex-row justify-content-around bg-dark m-auto">
                    <h3 class="w-100 text-center">Заголовок</h3>
                     <input type="text" v-model="titel"  placeholder="new titel">
                     <p class="p-0">{{titel}}</p>
                     <p class="p-0">{{GetInfo.titel}}</p>
                </div>
                <div class="form-group pb-4 h-25 pt-4 text-dark row  d-flex flex-column justify-content-around bg-light">
                    <h3 class="w-100 text-center m-auto">Текст подвала</h3>
                    <div  class="pl-5 pt-2 m-auto">
                        <div id="con" class="w-100 reader-warrper">
                            <textarea id="footer-text" class="textReader" cols="40"></textarea>
                        </div>
                    </div>
                    <div class="m-auto pt-2 pl-5">
                        <div class="w-100 reader-warrper justify-content-center d-flex flex-column"> 
                            <h4 class="">Текущий текст:</h4>
                            <div class="m-auto " v-html="GetInfo.footer_text"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-light h-25 row d-flex flex-warp flex-row justify-content-around pb-4 pt-4 bg-dark">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Axios from 'axios'
import Vue from "vue"
import {mapGetters, mapActions} from 'vuex'
export default {
    data()
    {
        return {
            logo: '/storage/img/drop-files-here-extra.jpg',
            image: '',
            footer_text: '',
            titel: '',
            email: '',
            dragAndDropCapable: false,
        }
    },
    computed:
    {
        ...mapGetters('site', ['GetInfo']),

        Logo()
        {
            return this.logo;
        }
    },
    methods:
    {
        ...mapActions('site', ['ActionLoadInfo', 'ActionUpdate']),
        SelectLogo(e)
        {
            var files = e.target.files || e.dataTrasfer.files;
            if(files)
            {
                // 
                this.image = this.$refs.file.files[0];
                console.log(this.image);
                var reader = new FileReader();
                reader.onload = (es) =>
                {
                    this.logo =  es.target.result;
                };
                reader.readAsDataURL(files[0])
            }
        },

        Update()
        {
            this.footer_text = document.querySelector('.nicEdit-main').innerHTML;
            console.log(this.footer_text);
            var data = new FormData();
            data.append("id", this.GetInfo.id);
            data.append("logo", this.image);
            data.append("email", this.email);
            data.append("footer_text", this.footer_text);
            data.append("titel", this.titel);
            data.append('_method', 'PATCH');
            console.log(this.image);
            this.ActionUpdate(data);
        },

        determineDragAndDropCapable(){
            var div = document.createElement('div');
            return ( ( 'draggable' in div )
            || ( 'ondragstart' in div && 'ondrop' in div ) )
            && 'FormData' in window
            && 'FileReader' in window;
}
    },
    mounted()
    {
        this.ActionLoadInfo();
        this.dragAndDropCapable = this.determineDragAndDropCapable();

        if(this.dragAndDropCapable)
        {
            ['drag', 'deagstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function(event)
            {
                this.$refs.dd.addEventListener(event, function(e)
                {
                    e.preventDefault();
                    e.stopPropagation();
                }.bind(this), false);
            }.bind(this));

            this.$refs.dd.addEventListener('dragleave', function(e){
            });

            this.$refs.target.addEventListener('deagstart', event => {
                event.dataTransfer.setData("url", event.target.currentSrc);
            });


            this.$refs.dd.addEventListener('drop', function(e){
                var files = e.target.files || e.dataTransfer.files;
                if(files.length > 0)
                {
                    if(files[0].type == 'image/png')
                    {
                        this.image = files[0];
                        var reader = new FileReader();
                        reader.onload = (es) =>
                        {
                            this.logo =  es.target.result;
                        };
                        reader.readAsDataURL(files[0])
                    }
                }
                else
                {
                    if(e.dataTransfer.getData('url').length > 0)
                    this.logo = e.dataTransfer.getData('url');
                    this.image = e.dataTransfer.getData('url');
                }
            }.bind(this));
        }
    }
}
</script>