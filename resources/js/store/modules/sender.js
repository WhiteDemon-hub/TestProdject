export default
{
    namespaced: true,
    actions:
    {
        async ActionSnedMessage({commit}, data)
        {
            try
            {
                let answer = await axios
                .post('/send', data)
                if(answer.data.message != undefined)
                commit('MutationMsg', answer.data.message);
                else
                commit('MutationMsg', "Ваш запрос успешно отправлен!");
            }
            catch(error)
            {
                commit('MutationMsg', error)
            }           
        }
    },
    mutations:
    {
        MutationMsg(state, msg)
        {
            state.message = msg;
        }
    },
    state:
    {
        message: ''
    },
    getters:
    {
        GetMessage(state)
        {
            return state.message;
        }
    }
}