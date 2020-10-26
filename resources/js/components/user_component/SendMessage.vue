<template>
    <div>
        <button class="m-auto w-100 btn btn-primary" data-toggle="modal" data-target="#exampleModal">Заказать</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заказать звонок</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sender" @submit.prevent="SendMessage">
                        <div>
                            <!-- <label for="recipient-name" class="col-form-label">Номер телефона:</label> -->
                            <p>Почта:</p>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    @
                            </div>
                            </div>
                                <input v-model="email" type="email" placeholder="XXXX@XXXX.XXX" class="form-control" required>
                            </div>
                        </div>
                        <div>
                            <!-- <label for="recipient-name" class="col-form-label">Номер телефона:</label> -->
                            <p>Номер телефона:</p>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    +7
                            </div>
                            </div>
                            <input v-model="phone" type="text" placeholder="(XXX) XXX-XX-XX" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label for="message-text" class="col-form-label">Сообщение:</label> -->
                            <p>Сообщение:</p>
                            <div class="d-flex flex-column m-auto">
                            <div id="con" class="con d-flex flex-column m-auto">
                                <textarea style="width: 100%;" name="send"></textarea>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger del"  data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" form="sender">Отправить</button>
                </div>
            </div>
        </div>
        </div>

        <div class="modal fade bd-example-modal-sm " id="result" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content p-3 text-center">
                    {{GetMessage}}
                </div>
        </div>
</div>

</div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {

    data()
    {
        return {
            email: '',
            phone: ''
        }
    },
    computed:
    {
        ...mapGetters('sender', ['GetMessage'])
    },
    methods:
    {
        ...mapActions('sender', ['ActionSnedMessage']),
        SendMessage()
        {
            const data = 
            {
                email: this.email,
                phone: this.phone,
                content: document.querySelector('.nicEdit-main').innerHTML
            };

            

            this.email = '';
            this.phone = '';
            document.querySelector('.nicEdit-main').innerHTML = '<br/>';
            this.ActionSnedMessage(data)
            
            $('#exampleModal').modal('hide');
            $('#result').modal('show');
        }
    },
    mounted()
    {
        // console.log(document.querySelectorAll('.con>div'));
        //document.querySelector('.nicEdit-main').style.width = "100%";
    }
}
</script>

<style scoped>
    .con > div
    {
        width: 100% !important;
    }
    .nicEdit-main, .nicEdit-selected
    {
        width: 98% !important;
    }
</style>