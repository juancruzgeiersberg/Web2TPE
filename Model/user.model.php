<?php
require_once './config.php';


class UserModel {
    //Variable privada
    private $pdo;
    //Constructor con la conexión a la base de datos
    public function __construct() {
        $this->pdo = new PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8", USER, PASSWORD);
    }
    public function deploy() {
        $query = $this->pdo->query('SHOW TABLES');
         $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
         if(count($tables)==0) {
             // Si no hay crearlas
             $sql ='
             --
             -- Estructura de tabla para la tabla `user`
             --
 
             CREATE TABLE `user` (
             `user_id` int(11) NOT NULL,
             `user` varchar(255) NOT NULL,
             `password` varchar(255) NOT NULL,
             `rol_id` int(11) DEFAULT NULL,
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
             --
             -- Volcado de datos para la tabla `user`
             --
 
             INSERT INTO `user` (`user_id`, `user`, `password`, `rol_id`) VALUES
             (6, "Miki", "$2y$10$HHYoZ/FyRmaVAk9bUpQwu.lJkSN7d4LPYXsAnSO9SFNVxfyDDwp3K", NULL),
             (7, "mike", "$2y$10$aAFfSiv971VAU5Hnm2IQg.Y2oL3qgz1recQ4rDRTcWxMAAFgcOy7e", NULL),
             (366, "juan", "$2y$10$JQ5xvbbP2XH375xY9e.rl.5VUbC.XZidZVR2wyXoPoH5HnwEMua4O", 2),
             (367, "juanc", "$2y$10$tND9QWdaeOoRTlVYoiHgb.RLb4H.wGMkG9frWXghS57wphPLgX8yu", 2);
             (382, "webadmin", "$2y$10$WT7i1CFPAxzrjnt2HrNofusXBv5jjrTYjaU6WFxEBZ2krRlI4bGVW", 1);
             
             --
                 -- Indices de la tabla `user`
                 --
                 ALTER TABLE `user`
                 ADD PRIMARY KEY (`user_id`),
                 ADD KEY `rol_id` (`rol_id`);
 
                 --
                 -- AUTO_INCREMENT de la tabla `user`
                 --
                 ALTER TABLE `user`
                 MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;
                 
                 --
                 -- Filtros para la tabla `user`
                 --
                 ALTER TABLE `user`
                 ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`);
                 COMMIT;';
             $this->pdo->query($sql);
         }
         
     }
    //Verifica si existe el user en la base de datos.
    public function verifyUser($user) {
        $sentence = $this->pdo->prepare('SELECT * FROM user WHERE user = ?');
        $sentence->execute([$user]);
        return $sentence->fetch(PDO::FETCH_OBJ);
    }
    //Verifíca que el user no exista
    public function verifyInsert($user){
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE nombre = ?");
        $query->execute(array($user));
        return $query->fetchColumn();
    }
    //Guarda el nuevo user en la base de datos
    public function saveUser($arr){
        $query = $this->pdo->prepare("INSERT INTO `user` (`user`, `password`, `rol_id`) VALUES (?,?,?)");
        $query->execute($arr);
    }

}