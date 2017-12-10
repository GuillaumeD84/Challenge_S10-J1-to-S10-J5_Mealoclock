# Routes

|Titre|Description|Méthode|URL|Controller + Méthode|Commentaire|
|-|-|-|-|-|-|
|Home|liste des communautés, 5 prochains évènements|`GET`|`/`|`MainController`|-|
|Community|Page d’une communauté|`GET`|`/communities/[a:slug]`|`CommunityController`|slug : version "url-compatible" du nom de communauté|
|Events|Liste des events|`GET`|``|`EventController->list`|-|
|Search events|Rechercher par date/lieu/communauté|`GET`|``|`EventController->search`|-|
|Event|Page d’un évènement|`GET`|``|`EventController->show`|-|
|Event signup|S’inscrire/se désinscrire à l’évènement (réservé aux membres)|`POST`|``|`EventController->signup`|-|
|Event message|Envoyer un message à l’organisateur (réservé aux membres)|`POST`|``|`EventController->messageOrga`|-|
|-|pages statiques (FAQ, CGU etc)|``|`/faq , /cgu, ...`|`MainController`|-|
|||||||
|Admin communities|Admin - Liste des communautés|`GET`|`/admin/communities`|`CommunityController`|-|
|-|créer une nouvelle communauté|`GET &#124; POST`|`/admin/communities/create`|`CommunityController`|-|
|-|modifier les données d'une communauté|`GET &#124; POST`|`/admin/communities/[i:id]/update`|`CommunityController`|-|
|-|pouvoir supprimer une communauté|`POST`|`/admin/communities/[i:id]/delete`|`CommunityController`|-|
|Admin events|Liste des évènements (infos, inscrits)|``|`/admin/events`|`EventController`|-|
|-|Supprimer évènement|``|``|`EventController`|-|
|-|modifier evenement|``|``|`EventController`|-|
|Admin members|Liste des membres (rôle, status)|``|`/admin/members`|`MemberController`|-|
|-|désactiver un membre|``|`/admin/members/update/status`|`MemberController`|-|
|-|supprimer un membre|``|`/admin/members/[i:id]/delete`|`MemberController`|-|
|-|modifier le rôle d'un membre|``|`/admin/members/update/role`|`MemberController`|-|
|Admin subscriptions|Liste des souscriptions|``|``|`?`|-|
|||||||
|signup|S’inscrire|`GET &#124; POST`|`/signup`|`UserController`|-|
|login|Connexion|`GET &#124; POST`|`/login`|`UserController`|-|
|logout|Déconnexion|`POST`|`/logout`|`UserController`|-|
|forgot password|mot de passe oublié|`GET &#124; POST`|`/forgot_password`|`UserController`|-|
|new password|modifier mon mot de passe|`GET &#124; POST`|`/update_password`|`UserController`|-|
|||||||
|profile|Espace Membre - profil et évènements du membre|`GET`|`/profile`|`UserController`|-|
|-|Modifier mon profil|``|`/profile/update`|`UserController`|-|
|-|Organiser un évènement|``|`/profile/event/create`|`UserController`|-|
|||||||
|update event|Modifier un évènement|`GET &#124; POST`|`/[admin&#124;profile:domain]/event/[i:id]/update`|`EventController->update`|accessible par admin ET member|
