<h1>💻 Application de Gestion du Parc Informatique</h1>
Application web développée avec Laravel pour la gestion des mouvements du matériel informatique au sein de la DSI de l’Office National de l’Eau et de l’Électricité (ONEE).

<h1>📌 Description</h1>
Cette application a pour objectif de gérer le parc informatique de manière efficace, en assurant le suivi :

des bons d’entrée en stock

des bons de sortie du matériel

du matériel en stock

Elle permet également une gestion sécurisée des utilisateurs selon leur rôle.

<h1>🛠️ Fonctionnalités</h1>
📥 Gestion des bons d’entrée en stock

📤 Gestion des bons de sortie du matériel

🧾 Suivi des matériels en stock (code, marque, modèle, accessoires…)

📊 Mise à jour automatique des stocks après chaque entrée/sortie

👥 Gestion des utilisateurs avec rôles (admin, responsable, lecteur)

🔎 Recherche et filtrage des matériels

📄 Exportation de données (PDF/Excel)

<h1>⚙️ Stack technique</h1>
Backend : Laravel 10+ (PHP 8+)

Base de données : MySQL/MariaDB

Frontend : Blade, Bootstrap 5, HTML/CSS, JS

Authentification : Laravel Breeze / Laravel UI

Outils : Git, GitHub, XAMPP, VS Code

<h1>📂 Structure de base de données</h1>
Les tables principales :

materiels : informations sur le matériel

bons_entree : enregistrements des entrées de matériel

bons_sortie : enregistrements des sorties

articles_bon : lien entre bon et articles

utilisateurs : gestion des rôles et accès

<h1>🔐 Gestion des utilisateurs</h1>
Administrateur : contrôle total (CRUD, gestion des utilisateurs)

Responsable : peut ajouter/modifier les mouvements

Lecteur : accès en lecture seule
![Screenshot 2025-05-04 163538](https://github.com/user-attachments/assets/3d53a0ea-18ce-4968-9e84-d7a9e759a6f5)

![Screenshot 2025-05-04 162705](https://github.com/user-attachments/assets/267b18a5-5964-4a4d-9a57-9bbfab664619)
