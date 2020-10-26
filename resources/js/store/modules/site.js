export default
{
    namespaced: true,
    actions:
    {
        async ActionLoadInfo({commit})
        {
            await axios
            .get('/site')
            .then(
                response =>
                {
                    console.log(response)
                    commit('MutationLoadInfo', response.data)
                }
            )
        },
        async ActionUpdate({commit}, data)
        {
            let res = await axios
            .post('/site/1', data, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }})
            console.log(res);
            commit('MutationLoadInfo', res.data)
        }
    },
    mutations:
    {
        MutationLoadInfo(state, data)
        {
            state.info = data.site[0];
        }
    },
    state:
    {
        info: []
    },
    getters:
    {
        GetInfo(state)
        {
            return state.info;
        }
    }
}