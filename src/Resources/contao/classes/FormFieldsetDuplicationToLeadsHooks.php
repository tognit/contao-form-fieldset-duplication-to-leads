<?php

namespace CliffParnitzky\FormFieldsetDuplicationToLeads;

use Leads\Leads;

class FormFieldsetDuplicationToLeadsHooks
{

  public function modifyLeadsDataOnStore($arrPost, $arrForm, $arrFiles, $intLead, $objFields, $arrSet)
  {
    $time = time();
    
    $duplicateFields = [];
    foreach ($arrPost as $name => $value) 
    {
      if (false !== strpos($name, $objFields->name . '_duplicate_'))
      {
        $duplicateFields[] = $name;
      }
    }
    
    foreach($duplicateFields as $duplicateField)
    {
      if (isset($arrPost[$duplicateField]))
      {
        $varValue = Leads::prepareValue($arrPost[$duplicateField], $objFields);
        $varLabel = Leads::prepareLabel($varValue, $objFields);

        $arrSet = array
        (
          'pid'       => $intLead,
          'sorting'   => $objFields->sorting,
          'tstamp'    => $time,
          'master_id' => $objFields->master_id,
          'field_id'  => $objFields->id,
          'name'      => $duplicateField,
          'value'     => $varValue,
          'label'     => $varLabel,
        );
        \Database::getInstance()->prepare("INSERT INTO tl_lead_data %s")->set($arrSet)->executeUncached();
      }
    }
  }

}
?>