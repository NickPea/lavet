//

console.log(`****** Socket.IO Server Started *******`);

// ----------------- Imports -------------------------

const Redis = require("ioredis");
const HTTP = require("http");
const IO = require("socket.io");

// ----------------- Setup -------------------------

const redisSub = new Redis();
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

/** --------------------------------- SOCKET IO -------------------------------------------- **/
{
    io.on("connection", (currentSocket) => {
        console.log(`-- Browser Connected: ${currentSocket.id}`);

        //map socket id to user
        currentSocket.on("map-socket-user", async (data) => {
            redisCmd.set(data.userEmailHash, currentSocket.id);
            console.log(
                `-- Mapped User: ${data.userEmailHash} - ${currentSocket.id}`
            );
        });
        //map socket id to user
        currentSocket.on("unmap-socket-user", async (data) => {
            redisCmd.del(data.userEmailHash);
            console.log(
                `-- Unmapped User: ${data.userEmailHash} - ${currentSocket.id}`
            );
        });

        //before disconnect
        currentSocket.on("disconnecting", (/** reason **/) => {
            //
        });

        //on disconnect
        currentSocket.on("disconnect", (/** reason **/) => {
            console.log(`-- Browser Disconnected: ${currentSocket.id}`);
        });
    }); //IO
} //io

/** --------------------------------- REDIS -------------------------------------------- **/
{
    redisSub.subscribe(["FROM-LARAVEL-TO-NODE"], () => {
        console.log("-- Subscribed to Redis");
    });

    redisSub.on("message", async (redisChannel, redisMessage) => {
        let data = JSON.parse(redisMessage);

        console.log("-- Recieved Message From Redis:");
        console.dir(data);

        let socketId = await redisCmd.get(data.recipientHash);

        io.to(socketId).emit("FROM-NODE-TO-BROWSER", { ...data });
    }); //redisOnMessage
} //redis
