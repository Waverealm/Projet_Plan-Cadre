<?php


  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
  include_once("../assets/constants.php");

  //include_once(INTERFACE_FUNCTIONS);
    
  include_once(MODEL_PAGE_ACCESS);
  include_once(MODEL_PAGE);
  include_once(MODEL_COURS);
  include_once(MODEL_PROGRAMME);

  // Variable utilisée pour le menu interractif
  $currentConseiller = 'createclass';

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
    <script src="jquery.maskedinput.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
      // NOUS N'AVONS MALHEUREUSEMENT PAS ÉTÉ EN MESURE DE FAIRE FONCTIONNER LE CODE
      // JQUERY EN LE MONTANT DANS UN FICHIER À PART ET EN L'INCLUANT ICI

      function validate() {
        // pour une validation plus custom
        //http://www.w3.org/TR/WCAG20-TECHS/SCR18.html
        // initialize error message
        var msg = "";
        
        //validate name
        var pattern = /^[a-zA-Z\s]+$/;
        var el = document.getElementById("name");
        if (!pattern.test(el.value))  msg += "Name can only have letters and spaces. ";
        
        // validate number
        var pattern = /^[\d\-+\.\s]+$/;
        var el = document.getElementById("tel");
        if (!pattern.test(el.value))  msg += "Telephone number can only have digits and separators. ";
        
        if (msg != "") {
          alert(msg);
          return false;
        } else return true;
      }

      $(function () {
        $('#manage_class input[type=radio]').change(function(){
          if ($(this).val() == "add_class" ) {
            // Si on veut ajouter un cours, alors l'action du form sera changé pour appeler le bon controller
            $('#form_manage_class').attr('action', '../controller/controller_create_class.php');
            
            // Cache le checkbox et le label
            $("#change_code").hide();
            $("#label_code_class").hide();
            $('#label_code_class').next('br').remove();

            // Affiche le tooltip
            $(".masterTooltip").show();

            // Active de nouveau le champ de texte du code du cours
            $( "#CodeCours" ).prop( "disabled", false );

            // Change le texte du label précédant la liste déroulante des cours
            $("#label_class_list").text("Liste des cours déjà existants :");
          }

          else if($(this).val() == "update_class") {
            // Même chose que dans le if ci-dessus
            $('#form_manage_class').attr('action', '../controller/controller_update_class.php');

            // Affiche et décoche le checkbox
            $("#change_code").show();
            $('#change_code').attr('checked', false);

            // Cache le tooltip
            $(".masterTooltip").hide();

            // Affiche le label
            $("#label_code_class").show();
            $( "<br>" ).insertAfter( "#label_code_class" );

            // Désactive le champ du texte du code du cours
            $( "#CodeCours" ).prop( "disabled", true );

            // Change le texte du label précédant la liste déroulante des cours
            $("#label_class_list").text("Sélectionnez le cours que vous souhaitez modifier :");
          }
        })
      })


      $( window ).load(function() {
        // Lorsque la page est chargée, le checkbox et le label sont cachés par défaut
        // et le champ de texte du code du cours est activé
        $("#change_code").hide();
        $("#label_code_class").hide();
        $( "#CodeCours" ).prop( "disabled", false );
      });

    </script>
    <script>
      // Ressource : http://www.alessioatzeni.com/blog/simple-tooltip-with-jquery-only-text/
      $(document).ready(function() {
        // Tooltip only Text
        $('.masterTooltip').hover(function(){
                // Hover over code
                var title = $(this).attr('title');
                $(this).data('tipText', title).removeAttr('title');
                $('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function() {
                // Hover out code
                $(this).attr('title', $(this).data('tipText'));
                $('.tooltip').remove();
        }).mousemove(function(e) {
                var mousex = e.pageX + 20; //Get X coordinates
                var mousey = e.pageY + 10; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
        });
      });
    </script>
  </head>
  <body>
    <div class="container">
      <?php
        showHeader();
        showAppropriateMenu();
      ?>
      <br>
      <fieldset id="manage_class">
        <legend>Ajouter/Modifier un cours : </legend>
          <br>

        <input type="radio" name ="action_choice" value="add_class" checked="checked">
        <label>Ajouter un cours</label> 
        &nbsp &nbsp
        <input type="radio" name ="action_choice" value="update_class">
        <label>Modifier un cours</label> 

        <br><br>

        <form action="../controller/controller_create_class.php" method="post" id="form_manage_class">
            <img src="../images/tooltip_icon.png" class="masterTooltip"
                 title="La liste des cours existants permets de confirmer
                 qu'un cours n'existe pas avant de le créer."
                 />
            <label id="label_class_list">Liste des cours déjà existants : </label>

            <br>

            <?php
            showListeCours();
            ?>

            &nbsp &nbsp

            <label>Rechercher : </label>
            <input type='text' name='search_cours' value=''
              onKeyUp="arrayFilter(this.value, this.form.class_list_all)"
              onChange="arrayFilter(this.value, this.form.class_list_all)"
            />

            <br>
            <br>

          <input type="checkbox" name="change_code" id="change_code" onchange="checkboxInterraction()"> 
          <label id="label_code_class">Je souhaite changer le code du cours sélectionné</label>

          <label>Code du cours : </label>
          <div>
            <input data-val="true" id="CodeCours" name="CodeCours" type="text" 
              onkeypress="return filterClassCode(event);"
              required
              value="<?php 
              if( isset($_SESSION['CodeCours']) )
              {
                echo $_SESSION['CodeCours'];
                unset($_SESSION['CodeCours']);
              } 
              ?>"
              
            />
         </div>

          <br>

          <label>Nom du cours : </label>
          <div>
            <input data-val="true" id="NomCours" name="NomCours" type="text" 
            value="<?php 
              if( isset($_SESSION['NomCours']) )
              {
                echo $_SESSION['NomCours'];
                unset($_SESSION['NomCours']);
              } 
              ?>" 
            />
          </div>

          <br>

          <label>Type du cours : </label>
          <div>
            <select name='TypeCours' required>
              <?php 
                if( isset($_SESSION['TypeCours']) )
                {
                  switch ($_SESSION['TypeCours']) 
                  {
                    case 'Enseignement régulier':
                      $type_enseignement = 
                      "<option selected value='Enseignement régulier'>" .
                        " Enseignement régulier" .
                      "</option>" .
                      "<option value='Formation continue'>" . 
                        "Formation continue" . 
                      "</option>";
                      break;
                    case 'Formation continue':
                      $type_enseignement = 
                      "<option value='Enseignement régulier'>" .
                        " Enseignement régulier" .
                      "</option>" .
                      "<option selected value='Formation continue'>" . 
                        "Formation continue" . 
                      "</option>";
                      break;
                    default :
                      $type_enseignement = 
                      "<option value='Enseignement régulier'>" .
                        " Enseignement régulier" .
                      "</option>" .
                      "<option value='Formation continue'>" . 
                        "Formation continue" . 
                      "</option>";
                      break; 
                  }
                }
                else
                {
                  $type_enseignement = 
                      "<option value='Enseignement régulier'>" .
                        " Enseignement régulier" .
                      "</option>" .
                      "<option value='Formation continue'>" . 
                        "Formation continue" . 
                      "</option>";
                }
                echo $type_enseignement;
                unset($_SESSION['TypeCours']);
              ?>
            </select>
          </div>

          <br>

          <label>Ponderation du cours : </label>
          <div>
            <input data-val="true" id="Ponderation" name="Ponderation" type="text" 
            pattern="\d{1,2}-\d{1,2}-\d{1,2}"
            value="<?php 
              if( isset($_SESSION['Ponderation']) )
              {
                echo $_SESSION['Ponderation'];
                unset($_SESSION['Ponderation']);
              } 
              ?>" 
            />
          </div>

          <br>

          <label>Nombre d'unités : </label>
          <div>
            <input data-val="true" id="NombreUnites" name="NombreUnites" type="Number" 
            step="0.01"
            min="0"
            max="10"
            value="<?php 
              if( isset($_SESSION['NombreUnites']) )
              {
                echo $_SESSION['NombreUnites'];
                unset($_SESSION['NombreUnites']);
              } 
              ?>"
            />
          </div>

          <br>
          <label>Nombre d'heures : </label>
          <div >
            <input data-val="true" id="NombreHeures" name="NombreHeures" type="Number"
            step="10"
            min="50"
            max="200"
            value="<?php 
              if( isset($_SESSION['NombreHeures']) )
              {
                echo $_SESSION['NombreHeures'];
                unset($_SESSION['NombreHeures']);
              } 
              ?>" 
            />
          </div>
          
          <br>

          <label>Programme du cours : </label>
          <div>
          <?php showListPrograms(); ?>

          &nbsp &nbsp

          <label>Rechercher :</label>
          <input type='text' name='search_program' 
            onKeyUp="arrayFilter(this.value, this.form.CodeProgramme)"
            onChange="arrayFilter(this.value, this.form.CodeProgramme)"
            value='<?php 
              if( isset($_SESSION['search_program']) )
              {
                echo $_SESSION['search_program'];
                unset($_SESSION['search_program']);
              } 
              ?>'
          />
          </div>

          <br>

          <div>
            <input type="submit" value="Soumettre..." class="btn btn-default" /> <br /><br />
          </div>

        </form> 
      </fieldset>
    </div>
  </body>
</html>

    <?php 
        showSessionMessage("errors_add_class");
        showSessionMessage("success_add_class");

        showSessionMessage("errors_update_class");
        showSessionMessage("success_update_class");
    ?>
