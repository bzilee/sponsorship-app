<p align="center"><img height="100px" src="https://res.cloudinary.com/dp7asnerf/image/upload/v1577774394/SponsorshipAPP_n7qpts.png"></p>



<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# sponsorship-app
Sponsorship application for IAI Cameroom center of Douala. Promotion 2018. Academy year  2019/2020

## About Sponsorship APP

Sponsorship APP est une application de parrainage qui permet de lier un etudiant filleul à un autre etudiant appelé Parrain. Sponsorship APP est 


## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Equipe

Personnes physiques et Morales chargées de l'analyse, conception et réalisation

- **[Tankeu Bzile](https://web.facebook.com/tecbric.tankeu)**
- **[Chinzoumka Tchindebe](christiantchindebe@outlook.fr)**


## Installation et Configuration

* Copier l'url du dépot et taper la commande suivante pour le cloner dans votre serveur

    ```shell
    $ git clone https://gitlab.com/pakgneproject/api-pakgne api-pakgne
    ```

* Passer à la racine du répertoire de votre application clonée et installer les dépendances


    ```shell
    $ cd api-pakgne
    $ composer install
    ```

* Faire une copy du fichier  `.env.example` et le renommé comme ceci `.env`

    ```shell
    $ cp .env.example .env
    ```

* Générer une clé à l'application en utilisant `artisan`

    ```shell
    $ php artisan key:generate
    ```

* Configurer votre Base de Données et entrer les informations d'identification dans le fichier `.env` 

    ```
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```
## Installation des migrations

* Générer les tables dans la base de donnée aprèes avoir respecté les étapes précédentes. Pour cela utilisez `artisan` comme ceci


    ```shell
    $ php artisan migrate
    ```

## Demarrage du serveur de websocket (laravel-echo-server)

* Avant d'executer la commande suivante, rassurer vous d'avoir demarrer laragon et que redis a bien étè lancé.

    ```shell
    $ npm run websocket-server
    ```

## Demarrage du serveur de SMS (sous Gammu)

* Veuillez à brancher une clé internet contenant une puce(SIM) et utliser la commande suivante pour l'identifier

    ```shell
    $ npm run identify-sms-device
    ```

* Une fois le peripherique reconnu et identifié, lancer la commande suivante :

    ```shell
    $ npm run sms-monitor
    ```


## Url des resources

Selon la configuration de votre serveur, il est judicieux d'utliser un hote virtuel pour des raisons de commoditée. Ici, les chemins des url ont été simplifiés.

* Authentifications

- Login standard : **[http://chemin-serveur/api/pakgne/v1/register]** Méthode : ``POST``
    Variables : name, password, email
- Login avec socials login : **[http://chemin-serveur/api/pakgne/v1/register/snet]** Méthode : ``POST``
    Variables : provider, provider_id, provider_name, email

## Vulnérabilité

Bien vouloir **informer** en cas de doute sur la sécurité.

## License

L'API est essentiellement un projet propriétaire.
