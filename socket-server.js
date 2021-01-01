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
        console.log(`-- Connected: ${currentSocket.id}`);

        //map socket id to user
        currentSocket.on("map-socket-user", async (data) => {
            redisCmd.set(data.userEmailHash, currentSocket.id);
            console.log(`-- Mapped: ${data.userEmailHash} - ${currentSocket.id}`);
        });

        //before disconnect
        currentSocket.on("disconnecting", (reason) => {
            //
        });

        //on disconnect
        currentSocket.on("disconnect", (reason) => {
            console.log(`-- Disconnected: ${currentSocket.id}`);
        });
    }); //IO
} //ioBlock

/** --------------------------------- REDIS -------------------------------------------- **/
{
    redisSub.subscribe(["FROM-LARAVEL-TO-NODE"], () => {
        console.log('-- Subscribed to Redis');
    });

    redisSub.on("message", async (redisChannel, redisMessage) => {
        
        let data = JSON.parse(redisMessage);

        switch (data.action) {
            case "new-message":
                {
                    let socketId = await redisCmd.get(data.recipientHash);
                    io.to(socketId).emit("FROM-NODE-TO-BROWSER", {
                        action: "new-message"
                    });
                }
                break;
            default:
                break;
        } //sw
    }); //redisOnMessage
} //redisblock
