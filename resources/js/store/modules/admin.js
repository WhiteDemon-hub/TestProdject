export default
{
    namespaced: true,
    actions:
    {
        async ActionAuth({commit}, data)
        {
            try
            {
                let answer = await axios
                .post('/login', data)
                if(answer.status == "204")
                    window.location = "/panel"
            }
            catch(error)
            {
                commit('MutationMsg', "Некорректный логин или пароль")
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
        GetMessages(state)
        {
            return state.message;
        }
    }
}