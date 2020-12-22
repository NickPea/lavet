{{--  --}}


<style>


</style>

<!-- ------------------------------------------------------------------------------------------ -->


<div class="position-fixed" style="bottom:20px; right: 33%">
    <div>hello</div>
</div>


<!-- ------------------------------------------------------------------------------------------ -->

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.1/socket.io.min.js"></script> --}}
<script>
    function ChatSocket() {

        /**
         * -------------------------------SOCKET-CLIENT--------------------------------------
         */

        let userEmailHash = '<?php echo hash(hash_algos()[5], Auth::user()->email??'')?>'; //SHA-256
        //todo: store in database user table on registration

            // ----------------- Connect -------------------------
            const socket = io('http://localhost:5000');

            // ----------------- Events -------------------------
            
            socket.on('connect', () => {
                console.error(`-- CONNECT -- \n socket.id: ${socket.id}`);
                socket.emit('map-socket-user', {userEmailHash: userEmailHash});
                console.error(`-- MAP-SOCKET-USER -- \n userEmailHash: ${userEmailHash}`);
            });

            socket.on('disconnect', (reason) => {
                console.error(`-- DISCONNECT -- ${reason} \n socket: ${socket.id}, userEmailHash: ${socket.userEmailHash} `);
            });


        }//ChatSocket()
        document.addEventListener('DOMContentLoaded', ChatSocket);

</script>