<template>
<div class="container">
    <div class="row justify-content-center p-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-light bg-dark text-center">
                    Вход
                </div>
                <form class="card-body p-2 bg-light" @submit.prevent="Auth">
                    <div class="form-group row">
                        <div class="col-md-6 m-auto p-auto">
                            <input placeholder="login" type="text"  class="form-control" v-model="login" required autofocus autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 m-auto p-auto">
                            <input placeholder="password" type="password" class="form-control" v-model="password" >
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-4 offset-md-4 m-auto">
                            <button type="submit" class="btn btn-primary form-control">
                                Вход
                            </button>
                        </div>
                    </div>
                    <div class="card-header text-light bg-danger text-lift m-2" v-if="GetMessages.length > 0">
                        {{GetMessages}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
export default {
    data()
    {
        return {
            login: '',
            password: ''
        }
    },
    computed:
    {
        ...mapGetters('admin', ['GetMessages']),
    },
    methods:
    {
        ...mapActions('admin', ['ActionAuth']),
        Auth()
        {
            const data = {
                username: this.login,
                password: this.password
            }
            this.ActionAuth(data);
        }
    }

}
</script>