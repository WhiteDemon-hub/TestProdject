export default
{
    namespaced: true,
    actions:
    {
        async ActionLoadPlants({commit})
        {
            await
            axios
            .get('/plants')
            .then(
                response =>
                {
                    commit('MutationLoadPlants', response.data.plants)
                }
            )
        },
        async ActionDeletePlant({commit}, data)
        {
            let message =
            await
            axios
            .delete('/plants/'+data.id)
            if(message.data)
            {
                commit('MutationDeletePlant', data);
            }
            else
            {
                commit('MutationMessage', message.data.message);
            }
        },
        async ActionCreatePlants({commit}, data)
        {
            let result =
            await
            axios
            .post('/plants', data, {
                headers:
                {
                    'Content-type':'miltipart/from-data'
                }
            })
            if(result.data.plant != undefined)
            {
                commit('MutationCreatePlants', result.data.plant);
                commit('MutationDelViewPlant', data.get('id'));
            }
            else
            {
                commit('MutationMessage', result.data.message);
            }
        },
        async ActionCancelDelete({commit}, data)
        {
            let message =
            await
            axios
            .post('/plants/cancel', data)
            if(message.data)
            {
                commit('MutationCancelDeletePlant', data);
            }
            else
            {
                commit('MutationMessage', message.data.message);
            }
        },
        async ActionUpdatePlant({commit}, data)
        {
            let result =
            await
            axios
            .post('/plants/'+data.get('id'), data, {
                headers:
                {
                    'Content-type':'miltipart/from-data'
                }
            })
            if(result.data.plant != undefined)
            {
                commit('MutationUpdatePlant', result.data.plant);
            }
            else
            {
                commit('MutationMessage', message.data.message);
            }
        }
    },
    mutations:
    {
        MutationLoadPlants(state, data)
        {
            state.plants = data;
            state.plantsFind = data;
        },
        MutationDeletePlant(state, data)
        {
            state.plants.find(x=>x.id==data.id).del = '1';
        },
        MutationMessage(state, data)
        {
            state.message = data;
        },
        MutationCreatePlants(state, data)
        {
            state.plants.push(data);
        },
        MutationDelViewPlant(state, id)
        {
            state.plants.splice(state.plants.indexOf(state.plants.find(x=>x.id==id)), 1);
        },
        MutationCancelDeletePlant(state, data)
        {
            state.plants.find(x=>x.id==data.id).del = '0';
        },
        MutationUpdatePlant(state, data)
        {
            state.plants.find(x=>x.id==data.id).name = data;
            state.plants.find(x=>x.id==data.id).image = data;
        },
        MutationFindPlant(state, data)
        {
            var reg = new RegExp(data.toLowerCase());
            state.plantsFind = state.plants.filter(x=>reg.test(x.name.toLowerCase()));
        }

    },
    state:
    {
        plants: [],
        plantsFind: [],
        message: ''
    },
    getters:
    {
        GetPlans(state)
        {
            return state.plants;
        },
        GetMessagePlans(state)
        {
            return state.message;
        },
        GetPlansFind(state)
        {
            return state.plantsFind;
        }
    }
}