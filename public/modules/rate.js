// config
const createStore = (reducer) => {
    let state = reducer(undefined, {})
    const subscribers = []
    return {
        getState: () => state,
        dispatch: (action) => {
            state = reducer(state, action)
            subscribers.forEach(subscriber => subscriber())
        },
        subscribe: (subscriber)=> {
            subscribers.push(subscriber)
        }
    }
}
const ADD_RATE = 'ADD_RATE';
const FETCH_RATE_SUCCESS = 'FETCH_RATE_SUCCESS';

// actions
const addRate = (value) => ({
    type: ADD_RATE,
    payload: value
});

// api
class apiRate {
    async fetch() {
        try {
            const response = await axios.get('/rate/list/');
            const listRate = response.data;
            store.dispatch({ type: 'FETCH_RATE_SUCCESS', payload: listRate });
        } catch (err) {
            console.log(err);
        }
    }
    async create(values) {
        try {
            const response = await axios.post('/rate/add',
                {
                    "_token": token,
                    product_id: values.product_id,
                    rating: values.rating,
                    review: values.review,
                }
            );
            return response.data
        } catch (err) {
            console.log(err);
        }
    }
}
class rateReducers extends apiRate{
    constructor(state, action) {
        super();
        this.state = state
        this.action = action
    }
    reducerFetch() {
        return {
            ...this.state,
            listRate: this.action.payload,
        };
    }
    reducerCreate() {


    }
    async reducerDefault() {
        await this.fetch()
        return this.state;
    }
}

// reducer
const initialState = {
    listRate: [],
};
const rateReducer = (state = initialState, action) => {
    const rateReduce = new rateReducers(state, action)
    switch (action.type) {
        case FETCH_RATE_SUCCESS:
            return rateReduce.reducerFetch()
        case ADD_RATE:
            return rateReduce.reducerCreate()
        default:
            return rateReduce.reducerDefault()
    }
}

// store
const store = window.store = createStore(rateReducer);
store.subscribe(() => console.log(store.getState()))
