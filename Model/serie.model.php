<?php
require_once './config.php';

class ProyectModel{

    private $pdo;
    private $deploy;

    //Constructor con la conexión a la base de datos
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8", USER, PASSWORD);
        $this->deploy();
    }
    //Crea las tablas si no existen
    public function deploy() {
        $query = $this->pdo->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables)==0) {
            $sql =<<<END
                -- phpMyAdmin SQL Dump
                -- version 5.2.1
                -- https://www.phpmyadmin.net/
                --
                -- Servidor: 127.0.0.1
                -- Tiempo de generación: 21-10-2024 a las 00:43:44
                -- Versión del servidor: 10.4.32-MariaDB
                -- Versión de PHP: 8.2.12

                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

                --
                -- Base de datos: `serie_manager`
                --

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `episodes`
                --

                CREATE TABLE `episodes` (
                `id` int(11) NOT NULL,
                `id_season` int(11) DEFAULT NULL,
                `id_series` int(11) DEFAULT NULL,
                `title` varchar(255) NOT NULL,
                `episode_number` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `episodes`
                --

                INSERT INTO `episodes` (`id`, `id_season`, `id_series`, `title`, `episode_number`) VALUES
                (1, 1, 1, 'qweasd', 1),
                (2, 1, 1, 'asdzxc', 2),
                (3, 1, 1, 'qwe', 3),
                (4, 1, 1, 'zxc', 4),
                (5, 1, 1, 'qweasdzxc', 5);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `seasons`
                --

                CREATE TABLE `seasons` (
                `id` int(11) NOT NULL,
                `id_series` int(11) DEFAULT NULL,
                `title` varchar(255) NOT NULL,
                `season_number` int(11) NOT NULL,
                `episode_count` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `seasons`
                --

                INSERT INTO `seasons` (`id`, `id_series`, `title`, `season_number`, `episode_count`) VALUES
                (1, 1, 'asd', 1, 5),
                (3, 2, 'zxc', 1, 3),
                (4, 3, 'asd', 1, 4),
                (8, 1, 'Temp2', 2, 3);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `series`
                --

                CREATE TABLE `series` (
                `id` int(11) NOT NULL,
                `title` varchar(255) NOT NULL,
                `description` text NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `series`
                --

                INSERT INTO `series` (`id`, `title`, `description`) VALUES
                (1, 'Prision Break', 'Ta buena'),
                (2, 'Lucifer', 'Ta buena'),
                (3, 'Travelers', 'Ta buena'),
                (4, 'Breaking Bad', 'Ta buena'),
                (5, 'Black List', 'Ta Piola'),
                (6, 'Swits', 'Ea');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `user`
                --

                CREATE TABLE `user` (
                `user_id` int(255) NOT NULL,
                `user` varchar(12) NOT NULL,
                `password` varchar(255) NOT NULL,
                `rol_id` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `user`
                --

                INSERT INTO `user` (`user_id`, `user`, `password`, `rol_id`) VALUES
                (1, 'admin', '$2y$10$9QAjmfB64s/8JQkj7kN95ugpwf55Z8d4ErwZcSyvpE8ialFzCGySa', 1);

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `episodes`
                --
                ALTER TABLE `episodes`
                ADD PRIMARY KEY (`id`),
                ADD KEY `id_season` (`id_season`),
                ADD KEY `id_series` (`id_series`);

                --
                -- Indices de la tabla `seasons`
                --
                ALTER TABLE `seasons`
                ADD PRIMARY KEY (`id`),
                ADD KEY `id_series` (`id_series`);

                --
                -- Indices de la tabla `series`
                --
                ALTER TABLE `series`
                ADD PRIMARY KEY (`id`);

                --
                -- Indices de la tabla `user`
                --
                ALTER TABLE `user`
                ADD PRIMARY KEY (`user_id`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `episodes`
                --
                ALTER TABLE `episodes`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

                --
                -- AUTO_INCREMENT de la tabla `seasons`
                --
                ALTER TABLE `seasons`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

                --
                -- AUTO_INCREMENT de la tabla `series`
                --
                ALTER TABLE `series`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

                --
                -- AUTO_INCREMENT de la tabla `user`
                --
                ALTER TABLE `user`
                MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `episodes`
                --
                ALTER TABLE `episodes`
                ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`id_season`) REFERENCES `seasons` (`id`) ON DELETE CASCADE,
                ADD CONSTRAINT `episodes_ibfk_2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE;

                --
                -- Filtros para la tabla `seasons`
                --
                ALTER TABLE `seasons`
                ADD CONSTRAINT `seasons_ibfk_1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE;
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

            END;
            $this->pdo->query($sql);
        }
        
    }
    //Elimina un proyecto por id
    public function delete($id_proyect){
        $this->sqlExecute("DELETE FROM `proyecto` WHERE id_proyecto = ?", $id_proyect);
    }
    //Retorna el proyecto que el usuario quiere editar.
    public function editByID($id){
        $sqlexecute = $this->pdo->prepare("SELECT * FROM proyecto WHERE id_proyecto = ?");
        $sqlexecute->execute($id);
        return $sqlexecute->fetch(PDO::FETCH_OBJ);
    }
    //Guarda el proyecto editado por el usuario
    public function saveEdit($editProyect){
        $this->sqlExecute("UPDATE `proyecto` SET `nombre_proyecto`=?,`descripcion`=? WHERE id_proyecto = ?",$editProyect);
    }
    //Agrega un nuevo proyecto
    public function addProyect($query){
        $this->sqlExecute("INSERT INTO `series`(`title`, `description`) VALUES (?,?)",$query);
    }
    //Hace las ejecuciones sql
    public function sqlExecute($query, $sql){
        $sqlexecute = $this->pdo->prepare($query);
        $sqlexecute->execute($sql);
    }
    //Devuelve todos los proyectos que tiene la base de datos... ESTÁ MAL OPTIMIZADO, SE PODRÍA HACER CON UNA SOLA CONSULTA EN VES DE 3 DIFERENTES.
    public function getProyects($table="",$aux=""){
        if(!empty($aux)){
            if($table == 'seasons'){
                $query = $this->pdo->prepare("SELECT * FROM $table WHERE id_series = ?");
                $query->execute([$aux]);
                return $query->fetchAll(PDO::FETCH_OBJ);
            }else{
                $query = $this->pdo->prepare("SELECT * FROM $table WHERE id_season = ?");
                $query->execute([$aux]);
                return $query->fetchAll(PDO::FETCH_OBJ);
            }
        }else{
            $query = $this->pdo->prepare("SELECT * FROM series");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        
    }
    //Devuelve todas las series que tiene la base de datos
    public function getAllProyects(){
        $query = $this->pdo->prepare("SELECT * FROM series");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //Devulve todas las temporadas que tiene la base de datos
    public function getAllSeries($aux){
        $query = $this->pdo->prepare("SELECT * FROM seasons WHERE id_serie = ?");
        $query->execute([$aux]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //Devuelve 1 si existe el proyecto o 0 si no existe
    public function verifyProyectExistence($id_proyect){
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM series WHERE id_serie = ?");
        $query->execute([$id_proyect]);
        return $query->fetchColumn();
    }
}

?>