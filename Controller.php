<?php

    public function auto_generate_add_form($table_fields,$data_type,$form_action) {		 
 
		        $fattr = array('class' => 'form-signin','enctype' => 'multipart/form-data');
		        $data[] = form_open($form_action, $fattr); 
		        				 
						foreach ($table_fields as $field)
						{
						   
						   $data[] = '<div class="form-group">';
						   $placeHolderName = ucfirst($field);
						   $placeHolderName = str_replace('_',' ',$placeHolderName);
						   
							if($field == 'detail') {
								
									$data[] = form_textarea(array('name'=>$field, 'id'=> $field, 'placeholder'=>$placeHolderName, 'class'=>'form-control', 'required' => 'true')); 
								
							}elseif (strpos($field, '_type') !== false) {
								
									$data[] = '<select name="'.$field.'">';
									$data[] = '<option value="'.$field.'">'.$placeHolderName.'</option>';							
									foreach ($data_type as $type)
									{    		
						
										$data[] = '<option value="'.$type->id.'">'.$type->name.'</option>';
						
									}
												
		    						$data[] = '</select>';
		    						
							}elseif (strpos($field, 'pic') !== false) {
								
									$data[] = form_input(array('name'=>$field, 'id'=> $field, 'placeholder'=>$placeHolderName, 'type'=>'file', 'class'=>'form-control')); 																
							}else {
									
									$data[] = form_input(array('name'=>$field, 'id'=> $field, 'placeholder'=>$placeHolderName, 'class'=>'form-control', 'required' => 'true')); 
		
							}
							
							$data[] = form_error($field);
							$data[] = '</div>';
						   
						}		
					 
		         $data[] = form_submit(array('value'=>'Save', 'class'=>'btn btn-lg btn-primary btn-block')); 
		    	   $data[] = form_close(); 
		    	   
		    	   return $data;
    	   
    }
    
   public function auto_generate_edit_form($table_fields,$data_type,$form_action) {		 
   
   		 		$fattr = array('class' => 'form-signin','enctype' => 'multipart/form-data');
   		 
		        $data[] = form_open($form_action, $fattr); 
		        				 
						foreach ($table_fields as $field=>$val)
						{
							
                		$placeHolderName = ucfirst($field);
						   $placeHolderName = str_replace('_',' ',$placeHolderName);						   
						   
						   $data[] = '<div class="form-group">';
						   
							if($field == 'detail') {
								
									$data[] = form_textarea(array('name'=>$field, 'id'=> $field, 'placeholder'=>$placeHolderName,'value'=>$val, 'class'=>'form-control', 'required' => 'true')); 
								
							}elseif (strpos($field, '_type') !== false) {
								
									$data[] = '<select name="'.$field.'">';
									$data[] = '<option value="'.$field.'">'.$placeHolderName.'</option>';							
									foreach ($data_type as $type)
									{  
										  		
										if($type->id == $val) {
											$selected = 'selected';
										}else {
											$selected = '';
										}
											
										$data[] = '<option value="'.$type->id.'" '.$selected.'>'.$type->name.'</option>';
						
									}
												
		    						$data[] = '</select>';
		    						
							}elseif (strpos($field, 'pic') !== false) {
								
									$data[] = form_input(array('name'=>$field, 'id'=> $field, 'placeholder'=>$placeHolderName, 'type'=>'file', 'class'=>'form-control'));
									
									$data[] = form_input(array('name'=>$field.'_old', 'type'=>'hidden', 'value'=>$val));
									
									if($val) {
										$data[] = '<BR>';
										$data[] = '<img src="../../../images/'.$val.'" width="200"> ';	
									}	
									
							}elseif (strpos($field, '_id') !== false) {
								
									$data[] = form_input(array('name'=>$field, 'id'=> $field, 'placeholder'=>$placeHolderName, 'value' =>$val, 'type'=>'hidden', 'class'=>'form-control'));		 						
																			
							}else {
									
									$data[] = form_input(array('name'=>$field, 'id'=> $field, 'placeholder'=>$placeHolderName,'value'=>$val, 'class'=>'form-control', 'required' => 'true')); 
		
							}
							
							$data[] = form_error($field);
							$data[] = '</div>';
						   
						}		
					 
		         $data[] = form_submit(array('value'=>'Save', 'class'=>'btn btn-lg btn-primary btn-block')); 
		    	   $data[] = form_close(); 
		    	   
		    	   return $data;
	} 
  
  public function yourcompany()
	{
	  
	    $data['title'] = "Dashboard Admin";
	    
	    $company_fields = $this->user_model->getCompanyFields();
	    $company_type = $this->user_model->getCompanyType();
	    $data['add_form'] = $this->auto_generate_add_form($company_fields,$company_type,'/main/addcompany'); 
	     
       $this->load->view('company', $data);
  
	}
	
	public function editcompany()
	{
	    
	    $data['title'] = "Dashboard Admin";
	    $company_type = $this->user_model->getCompanyType();
	    
	    $company_id = $this->uri->segment(3);
	    $company_info = $this->user_model->getCompanyInfo($company_id);
	    $data['edit_form'] = $this->auto_generate_edit_form($company_info,$company_type,'/main/editcompany'); 
	     
       $this->load->view('editcompany', $data);
     
	}
  
  ?>
