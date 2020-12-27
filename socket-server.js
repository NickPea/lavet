/**
 * -------------------------------SOCKET-SERVER---------------------------------------------
 */

console.log(`****** Socket.IO Server Started *******`);

// ----------------- Imports -------------------------

const Redis = require("ioredis");
const HTTP = require("http");
const IO = require("socket.io");

// ----------------- Setup -------------------------

const redisSub = new Redis();
// const redisPub = new Redis();
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

// ----------------- Socket Connection & Events -------------------------

io.on("connection", (currentSocket) => {
    console.log(`-- SOCKET:CONNECTED -- \nsocket.id: ${currentSocket.id}`);

    //before disconnect
    currentSocket.on("disconnecting", (reason) => {
        console.log(
            `-- SOCKET:DISCONNECTING -- ${reason} \nsocket.id:${currentSocket.id}`
        );
        //todo:remove redis user-socket-mapping
    });

    //on disconnect
    currentSocket.on("disconnect", (reason) => {
        console.log(
            `-- SOCKET:DISCONNECT -- ${reason} \nsocket.id:${currentSocket.id}`
        );
        //todo:remove redis user-socket-mapping
    });

    //map a user to thier socket.io id to store in redis on connection (event initiated by browser client)
    currentSocket.on("map-socket-user", async (data) => {
        redisCmd.set(data.userEmailHash, currentSocket.id);
        console.log(
            `-- REDIS:MAP-SOCKET-USER -- \nredis-user-socket-mapping: {${
                data.userEmailHash
            }:${await redisCmd.get(data.userEmailHash)}}`
        );
    });

    // ----------------- Redis Connection & Events -------------------------

    //subcribe to a redis channel [WEBSOCKET]
    redisSub.subscribe(["WEBSOCKET"], (err, channelCount) => {
        err
            ? console.log(`-- REDIS:SUBCRIBED -- \nerror:${err}`)
            : console.log(`-- REDIS:SUBCRIBED -- \ncount:${channelCount}`);
    });

    // on any channel message from redis
    redisSub.on("message", async (redisChannel, redisMessage) => {
        console.log(
            `-- REDIS:ON-MESSAGE -- \nchannel: ${redisChannel}, message:${redisMessage}`
        );

        if (redisChannel == 'WEBSOCKET') {
            // de-serialize {userEmailHash: string, socketMessage: string}
            let data = JSON.parse(redisMessage);
    
            // get socket.id from redis mapping using hash
            let socketId = await redisCmd.get(data.userEmailHash);
    
            //send message data to socket.io room
            currentSocket.to(socketId).emit("WEBSOCKET-MESSAGE", data.socketMessage);
        }

    }); //redisOnMessage

}); //ioOnConnection

