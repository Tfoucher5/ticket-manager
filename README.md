Le client se connecte à l'application, il peut voir ses tickets et les gérer et il peut créer un nouveau ticket.
Lorsque qu'un ticket est créé, les administrateurs sont notifiés par mail
Lorsque qu'un ticket est créé, le développeur en charge du ticket est notifié
La saisie d'un ticket implique de renseigner a minima un titre, un texte explicatif, une catégorie et un priorité. Le statut est alors positionné à "Ouvert". Une pièce jointe pourra être transmise si besoin.

L'administrateur se connecte à l'application et peut voir l'ensemble des tickets,# Gestion de Tickets - Application

## Description

L'application permet la gestion des tickets entre clients, administrateurs et développeurs. Les utilisateurs peuvent créer, affecter et résoudre des tickets, tout en échangeant des commentaires et pièces jointes. Voici les fonctionnalités clés de l'application.

## Fonctionnalités

### 1. **Fonctionnalités pour le Client**

- ✅ **Consultation des tickets** : Le client peut voir tous les tickets qu'il a créés.
- ✅ **Gestion des tickets** : Le client peut créer un nouveau ticket, spécifiant :
  - Un titre
  - Un texte explicatif
  - Une catégorie
  - Une priorité
- ✅ **Statut initial** : Lors de la création, le statut du ticket est automatiquement positionné à "Ouvert".
- ⌛ **Pièce jointe** : Optionnelle, le client peut ajouter une pièce jointe au ticket.
  
-  **Notification par mail** :
  - ✅ Lors de la création d'un ticket, **les administrateurs** sont notifiés par mail.
  - ✅ Le **développeur** en charge du ticket est également notifié par mail.

- **Interaction avec les développeurs** :
  - ✅ Le client peut échanger des commentaires avec les développeurs.
  - ✅ Lorsqu'un commentaire est ajouté par un développeur, le client est notifié par mail.
  
- **Changement de statut** :
  - ✅ Une fois le ticket résolu, le client peut **passer le ticket au statut "Terminé"**.
  - ✅ Le client peut également **annuler le ticket**, ce qui modifiera son statut à "Annulé".

### 2. **Fonctionnalités pour l'Administrateur**

- ✅ **Consultation des tickets** : L'administrateur peut voir l'ensemble des tickets, y compris leur état.
- ✅ **Affectation des tickets** : L'administrateur peut affecter un ticket à un développeur.
  
  **Notification par mail** :
  - ✅ Lorsqu'un ticket est affecté à un développeur, ce dernier reçoit une notification par mail.
  - ✅ Le statut du ticket passe automatiquement à "Affecté".

### 3. **Fonctionnalités pour le Développeur**

- ✅ **Consultation des tickets** : Le développeur peut voir l'ensemble des tickets qui lui sont affectés et qui ne sont pas encore résolus.
- ✅ **Ajout de commentaires** : Le développeur peut ajouter des commentaires sur un ticket. 
  - ⌛ Chaque commentaire peut être accompagné d'une **pièce jointe** (facultative).
  - ✅ Lorsqu'un commentaire est ajouté, le client est notifié par mail.

### 4. **Statuts des Tickets**

Voici les différents statuts qu'un ticket peut avoir dans le système :

- **Ouvert** : Le ticket est créé et est en attente de traitement.
- **Affecté** : Le ticket a été affecté à un développeur.
- **Terminé** : Le ticket a été résolu par le développeur et validé par le client.
- **Annulé** : Le ticket a été annulé par le client.

## Notifications par Mail

L'application envoie des notifications par mail aux utilisateurs dans les cas suivants :
- ✅ Lorsqu'un ticket est créé, **les administrateurs** est notifié.
- ✅ Lorsqu'un ticket est assigné par un **administrateur** à un **développeur**, le **développeur** en question est notifié.
- ✅ Lorsqu'un ticket est affecté à un développeur, ce dernier est notifié.
- ✅ Lorsqu'un commentaire est ajouté par le développeur, **le client** est notifié.

