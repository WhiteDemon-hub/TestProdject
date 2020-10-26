<template>
        <div class="slider carousel-item" :id="'slide'+item.id" ref="dd" :class="{'active':item.id==select}" v-bind:style='{ background: `url(${bg})`}'>
                <div class="slide-inner">
                    <form :id="'form'+item.id" @submit.prevent="Update" class="d-flex flex-column text-light pl-5 pr-5">
                        <div class="form-group flex-row justify-content-around">
                            <input class="bg-transparent text-light"  type="text" v-model="titel"  placeholder="titel" required>
                        </div>
                        <div class="text-light">
                            <textarea class="bg-transparent w-100 textarea-autosize text-light" v-model="text" name="" id="" rows="5" placeholder="Discription" :v-html="item.description" required></textarea>
                        </div>
                    </form>
                    <div class="row pl-5 pr-5">
                        <div class="form-group">
                            <label  :for="'select-file'+item.id" class="mt-auto mb-auto btn btn-primary"><i class="fa fa-cloud-upload"></i> Выберете файл</label>
                            <input type="file" :id="'select-file'+item.id" accept="image/*" @change="SelectFile" ref="file" class="form-control-file d-none">  
                        </div>
                        <div class="form-group pl-3 pr-3" v-if="item.del==0">
                            <button :form="'form'+item.id"  class="btn btn-primary">{{item.id | createOrUpdate}}</button>
                        </div>
                        <div class="form-group" v-if="item.del==0">
                            <button @click="Del" title="Удалить" class="btn btn-outline-danger">Удалить</button>
                        </div>
                        <div class="form-group" v-if="item.del==1">
                            <button @click="Сancel()"  class="btn btn-primary">Восстоновить</button>
                        </div>
                    </div> 
                </div>
        </div>
</template>

<script>
import Axios from 'axios'
import {mapGetters, mapActions, mapMutations} from 'vuex'
export default {
    props:
    {
        item:
        {
            type: Object,
            required: true
        }
    },

    data()
    {
        return {
            text: this.item.description,
            bg: 'storage/img/sider/' + this.item.image,
            path: '',
            titel: this.item.name
        }
    },
    filters:
    {
        createOrUpdate: function(value)
        {
            value =  String(value);
            var reg = new RegExp('newplant');
            if(reg.test(value))
            {
                return 'Добавить';
            }
            else
            {
                return 'Обновить';
            }
        }
    },
    computed:
    {
        ...mapGetters('slider', ['GetSelect']),

        select:
        {
            get()
            {
                return this.GetSelect;
            },
            set(value)
            {
                this.MutationSelect(value);
                return value;
            }

        }
    },

    methods:
    {
        ...mapMutations('slider', ['MutationSelect']),
        ...mapActions('slider', ['ActionUpdateSlide', 'ActiondeleteSlide', 'ActionCreateSlide', 'ActionCancelSlide']),
        Change()
        {

        },
        Del()
        {
            this.ActiondeleteSlide(this.item.id);
        },
        Update()
        {
            var data = new FormData();
            data.append("id", this.item.id);
            data.append("image", this.path);
            data.append("name", this.titel);
            data.append("description", this.text);
             data.append("del", this.item.del);
            
            var reg = new RegExp('newSlide');
            if(reg.test(this.item.id))
            {
                this.ActionCreateSlide(data);
            }
            else
            {
                data.append('_method', 'PATCH');
                this.ActionUpdateSlide(data);
            }
        },
        Сancel()
        {
            const data = 
            {
                id: this.item.id
            }
            this.ActionCancelSlide(data);
        },

        SelectFile(e)
        {
            var files = e.target.files || e.dataTransfer.files;
            
                if(files.length > 0)
                if(files[0].type.split('/')[0] == 'image')
                {
                        this.path = files[0];
                        var reader = new FileReader();
                        reader.onload = (es) =>
                        {
                            console.log(this.item);
                            document.querySelector("#slide"+this.item.id).style.background = "url('"+es.target.result+"')";
                        };
                        reader.readAsDataURL(files[0]);
                }
        }
    },

    mounted()
    {
            ['drag', 'deagstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function(event)
            {
                this.$refs.dd.addEventListener(event, function(e)
                {
                    e.preventDefault();
                    e.stopPropagation();
                }.bind(this), false);
            }.bind(this));

            this.$refs.dd.addEventListener('deagstart', event => {
                event.dataTransfer.setData("url", event.target.currentSrc);
            });


            this.$refs.dd.addEventListener('drop', function(e){;
                var files = e.target.files || e.dataTransfer.files;
                if(files.length > 0)
                {
                    if(files[0].type.split('/')[0] == 'image')
                    {
                        this.path = files[0];
                        var reader = new FileReader();
                        reader.onload = (es) =>
                        {
                            document.querySelector("#slide"+this.item.id).style.background = "url('"+es.target.result+"')";
                        };
                        reader.readAsDataURL(files[0]);
                    }
                }
                else
                {
                    this.path = e.dataTransfer.getData('url');
                    document.querySelector("#slide"+this.item.id).style.background = "url('"+e.dataTransfer.getData('url')+"')";
                }
            }.bind(this));
    }
}
</script>

<style>

</style>