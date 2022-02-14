<?php

include_once "../DBO/dbo.php";
include_once "../Entities/film.php";

class filmsModel
{
    protected dbo $dbo;

    public function __construct()
    {
        $this->dbo = new dbo();
    }

    public function rentFilm($filmId, $userId)
    {
        $sql = "UPDATE film SET user_id = " . $userId . " WHERE user_id IS NULL AND film_id = " . $filmId;
        $this->dbo->default();
        $this->dbo->query($sql);
        if ($this->dbo->affected_rows > 0) {
            $this->dbo->close();
            return true;
        }
        $this->dbo->close();
        return false;
    }

    public function returnFilm($filmId, $userId)
    {
        $sql = "UPDATE film SET user_id = NULL WHERE user_id = " . $userId . " AND film_id = " . $filmId;
        $this->dbo->default();
        $this->dbo->query($sql);
        if ($this->dbo->affected_rows > 0) {
            $this->dbo->close();
            return true;
        }
        $this->dbo->close();
        return false;
    }

    public function getAvailableFilms()
    {
        $sql = "SELECT * FROM film f WHERE f.user_id IS NULL ORDER BY RAND(1913) LIMIT 20";
        $this->dbo->default();
        $query = $this->dbo->query($sql);
        $this->dbo->close();
        $films = array();
        while ($result = $query->fetch_assoc()) {
            $actors = $this->getFilmActors($result["film_id"]);
            $categories = $this->getFilmCategories($result["film_id"]);
            $language = $this->getLanguage($result["language_id"]);
            $user = $this->getUser($result["user_id"]);

            $films[] = new film($result["film_id"], $result["title"], $result["description"], $result["release_year"], $language, $result["length"], $result["rating"], datetime::createFromFormat("Y-m-d G:i:s", $result["last_update"]), $actors, $categories, $user);
        }
        return $films;
    }




    public function getUserFilms($userId)
    {
        $sql = "SELECT * FROM film f WHERE f.user_id =" . $userId;
        $this->dbo->default();
        $query = $this->dbo->query($sql);
        $this->dbo->close();
        $films = array();
        while ($result = $query->fetch_assoc()) {
            $actors = $this->getFilmActors($result["film_id"]);
            $categories = $this->getFilmCategories($result["film_id"]);
            $language = $this->getLanguage($result["language_id"]);
            $user = $this->getUser($result["user_id"]);

            $films[] = new film($result["film_id"], $result["title"], $result["description"], $result["release_year"], $language, $result["length"], $result["rating"], datetime::createFromFormat("Y-m-d G:i:s", $result["last_update"]), $actors, $categories, $user);
        }
        return $films;
    }


    public function getLanguage($languageId): language
    {
        $sql = "SELECT * FROM language WHERE language_id = " . $languageId;
        $this->dbo->default();
        $query = $this->dbo->query($sql);
        $this->dbo->close();
        $result = $query->fetch_assoc();
        return new language($result["language_id"], $result["name"], datetime::createFromFormat("Y-m-d G:i:s", $result["last_update"]));
    }

    public function getFilmActors($filmId): array
    {
        $sql = "SELECT * FROM actor a INNER JOIN film_actor fa ON a.actor_id = fa.actor_id WHERE fa.film_id =" . $filmId;
        $this->dbo->default();
        $query = $this->dbo->query($sql);
        $this->dbo->close();
        $actors = array();
        while ($result = $query->fetch_assoc()) {
            $actors[] = new actor($result["actor_id"], $result["first_name"], $result["last_name"], datetime::createFromFormat("Y-m-d G:i:s", $result["last_update"]));
        }
        return $actors;
    }

    public function getFilmCategories($filmId): array
    {
        $sql = "SELECT * FROM category c INNER JOIN film_category fc ON c.category_id = fc.category_id WHERE fc.film_id =" . $filmId;
        $this->dbo->default();
        $query = $this->dbo->query($sql);
        $this->dbo->close();
        $categories = array();
        while ($result = $query->fetch_assoc()) {
            $categories[] = new category($result["category_id"], $result["name"], datetime::createFromFormat("Y-m-d G:i:s", $result["last_update"]));
        }
        return $categories;
    }

    public function getUser($userId): user
    {
        if (is_null($userId)) {
            return new user(0, "-", "-");
        }
        $sql = "SELECT * FROM user WHERE user_id = " . $userId;
        $this->dbo->default();
        $query = $this->dbo->query($sql);
        $this->dbo->close();

        $result = $query->fetch_assoc();
        return new user($result["user_id"], $result["mail"], $result["password"]);
    }
}