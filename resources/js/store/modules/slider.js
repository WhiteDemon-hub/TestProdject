export default
{
    namespaced: true,
    actions:
    {
        async ActionsSliderLoad({commit})
        {
            await
            axios
            .get('/slider')
            .then(
                response =>
                {
                    commit('MutationsLoad', response.data.slider)
                }
            )
        },
        async ActionCreateSlide({commit}, data)
        {
            let result = await
            axios
            .post('/slider', data)
            if(result.data.slider != undefined)
            {
                console.log(result.data.slider)
                commit('MutationsCreateSlide', result.data.slider);
                commit('MutationDelete', data);
            }
            else
            {
                commit('MutationMessage', result.data.message)
            }
            
        },
        async ActionUpdateSlide({commit}, data)
        {
            let result = await
            axios
            .post('/slider/'+data.get('id'), data,{ 
            headers:{
                'Content-type': 'multipart/from-data'
            }})
            if(result.data.slider != undefined)
            {
                commit('MutationsCreateSlide', result.data.slider);
                commit('MutationDelete', data);
            }
            else
            {
                commit('MutationMessage', result.data.message)
                // console.log(result.data.message);
            }
        },
        async ActiondeleteSlide({commit}, data)
        {
            await
            axios
            .delete('/slider/'+data)
            commit('MutationDel', data);
        },
        async ActionCancelSlide({commit}, data)
        {
            await
            axios
            .post('/slider/cancel', data)
            commit('MutationCancel', data.id);
        }
    }, 
    mutations:
    {
        MutationsLoad(state, data)
        {
            state.slider = data;
        },
        MutationSelect(state, data)
        {
            state.select = data;
        },
        MutationsCreateSlide(state, data)
        {
            console.log(data)
            state.slider.push(data);  
            state.select = data.id;
        },
        MutationDelete(state, data)
        {
            state.slider.splice(state.slider.indexOf(state.slider.find(x=>x.id==data.get('id'))), 1);   
        },
        MutationDel(state, data)
        {
            state.slider.find(x=>x.id==data).del = '1';
        },
        MutationMessage(state, data)
        {
            state.message = data;
        },
        MutationCancel(state, data)
        {
            state.slider.find(x=>x.id==data).del = '0';
        }
    },
    state:
    {
        slider: [],
        select: '1',
        message: ''
    },
    getters:
    {
        GetSlider(state)
        {
            return state.slider;
        },
        GetSelect(stste)
        {
            return stste.select;
        },
        GetMessage(state)
        {
            return state.message;
        }
    }
}