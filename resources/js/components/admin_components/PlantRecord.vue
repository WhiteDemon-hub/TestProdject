<template>
    <tr>
        <td>
            {{item.id}}
        </td>
        <td>
            <div class="form-group flex-row justify-content-around">
                 <input class="bg-transparent text-dark"  type="text" v-model="name"  placeholder="name" required>
            </div>
        </td>
        <td>
            <img  width="120px" ref="dd" :src="src" alt="">
        </td>
        <dt class="d-flex flex-column m-auto h-100">
            <div class="p-2" style="width:150px">
                <label  for="select-file" class="mt-auto mb-auto btn btn-primary"><i class="fa fa-cloud-upload"></i> Выберете файл</label>
                <input type="file" id="select-file" accept="image/*" @change="SelectFile" ref="file" class="form-control-file d-none">  
            </div>
        </dt>
        <td>
            <form @submit.prevent="Update" v-if="item.del==0">
             <button  class="btn btn-primary del">
                {{item.id | createOrUpdate}}
            </button>
            </form>
        </td>
        <td v-if="item.del==0">
            <form @submit.prevent="Del">
            <button class="btn btn-outline-danger del">
                Удалить
            </button>
            </form>
        </td>
        <td v-if="item.del==1">
            <form @submit.prevent="Cancel">
            <button class="btn btn-outline-primary del">
                Восстоновить
            </button>
            </form>
        </td>
    </tr>
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
            name: this.item.name,
            src: '/storage/img/plants/'+this.item.image,
            image: '',
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
    methods:
    {
        ...mapActions('plants', ['ActionUpdatePlant', 'ActionLoadPlants', 'ActionDeletePlant', 'ActionCreatePlants', 'ActionCancelDelete']),
        ...mapMutations('plants', ['MutationCancelDeletePlant', 'MutationDeletePlant']),

        Del()
        {
            var reg = new RegExp('newplant');
            if(reg.test(this.item.id))
            {
                
                const data = {
                    id: this.item.id
                };
                this.MutationDeletePlant(data)
            }
            else
            {
                const data = {
                    id: this.item.id
                };
                this.ActionDeletePlant(data);
            }
        },
        Update()
        {
            var reg = new RegExp('newplant');
            if(reg.test(this.item.id))
            {
                var data = new FormData();
                data.append("id", this.item.id);
                data.append("image", this.image);
                data.append("name", this.name);

                this.ActionCreatePlants(data);
            }
            else
            {
                var data = new FormData();
                data.append("id", this.item.id);
                data.append("image", this.image);
                data.append("name", this.name);
                data.append('_method', 'PATCH');
                this.ActionUpdatePlant(data);
            }
        },
        Cancel()
        {
            var reg = new RegExp('newplant');
            if(reg.test(this.item.id))
            {
                
                const data = {
                    id: this.item.id
                };
                this.MutationCancelDeletePlant(data)
            }
            else
            {
                const data = {
                    id: this.item.id
                };
                this.ActionCancelDelete(data);
            }
        },

        SelectFile(e)
        {
            var files = e.target.files || e.dataTrasfer.files;
            if(files.length > 0)
            if(files[0].type.split('/')[0] == 'image')
            {
                // 
                this.image = this.$refs.file.files[0];
                console.log(this.image);
                var reader = new FileReader();
                reader.onload = (es) =>
                {
                    this.src =  es.target.result;
                };
                reader.readAsDataURL(files[0])
            }
        }
    },

    mounted()
    {
        $('[data-toggle="tooltip"]').tooltip();

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

            this.$refs.dd.addEventListener('deagstart', event => {
                event.dataTransfer.setData("url", event.target.currentSrc);
            });


            this.$refs.dd.addEventListener('drop', function(e){
                var files = e.target.files || e.dataTransfer.files;
                if(files.length > 0)
                {
                    if(files[0].type.split('/')[0] == 'image')
                    {

                        this.image = files[0];
                        var reader = new FileReader();
                        reader.onload = (es) =>
                        {
                            this.src =  es.target.result;
                        };
                        reader.readAsDataURL(files[0])
                    }
                }
                else
                {
                    if(e.dataTransfer.getData('url').length > 0)
                    this.src = e.dataTransfer.getData('url');
                    this.image = e.dataTransfer.getData('url');
                }
            }.bind(this));
    }
}
</script>