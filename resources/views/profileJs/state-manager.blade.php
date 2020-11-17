
{{--  --}}



<script>

    function Store(reducer) {

            //PROPERTIES
            this.state = {};
            this.subscribers = [];
            this.reducers = []
            
            //METHODS
            this.subscribe = (fn) => {
                this.subscribers.push(fn);
            }
            this.publish = (action) => {
                //action
                console.log(`Action: ${JSON.stringify(action)}`)
                //old state
                let oldState = JSON.parse(JSON.stringify(this.state));
                console.log(`Old State: ${JSON.stringify(oldState)}`)
                //update
                if (this.reducers.length>0) {
                    this.reducers.forEach((reducer) => {
                        this.state[reducer.name] = reducer(oldState[reducer.name], action);
                    })
                }
                //new state
                let newState  = JSON.parse(JSON.stringify(this.state));
                console.log(`New State: ${JSON.stringify(newState)}`)
                //notify
                this.subscribers.forEach(subscriber => {
                    subscriber(oldState, newState);
                });
            }
            this.addReducer = (reducer) => {
                this.reducers.push(reducer);
                console.log(`Reducer Added: ${reducer}`);
                this.publish({type:'Initializing default state'});


            }
            this.getState = () => {
                return JSON.parse(JSON.stringify(this.state));
            }
            console.log('Store Created;')
    }//Store

    //New Store
    window.store = new Store();

    //Reducers
    store.addReducer(
        function counter(state = 2, action) {
            switch (action.type) {
                case 'add2':
                    return state + 2
                    break;
                default:
                    return state;
                    break;
            }
        }
    );


</script>




