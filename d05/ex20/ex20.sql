SELECT  film.id_genre AS 'id_genre',
        genre.name AS 'name_genre',
        film.id_distrib AS 'id_distrib', 
        distrib.name AS 'name_distrib',
        film.title AS 'title_film'
FROM `film`
INNER JOIN `genre` ON film.id_genre = genre.id_genre
INNER JOIN `distrib` ON film.id_distrib = distrib.id_distrib
WHERE (4 <= film.id_genre AND film.id_genre <= 8);