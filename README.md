
### Name

Jonathan Geffrard

### How Long Did It Take Me to Complete This
Two days, but the first day was more so for getting a high-level overview of how the backend architecture would be created.
The second day dealt mainly with the implementation (i.e. setting up the Laravel project, defining the endpoints, registering the endpoints, debugging, etc.)

### List of General Steps
(a) Spent the first day getting a clear understanding of what the table schema for the database would be as this will drive the API service -- 2 hours appx.

(b) Wrote SQL script to create the database and tables and populate the database with mock data. I would have used the migrations to define the table schema, but I had already defined and populated the tables with the SQL script so I did include the migrations to show that I did create and would have used the migrations -- 1 hour appx.

(c) Created a new Laravel project and defined models that correspond to each database table (a users table and messages table) -- 20 min appx.

(d) Set up the routes and implemented the methods corresponding to each route along with error handling -- 1 hour appx

(e) Testing and debugging endpoints in Postman -- 2 hours appx.

Part of the time spent working on this was bridging the knowledge gap as far as learning Laravel because I'd never used Laravel before. I'd used PHP before, but this was a great way to refresh on my PHP and learn a new framework at the same time. 

### Changes I would make regarding security (I’m sure there’s more, just a few I could think off at the top of my head):
(a) Add basic HTTP authentication to service endpoints;
(b) Add some kind of token-based authentication during user login;
(c) Host database on a separate database server and fetch database credentials instead of hardcoding them;
(d) Hash the passwords instead of storing passwords in plaintext in database;