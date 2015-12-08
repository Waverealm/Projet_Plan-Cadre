<?php


  session_start();

  $currentConseiller = 'createclass';

  include_once("../controller/interface_functions.php");
  include_once("../controller/pages_access.php");

  verifyAccessPages();
  isPlanner();
  isAdmin();
?>
<!DOCTYPE html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      
    <link rel="Stylesheet" href="../assets/pure.css">
    <link rel="Stylesheet" href="../assets/styles.css">
    <link rel="Stylesheet" href="../assets/others.css">
    <script type="text/javascript" src="../assets/js_global.js" ></script>
    <script src="jquery.js" type="text/javascript"></script>
    <script src="jquery.maskedinput.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>
  
  <body>
    <div class="container">
      <?php
        showHeader();
        showAppropriateMenu();
      ?>
      <br>
      <fieldset>
        <legend>Ajout de cours : </legend>
          <br>
        <form action="../controller/controller_create_class.php" method="post">
            <label>Cours qui existe déja : </label>
            <br>
            <?php
            showClassListAll();
            ?>
            <br>
            <br>
          <label>Code du cours : </label>
          <div>
            <input data-val="true" id="CodeCours" name="CodeCours" type="text" value=""
              onkeypress="return filterClassCode(event);"
              onKeyUp="arrayFilter(this.value, this.form.class_list_all)"
              onChange="arrayFilter(this.value, this.form.class_list_all)"
              required
            />
         </div>
          <br>
          <label>Nom du cours : </label>
          <div>
            <input data-val="true" id="NomCours" name="NomCours" type="text" value="" 
            />
          </div>
          <br>
          <label>Type du cours : </label>
          <div>
            <select name='TypeCours' required>
              <option value='Enseignement régulier'> Enseignement régulier </option>
              <option value='Formation continue'> Formation continue </option>
            </select>
          </div>
          <br>
          <label>Ponderation du cours : </label>
          <div>
            <input data-val="true" id="Ponderation" name="Ponderation" type="text" value="" />
          </div>
          <br>
          <label>Nombre d'unites : </label>
          <div>
            <input data-val="true" id="NombreUnites" name="NombreUnites" type="text" value="" />
          </div>
          <br>
          <label>Nombre d'heures : </label>
          <div >
            <input data-val="true" id="NombreHeures" name="NombreHeures" type="text" value="" />
          </div>
          <br>
          <label>Programme du cours : </label><br>
            <?php 
              showListPrograms(); 
            ?>
          <br>      
          <label><strong>Recherche d'un programme : </strong></label><br>
          <input type='text' name='search_program' value=''
            onKeyUp="arrayFilter(this.value, this.form.CodeProgram)"
            onChange="arrayFilter(this.value, this.form.CodeProgram)"
          /><br>
          <br>
    


          <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
          </div>
        </form> 
      </fieldset>
    </div>
  </body>
</html>
