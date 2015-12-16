<?php

  session_start();

  $currentConseiller = 'createprogram';

  include_once("../controller/pages_access.php");



  include_once("../assets/constant.php");

  include_once(MODEL_PAGE);
  include_once(MODEL_PROGRAMME);



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
    </head>
    <body> 
    <div class="container">
            <?php
                showHeader();
                showAppropriateMenu();
            ?>
      <br>
      <fieldset>
          <legend>Ajout de programme : </legend>
          </br>
<form action="../controller/controller_create_program.php" method="post">


        <label>Liste des programmes déjà existants : </label>
        <br>
          <?php
            showListProgramsWithSelected();
          ?>
        &nbsp &nbsp
        <label>Rechercher :</label>
          <input type='text' name='search_program' 
            onKeyUp="arrayFilter(this.value, this.form.program_list_all)"
            onChange="arrayFilter(this.value, this.form.program_list_all)"
            value='<?php 
              if( isset($_SESSION['search_program']) )
              {
                echo $_SESSION['search_program'];
                unset($_SESSION['search_program']);
              } 
              ?>'
          />
        <br>
        <br>

        <label>Code du programme : </label>

        <div>
            <input class="text-box single-line" data-val="true" id="CodeProgramme" name="CodeProgramme" 
              type="text" 
              <?php
              /*
              onKeyUp="arrayFilter(this.value, this.form.program_list_all)"
              onChange="arrayFilter(this.value, this.form.program_list_all)" 
              */
              ?>
              required
              value="<?php 
              if( isset($_SESSION['CodeProgramme']) )
              {
                echo $_SESSION['CodeProgramme'];
                unset($_SESSION['CodeProgramme']);
              } 
              ?>" 
            />
        </div>
        </br>
        <label>Nom du programme : </label>
        <div>
            <input data-val="true" id="NomProgramme" name="NomProgramme" type="text" 
              required
              value="<?php 
              if( isset($_SESSION['NomProgramme']) )
              {
                echo $_SESSION['NomProgramme'];
                unset($_SESSION['NomProgramme']);
              } 
              ?>"
            />
        </div>
        </br>
        <label>Type du programme : </label>

        <div>
            <select name="TypeProgramme" class="required">

              <?php 
                if( isset($_SESSION["TypeProgramme"]) )
                {
                  switch ($_SESSION["TypeProgramme"]) 
                  {
                    case 'Technique':
                      $type_programme = 
                      "<option selected value='Technique'>Technique</option>" .
                      "<option value='Pré-universitaire'>Pré-universitaire</option>" .
                      "<option value=\"Attestation d'études collégiales\">Attestation d'études collégiales</option>";
                      break;
                    case 'Pré-universitaire':
                      $type_programme = 
                      "<option value='Technique'>Technique</option>" .
                      "<option selected value='Pré-universitaire'>Pré-universitaire</option>" .
                      "<option value=\"Attestation d'études collégiales\">Attestation d'études collégiales</option>";
                      break;
                      case "Attestation d'études collégiales":
                      $type_programme = 
                      "<option value='Technique'>Technique</option>" .
                      "<option value='Pré-universitaire'>Pré-universitaire</option>" .
                      "<option value=\"Attestation d'études collégiales\">Attestation d'études collégiales</option>";
                        break;
                    default :
                      $type_programme = 
                      "<option value='Technique'>Technique</option>" .
                      "<option value='Pré-universitaire'>Pré-universitaire</option>" .
                      "<option selected value=\"Attestation d'études collégiales\">Attestation d'études collégiales</option>";
                      break; 
                  }
                  unset($_SESSION["TypeProgramme"]);
                }
                else
                {
                  $type_programme = 
                  "<option value='Technique'>Technique</option>" .
                  "<option value='Pré-universitaire'>Pré-universitaire</option>" .
                  "<option value=\"Attestation d'études collégiales\">Attestation d'études collégiales</option>";
                }
                echo $type_programme;
                ?>
            </select>
        </div>
        </br>
        <label>Type de sanction: </label>
        <div>
            <select name="TypeSanction">
              <option value="Diplôme d'études collégiales"> Diplôme d'étude collégiales </option>
              <option value="Attestation d'études collégiales"> Attestation d'études collégiales </option>
            </select>
        </div>
        </br>
      
      <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
      </div>

     </form> 
   </fieldset>
    </div>

  </body>
</html>


    <?php 
        showSessionMessage("errors_add_program");
        showSessionMessage("success_add_program");
    ?>
