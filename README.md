## Test technique Display Interactive

Le sujet peu etre trouvé dans le dossier `file`

## Installation

Pour installer le projet

```shell
    docker compose up
```

Ils compilera les fichiers `frontend` et `backend` afin de lancer le projet.

## Utilisation

Lorsque les containers sont `up` l'application frontend sera disponible sur `http://localhost`
Le router est configuré pour gérer les requêtres sur le `/` et le `/customers`

## Fonctionnalités que l'on aurait pu ajouter pour passer en prod

- Ajouter un système de login pour eviter que n'importe puisse accéder au informations des customers
- Ajouter une pagination sur le front et le back
