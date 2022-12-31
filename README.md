# EventManagement
event management software
------------------------------------------------
Create event or record data through connected data nodes.
Generate scalable number of subfields k per main field M representing events and connected sub-events. Each field k has a start and end time stamp of duration d-no. of days. for each day d, there are n variable fields. d can be segmented into individual time slots of duration t. t time slots for every d day. Both t and n are child nodes of d. For every t there are j variable fields linked to field n. For each j there are l fields which were built to act as categories for recording participant (j) data. l is used to create a form for each n for each j for each t on each d for every k.
Generates auto-matic emails if fields n are email addresses and fields j are emails
creates web page to display current events and timing
form for recording data converting to delimitted text file


*********************
Implementation
*********************
WAMP or XAMP stack frame work required.
Download all scripts
Create a root folder, place in www folder for WAMP or htdocs folder for XAMP
Optionally update the httpd-vhosts text file to the root folder you created so that the extension in the broser is localhost/*.php
.sql file provided for database dump
