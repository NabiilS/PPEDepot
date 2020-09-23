<?php


/** @param CI_model $model
 *  @param CI_Form_validation $formValidation
 */
function LoadValidationRules($model,$formValidation) {
    foreach ($model->ValidationRules as $rule) {
        $formValidation->set_rules($rule['field'],$rule['label'],$rule['rules']);
    }
}
