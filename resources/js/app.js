// J-Query/Popper/Bootstrap
try {
    window.Popper = require("popper.js").default;
    // window.$ = window.jQuery = require('jquery');
    require("bootstrap");
} catch (error) {
    console.error(error);
}

// Axios
window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Lodash
window._ = require("lodash");

// Socket.io-client
window.io = require("socket.io-client");
