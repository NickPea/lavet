
console.log(`****** Socket.io Started *******`);

/**
 * -------------------------------SOCKET-SERVER---------------------------------------------
 */


const Redis = require('ioredis');
const redis = new Redis();

// ----------------- Setup -------------------------
const httpServer = require('http').createServer()
const io = require('socket.io')(httpServer, {
    serveClient: false,
    cors: {
        origin: "https://lavet.test",
        methods: ["GET", "POST"]
    }
})
httpServer.listen(5000);


// ----------------- Connection -------------------------
io.on('connection', (socket) => {
    console.log(`-- CONNECT -- \n socket: ${socket.id}`);

    // ----------------- Events -------------------------
    
    socket.on('map-user', async (data) => {
        socket.userHash = data.userHash;
        console.log(`-- MAP-USER -- \n socket.userHash: ${socket.userHash}`);
    });

    socket.on('disconnect', (reason) => {
        console.log(`-- DISCONNECT -- ${reason} \n socket: ${socket.id}, socket.userHash: ${socket.userHash}`);
    });
    
    
    // socket.disconnect();






});//ioOnConnection



