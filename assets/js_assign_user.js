/* 
   Nom : js_assign_user.js
   Contient les functions en javascript utilisé par la vue
   view_assign_user.php
   
*/

$(function () {
                $('#assignation input[type=radio]').change(function(){
                    if ($(this).val() == "assign" ) {
                        $( "#class_list_all" ).prop( "disabled", false );
                        $( "#class_list_all" ).removeClass('combo_box_disabled')
                        $( "#search_class" ).prop( "disabled", false );
                        $( "#plan_cadre_elaboration_list" ).prop( "disabled", true );
                        $( "#plan_cadre_elaboration_list" ).addClass('combo_box_disabled');
                        $( "#plan_cadre_elaboration_list" ).val("");
                        $( "#search_plan_cadre_elaboration" ).prop( "disabled", true );
                    }

                    else if($(this).val() == "reassign") {
                        $( "#class_list_all" ).prop( "disabled", true );
                        $( "#class_list_all" ).addClass('combo_box_disabled');
                        $( "#class_list_all" ).val("");
                        $( "#search_class" ).prop( "disabled", true );
                        $( "#plan_cadre_elaboration_list" ).prop( "disabled", false );
                        $( "#plan_cadre_elaboration_list" ).removeClass('combo_box_disabled')
                        $( "#search_plan_cadre_elaboration" ).prop( "disabled", false );
                    }
                })
            })

            $( window ).load(function() {
                $( "#plan_cadre_elaboration_list" ).prop( "disabled", true );
                $( "#search_plan_cadre_elaboration" ).prop( "disabled", true );
                $( "#plan_cadre_elaboration_list" ).addClass('combo_box_disabled');
            });
            