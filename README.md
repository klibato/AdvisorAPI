# Advisor 
[![with-docker](https://user-images.githubusercontent.com/92017625/157022460-86b3500d-43e3-42a7-a8c5-b8b6ff77e017.svg)](https://docs.docker.com/get-docker/)[![sanctum](https://user-images.githubusercontent.com/92017625/157023772-5223cda5-31d8-42f3-9ab8-7419f953e282.svg)](https://laravel.com/docs/9.x/sanctum)


Pour le projet "Advisor" on a mis en place une api REST laravel sous un docker. 

## Prérequis

- [Docker engine](https://docs.docker.com/get-docker/)
- [WSL 2](https://docs.microsoft.com/en-us/windows/wsl/install-manual) 

## 1ère Partie : API

### Déploiement

Téléchargez le repot puis ouvrez votre terminale et appliquez la commande suivante dans le dossier:

`docker-compose up`

A la fin la sortie du code sera 0. A ce moment là il faudra "cut" le programme en faisant : 

![image](https://user-images.githubusercontent.com/92017625/157044822-6f29b4f9-822a-4d21-9344-addad0a67a66.png)

- crtl+x 
- crtl+c 

Aller dans le fichier `docker-compose.yml` situé à la racine du dossier puis s'assurer que la variable myapp est bien comme présenté ci-dessous : 

```dockerfile
  myapp:
    image: docker.io/bitnami/laravel:8
    #command: composer update
    ports:
      - '8000:8000'
    environment:
      - DB_HOST=db
      - DB_PORT=3306
      - DB_USERNAME=root
      - DB_DATABASE=advisor
      - DB_PASSWORD=my_secret_password
```

Dans la vairable `ports` le premier port `8000:8000` représente le port de votre ordinateur, le second est celui du docker. En commantant la ligne `command: composer update` le dossier `vendor/` de l'application se générera. Retournez dans votre terminal toujour dans votre dossier et appliquez de nouveau la commande suivante : 

`docker-compose up`

Votre terminale devrait ressemblez à l'image ci-dessous : 

![image](https://user-images.githubusercontent.com/92017625/157043632-e7e9e8b6-ef40-4f73-a57d-1c74bc6e91ac.png)

Félicitation votre application est désormais déployée. 
