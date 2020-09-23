<?php

class ComboBox {

    /** @var string nom du select  */
    private $selectName;

    /** @var string nom de l'attribut contenant la valeur à sélectionner */
    private $selectedAttributName;

    /** @var object valeur actuellement sélectionnée */
    private $selectedValue;

    /** @var array liste des attributs d'option à afficher */
    private $optionAttributesNames;

    /** @var Array liste des options du select à afficher */
    private $options;

    /** @var string première ligne d'option affichée dans le select */
    private $selectMessage;

    /** @var string message affiché dans la combo box si celle-ci est vide */
    private $emptyMessage;

    public function __construct($properties) {
        $this->selectName=$properties['selectName'];
        $this->selectedAttributName=$properties['selectedAttributName'];
        $this->selectedValue=$properties['selectedValue'];
        $this->optionAttributesNames=$properties['optionAttributesNames'];
        $this->options=$properties['options'];
        $this->selectMessage=$properties['selectMessage'];
        $this->emptyMessage=$properties['emptyMessage'];
    }

    public function __get($property) {
        switch ($property) {
            case 'selectName':
                return $this->selectName;
                break;
            case 'selectedAttibutName':
                return $this->selectedAttributName;
                break;
            case 'selectedValue':
                return $this->selectedValue;
                break;
            case 'optionAttributesNames' :
                return $this->optionAttributesNames;
                break;
            case 'options':
                return $this->options;
                break;
            case 'selectMessage':
                return $this->selectMessage;
                break;
            case 'emptyMessage':
                return $this->emptyMessage;
                break;
            default:
                throw new Exception("Propriété invalide : {$property}");
        }
    }   
    
    public function __set($property,$value) {
        switch ($property) {
            case 'selectName':
                $this->selectName=$value;
                break;
            case 'selectedAttibutName':
                $this->selectedAttributName=$value;
                break;
            case 'selectedValue':
                $this->selectedValue=$value;
                break;
            case 'optionAttributesNames' :
                $this->optionAttributesNames=$value;
                break;
            case 'options':
                $this->options=$value;
                break;
            case 'selectMessage':
                $this->selectMessage=$value;
                break;
            case 'emptyMessage':
                $this->emptyMessage=$value;
                break;
            default:
                throw new Exception('Propriété inconnue !');
        }
    }

    public function Render() {
        echo "<select name={$this->selectName}>";
        if (isset($this->options)) {
            echo "<option value=''>{$this->selectMessage}</option>";
            foreach ($this->options as $option) {
                if ($option["{$this->selectedAttributName}"]===$this->selectedValue) {
                    $selected='selected';
                }
                else {
                    $selected="";
                }
                echo "<option value='{$option["{$this->selectedAttributName}"]}' {$selected}>";
                foreach ($this->optionAttributesNames as $attribute) {
                    echo $option["{$attribute}"].' ' ;
                }
                echo "</option>";
            }
        }
        else {
            echo "<option value=''>{$this->emptyMessage}</option>";
        }
        echo "</select>";
    }

}