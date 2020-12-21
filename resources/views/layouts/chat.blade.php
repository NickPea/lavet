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

         let userHash = '<?php echo hash(hash_algos()[5], Auth::user()->email??'')?>'; //SHA-256

            // ----------------- Connect -------------------------
            const socket = io('http://localhost:5000');

            // ----------------- Events -------------------------
            
            socket.on('connect', () => {
                console.error(`-- CONNECT -- \n socket: ${socket.id}`);
                socket.emit('map-user', {userHash: userHash});
                console.error(`-- MAP-USER -- \n userHash: ${userHash}`);
            });

            socket.on('disconnect', (reason) => {
                console.error(`-- DISCONNECT -- ${reason} \n socket: ${socket.id}, userHash: ${userHash} `);
            });


        }//ChatSocket()
        document.addEventListener('DOMContentLoaded', ChatSocket);


</script>