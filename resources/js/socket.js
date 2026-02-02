import { io } from "socket.io-client";

// "Best place add it" -> A dedicated file makes it easy to import anywhere.
// Connect to the socket server (running on port 3000 by default)
const socket = io("http://localhost:3000", {
    transports: ["websocket"], // Force websocket to avoid polling issues
    autoConnect: true,
});

socket.on("connect", () => {
    console.log("Connected to Socket.io server with ID:", socket.id);
});

socket.on("disconnect", () => {
    console.log("Disconnected from Socket.io server");
});

export default socket;
