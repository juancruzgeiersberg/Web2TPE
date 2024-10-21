<?php

class ProyectsView{
    public function home(){
        require_once './templates/header.phtml';
        require_once './templates/home.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista del inicio de la pagina "home"
    public function redirectHome($error=""){
        require_once './templates/header.phtml';
        require_once './templates/login.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista de vinculacion de un usuario a un proyecto
    public function addUserView($error=""){
        require_once './templates/header.phtml';
        require_once './templates/link_user.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista para crear un nuevo proyecto
    public function new_serie($error=""){
        require_once './templates/header.phtml';
        require_once './templates/new_serie.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista de todas las temporadas de una serie
    public function getAllSeasonsView($result){
        require_once './templates/header.phtml';
        require_once './templates/allseasons.phtml';
        if(!empty($result)){
            foreach ($result as $obj): ?>
                <tr>
                    <td><?php echo $obj->season_number; ?></td>
                    <td><?php echo $obj->title; ?></td>
                    <td><?php echo $obj->episode_count; ?></td>
                    <td><form method='POST' action='episodes'>
                            <input type='hidden' name='table' value='seasons'>
                            <input type='hidden' name='serie_id' value='<?php echo $obj->id ?>'>
                            <input type='submit' class='btn btn-outline-danger' value='Ver'>
                        </form></td>
                <?php 
                    if(!empty($_SESSION['rol_id'])){ 
                        if($_SESSION['rol_id'] == 1){
                ?>
                        <td><form method='POST' action='edit_season'>
                                <input type='hidden' name='serie_id' value='<?php echo $obj->id ?>'>
                                <input type='submit' class='btn btn-outline-success' value='Editar'>
                            </form></td>
                        <td><form method='POST' action='delete_season'>
                                <input type='hidden' name='serie_id' value='"<?php echo $obj->id ?>"'>
                                <input type='submit' class='btn btn-outline-danger' value='Eliminar'>
                            </form></td>
                <?php   
                        }
                    } 
                ?>
                </tr>
            <?php endforeach;}else{
                echo "<p class='container alert alert-danger'><strong>Todavía no hay Series.</strong></p>";
            }
             ?>
            </table>
        <?php require_once './templates/footer.phtml';
    }
    //Vista de todos los proyectos que existen
    public function getAllProyectsView($result){
        require_once './templates/header.phtml';
        require_once './templates/allseries.phtml';

        if(!empty($result)){
        foreach ($result as $obj): ?>
            <tr>
                <td><?php echo $obj->title; ?></td>
                <td><?php echo $obj->description; ?></td>
                <td><form method='POST' action='seasons'>
                        <input type='hidden' name='table' value='seasons'>
                        <input type='hidden' name='serie_id' value='<?php echo $obj->id ?>'>
                        <input type='submit' class='btn btn-outline-danger' value='Ver'>
                    </form></td>
            <?php 
                if(!empty($_SESSION['rol_id'])){ 
                    if($_SESSION['rol_id'] == 1){
            ?>
                    <td><form method='POST' action='edit_serie'>
                            <input type='hidden' name='serie_id' value='<?php echo $obj->id ?>'>
                            <input type='submit' class='btn btn-outline-success' value='Editar'>
                        </form></td>
                    <td><form method='POST' action='delete_serie'>
                            <input type='hidden' name='serie_id' value='"<?php echo $obj->id ?>"'>
                            <input type='submit' class='btn btn-outline-danger' value='Eliminar'>
                        </form></td>
            <?php   
                    }
                } 
            ?>
            </tr>
        <?php endforeach;}else{
            echo "<p class='container alert alert-danger'><strong>Todavía no hay Series.</strong></p>";
        }
         ?>
        </table>
        <?php require_once './templates/footer.phtml';
    }
}
