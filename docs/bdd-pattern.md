# Méthodo
- entités : ***User***, ***Community***, ***Event***


- relation 1:n
  - Event 1 ----- n Community  
  "Un **Event** est organisé dans une et une seule **Community**. Une **Community** peut comprendre plusieurs **Event**."
  - Event 1 ----- n User  
  "Un **Event** est créé par un et un seul **User**. Un **User** peut organiser plusieurs **Event**."


- relation n:m
  - User n ----- m Community  
  "Un **User** peut rejoindre plusieurs **Community**. Une **Community** peut comporter plusieurs **User**."
  - User n ----- m Event  
  "Un **User** peut souscrire à plusieurs **Event**. Un **Event** peut être rejoint par plusieurs **User**."

# Schéma des tables
##### community
- id => INT, A_I, **PK**
- name => VARCHAR
- description => TEXT
- image => VARCHAR


##### event
- id => INT, A_I, **PK**
- titre => VARCHAR
- nbr_place => INT
- description => TEXT
- price => DECIMAL(10, 2)
- date => DATE
- city => VARCHAR
- postal_code => INT
- address => VARCHAR
- organizer_id => INT, **FK**
- community_id => INT, **FK**


##### user
- id => INT, A_I, **PK**
- username => VARCHAR
- first_name => VARCHAR
- last_name => VARCHAR
- email => VARCHAR
- photo => VARCHAR
- address => VARCHAR
- city => VARCHAR
- postal_code => INT
- personal_desc => TEXT
- event_notification => BOOL
- admin => BOOL


##### user_community
- user_id => INT, **FK**
- community_id => INT, **FK**


##### user_event
- user_id => INT, **FK**
- event_id => INT, **FK**
