/**
 * -------------------------------SOCKET-SERVER---------------------------------------------
 */

console.log(`****** Socket.io Started *******`);

// ----------------- Imports -------------------------

const Redis = require("ioredis");
const HTTP = require("http");
const IO = require("socket.io");

// ----------------- Setup -------------------------

const redisSub = new Redis();
const redisPub = new Redis();
const redisCmd = new Redis();

const httpServer = HTTP.createServer();

const io = IO(httpServer, {
    //CORS
    serveClient: false,
    cors: {
        origin: "https://lavet.test",
        methods: ["GET", "POST"]
    }
});

httpServer.listen(5000);

// ----------------- Connection -------------------------
io.on("connection", (currentSocket) => {
    console.log(`-- SOCKET:CONNECT -- \nsocket.id: ${currentSocket.id}`);

    // ----------------- Events -------------------------

    currentSocket.on("map-socket-user", async (data) => {
        redisCmd.set(data.userEmailHash, currentSocket.id);
        console.log(
            `-- REDIS:MAP-SOCKET-USER -- \nredis-user-socket-mapping: {${
                data.userEmailHash
            }:${await redisCmd.get(data.userEmailHash)}}`
        );
    });

    currentSocket.on("disconnect", (reason) => {
        console.log(
            `-- SOCKET:DISCONNECT -- ${reason} \nsocket.id:${currentSocket.id} \nsocket.userHash:${currentSocket.userEmailHash}`
        );
        //todo:remove redis user-socket-mapping
    });

    redisSub.subscribe(["socket-out"], (err, count) => {
        err
            ? console.log(`-- REDIS:SUBCRIBED -- \nerror:${err}`)
            : console.log(`-- REDIS:SUBCRIBED -- \ncount:${count}`);
    });

    //check redis is subscribed
    redisPub.publish("socket-out-user", "handshake", (err, res) => {
        err
            ? console.log(`-- REDIS:PUBLISH -- \nerror:${err}`)
            : console.log(
                  `-- REDIS:PUBLISH -- \nchannel:socket-out-user, numberOfClientsRecieved:${res}`
              );
    });

    redisSub.on("message", async (redisChannel, redisMessage) => {
        console.log(
            `-- REDIS:ON-MESSAGE -- \nchannel: ${redisChannel}, message:${redisMessage}`
        );
        handleSocketOutMessage(currentSocket, redisChannel, redisMessage);
    });

    // socket.disconnect();
}); //ioOnConnection


// ----------------- Helper Functions -------------------------

let handleSocketOutMessage = async function(currentSocket, redisChannel, redisMessage) {
    if (redisChannel == "socket-out") {
        // de-serialize
        let data = JSON.parse(redisMessage);
        // get socket.id from redis mapping
        let socketId = await redisCmd.get(data.userEmailHash);
        //send message data to socket.io room
        currentSocket.to(socketId).emit("message", data.socketMessage);
    }
};
