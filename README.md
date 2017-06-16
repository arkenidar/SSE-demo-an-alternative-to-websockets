SHORT INTRO WITH TECH DETAILS
-----------------------------
#inter_page_transfer This project is demoing ServerSentEvents for a system that features sending a string of text 
(you can build your own protocol with it e.g. a JSON-bases protocol)
across pages (identified by proper IDs in URLs).

RATIONALE AND COMPARISONS
-------------------------
ServerSentEvents (SSE) messaging system (chat between 2 clients). Simpler solution than WebSockets in terms of working requirements (you can host on a cheap shared PHP/MySQL host even without SSH access). Other solutions are web-sockets (specific support in server-side needed), or services like FireBase or Pusher. Host by yourself a messaging system cheaply and easily! (note that SSE is not strictly needed for a chat but should have better network performances if this is what you need).

ABOUT THIS SOFTWARE LICENSING
-----------------------------
You can pay me for adaptations, improvements and related consulting.
Remember to respect the liberal MIT licence! (e.g. give due credit).
Commercial use allowed if licence is properly applied!
I'm the original author so I can make exceptions to licencing terms for you, as you may need. (e.g. to use this for your purposes without mentioning me i.e. using a different licence).

MORE ABOUT ServerSentEvents:
----------------------------
* https://www.w3schools.com/html/html5_serversentevents.asp
* https://www.html5rocks.com/en/tutorials/eventsource/basics/
* https://github.com/arkenidar/polyfills/blob/master/EventSource.js
