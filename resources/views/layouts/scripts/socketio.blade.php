{{--  --}}

<script>

    function WebSockets() {
        
        let userEmailHash = '<?php echo hash(hash_algos()[5], Auth::user()->email??'')?>'; //SHA-256
        //todo: store in database user table on registration
        
        const socket = io('http://localhost:5000');
        
        socket.on('connect', () => {
            socket.emit('map-socket-user', {userEmailHash: userEmailHash});
            console.error(`-- CONNECTED: mapping user & socket -- \n userEmailHash: ${userEmailHash}, socket.id: ${socket.id}`);
        });

        socket.on('disconnect', (reason) => {
            console.error(`-- DISCONNECTED -- ${reason} \n userEmailHash: ${socket.userEmailHash}, socket: ${socket.id},`);
        });

        socket.on('FROM-NODE-TO-BROWSER', async (data) => {

           switch (data.action) {
               case 'new-message' : {
                   try {
                        refreshProfileChatMessages();
                   } catch (error) {
                        console.error('new-message'); 
                   }
                    break;
               }//new-message
               default:
                   break;
           }//sw

        });

    }
    document.addEventListener('DOMContentLoaded', WebSockets);


</script>