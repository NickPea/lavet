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
io.on("connection", (socket) => {
    console.log(`-- SOCKET:CONNECT -- \nsocket.id: ${socket.id}`);

    // ----------------- Events -------------------------

    socket.on("map-socket-user", async (data) => {
        redisCmd.set(data.userEmailHash, socket.id);
        console.log(
            `-- REDIS:MAP-SOCKET-USER -- \nredis-user-socket-mapping: {${
                data.userEmailHash
            }:${await redisCmd.get(data.userEmailHash)}}`
        );
    });

    socket.on("disconnect", (reason) => {
        console.log(
            `-- SOCKET:DISCONNECT -- ${reason} \nsocket.id:${socket.id} \nsocket.userHash:${socket.userEmailHash}`
        );
        //todo:remove redis user-socket-mapping
    });

    redisSub.subscribe(["socket-out-user", "socket-out-all"], (err, count) => {
        err
            ? console.log(`-- REDIS:SUBCRIBED -- \nerror:${err}`)
            : console.log(`-- REDIS:SUBCRIBED -- \ncount:${count}`);
    });

    //check redis is subscribed
    redisPub.publish("socket-out-user", "handshake", (err, res) => {
        err
            ? console.log(`-- REDIS:PUBLISH -- \nerror:${err}`)
            : console.log(
                  `-- REDIS:PUBLISH -- \nchannel:socket-out-user, sent:${
                      res ? true : false
                  }`
              );
    });
    redisPub.publish("socket-out-all", "handshake", (err, res) => {
        err
            ? console.log(`-- REDIS:PUBLISH -- \nerror:${err}`)
            : console.log(
                  `-- REDIS:PUBLISH -- \nchannel:socket-out-all, sent:${
                      res ? true : false
                  }`
              );
    });

    redisSub.on("message", async (channel, message) => {
        console.log(
            `-- REDIS:ON-MESSAGE -- \nchannel: ${channel}, message:${message}`
        );

        switch (channel) {
            case "socket-out-user":
                console.log(
                    `-- REDIS:ON-MESSAGE -- \nchannel: ${channel}, message:${message}`
                );
                //get userEmailHash from  message
                //get socket-id from redis using userEmailHash
                //socket.emit message data to user using socket-id
                break;
            default:
                break;
        }
    });

    // socket.disconnect();
}); //ioOnConnection
