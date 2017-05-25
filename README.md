#inter_page_transfer This project is demoing ServerSentEvents for a system that features sending a string of text 
(you can build your own protocol with it e.g. a JSON-bases protocol)
across pages (identified by proper IDs in URLs).

ServerSentEvents (SSE) messaging system (chat between 2 clients). Simpler solution than WebSockets in terms of working requirements (you can host on a cheap shared PHP/MySQL host even without SSH access). Other solutions are web-sockets (specific support in server-side needed), or services like FireBase or Pusher. Host by yourself a messaging system cheaply and easily! (note that SSE is not strictly needed for a chat but should have better network performances if this is what you need).

You can pay me for adaptations, improvements and related consulting.
Remember to respect the liberal MIT licence! (e.g. give due credit).
Commercial use allowed if licence is properly applied!
