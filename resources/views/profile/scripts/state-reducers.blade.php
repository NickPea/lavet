
{{--  --}}



<script>

    //Reducers
    /*
    *NB:
    * The reducer function name and the default state value 
    * are, by convention, used as the state key name and initial value, respecitivley.
    * i.e counter(state = 2, action) = {couter: 2}
    */
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




