# Entités principales
* User
* Community
* Event

# Schéma Entité/Association
https://docs.google.com/drawings/d/1mfcus5blDY4GBD2M1vWwR2lc4ZHkyM2wxOhYgMwTRwc/edit?usp=sharing

# Dictionnaire de données
|nom|description|type|commentaires|entité|
|-|-|-|-|-|
|name|nom de la communauté|VARCHAR||Community|
|image|image de la communauté|VARCHAR||Community|
|description|description de la communauté|TEXT||Community|
||||||
|titre|Titre de l'événement|VARCHAR||Event|
|nbr_place|Nombre de places disponible|INT||Event|
|description|Description de l'événement|TEXT||Event|
|price|Participation financière|FLOAT||Event|
|date|Date|DATETIME||Event|
|city|Ville|VARCHAR||Event|
|postal_code|Code postal|INT||Event|
|address|Addresse|VARCHAR|Peut être une adresse de type skype ou hangouts dans le cas ou il s'agirait d'un évènement en téléprésentiel|Event|
|organizer|Organisateur|INT|id du membre qui organise l'event|Event & User|
||||||
|username|Pseudo du membre|VARCHAR||User|
|first_name|Prénom du membre|VARCHAR||User|
|last_name|Nom du membre|VARCHAR||User|
|email|Email du membre|VARCHAR||User|
|subscribed_event|Liste des events auxquels l'utilisateur s'est souscrit|COMPOSE||User & Event|
|joined_community|Liste des communités auxquels l'utilisateur est membre|COMPOSE||User & Community|
|photo|Photo de|VARCHAR||User|
|address|Addresse de l'utilisateur|VARCHAR||User|
|city|Ville où habite l'utilisateur|VARCHAR||User|
|postal_code|Code postal de la ville où habite l'utilisateur|INT||User|
|personal_desc|Description personnelle|TEXT||User|
|event_notification|Réception d'une notification lorsqu'un nouvel event est proposé dans sa communauté|BOOL||User & Event|
|admin|Est-ce que l'utilisateur est un admin du site|BOOL|Défini si l'utilisateur possède les droits 'admin'|User|
