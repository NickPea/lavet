

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
                console.log('Action Created: ')
                console.log(action)
                //old state
                let oldState = JSON.parse(JSON.stringify(this.state));
                // console.log(`Old State: ${JSON.stringify(oldState)}`)
                //update
                if (this.reducers.length>0) {
                    this.reducers.forEach((reducer) => {
                        this.state[reducer.name] = reducer(oldState[reducer.name], action);
                    })
                }
                //new state
                let newState  = JSON.parse(JSON.stringify(this.state));
                console.log('New State:');
                console.log(newState);
                //notify
                this.subscribers.forEach(subscriber => {
                    subscriber(oldState, newState);
                });
            }
            this.addReducer = (reducer) => {
                this.reducers.push(reducer);
                console.log('Reducer Added: ');
                console.log(reducer);
                this.publish({type:'Initializing default state'});


            }
            this.getState = () => {
                return JSON.parse(JSON.stringify(this.state));
            }
            console.log('Store Created;')
    }//Store

    //New Store
    window.store = new Store();
 


</script>




