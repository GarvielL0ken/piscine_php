SELECT * FROM `distrib`
WHERE `id_distrib` = 42 
OR (61 < `id_distrib` AND `id_distrib` < 72)
OR (87 < `id_distrib` AND `id_distrib` < 91)
OR (LOWER(`name`) LIKE '%y%y%');
LIMIT 2, 5;