
<?php if($row > 0){?>

<div class='row'><div class='col-lg-12 '> <table width='100%' >  <thead> <tr class='d-flex align-items-center profile-div-padding' style='width: 100%'>
                                        <th style='width: 40%'>Prepaid Service:</th>
                                        
                                            
                                            <td> <select onchange="set_service(this.value,'prepaid')">
                                            <option  <?php if($res[0]['prepaid_service'] == 'Yes' ){?> selected <?php  } ?> value="Yes">Yes</option>
                                             <option <?php if($res[0]['prepaid_service'] == 'No' ){?> selected <?php  } ?> value="No">No</option>
                                        </select></td>
                                        
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding' style='width: 100%'>
                                        <th style='width: 40%'>Postpaid Service:</th>
                                          
                                            <td> <select onchange="set_service(this.value,'postpaid')">
                                            <option  <?php if($res[0]['postpaid_service'] == 'Yes' ){?> selected <?php  } ?> value="Yes">Yes</option>
                                             <option <?php if($res[0]['postpaid_service'] == 'No' ){?> selected <?php  } ?> value="No">No</option>
                                        </select></td>
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding' style='width: 100%'>
                                        <th style='width: 40%'>Landline Service:</th>
                                          <td> <select onchange="set_service(this.value,'landline')">
                                            <option  <?php if($res[0]['landline_service'] == 'Yes' ){?> selected <?php  } ?> value="Yes">Yes</option>
                                             <option <?php if($res[0]['landline_service'] == 'No' ){?> selected <?php  } ?> value="No">No</option>
                                        </select></td>
                                        
                                        
                                    </tr>
                                  
                                    
                                    <tr class='d-flex align-items-center profile-div-padding' style='width: 100%'>
                                        <th style='width: 40%'>Dth Service:</th>
                                         <td> <select onchange="set_service(this.value,'dth')">
                                            <option  <?php if($res[0]['dth_service'] == 'Yes' ){?> selected <?php  } ?> value="Yes">Yes</option>
                                             <option <?php if($res[0]['dth_service'] == 'No' ){?> selected <?php  } ?> value="No">No</option>
                                        </select></td>
                                        
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding' style='width: 100%'>
                                        <th style="width: 40%">Electricty Service:</th>
                                      <td> <select onchange="set_service(this.value,'electricity')">
                                            <option  <?php if($res[0]['electricity_service'] == 'Yes' ){?> selected <?php  } ?> value="Yes">Yes</option>
                                             <option <?php if($res[0]['electricity_service'] == 'No' ){?> selected <?php  } ?> value="No">No</option>
                                        </select></td>
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding' style='width: 100%'>
                                        <th style='width: 40%'>Dmr Service:</th>
                                       <td> <select onchange="set_service(this.value,'dmr')">
                                            <option  <?php if($res[0]['dmr_service'] == 'Yes' ){?> selected <?php  } ?> value="Yes">Yes</option>
                                             <option <?php if($res[0]['dmr_service'] == 'No' ){?> selected <?php  } ?> value="No">No</option>
                                        </select></td>
                                        
                                    </tr>
                                    
                                </thead>
                            </table>
                        </div>
                    </div>
    
        
</div>
   <?php }else{ ?>
      <div class='row'>
  
             <div class='col-lg-12 '> 
                            <table width='100%' >
                                <thead>
                                   
                                    <tr class='d-flex align-items-center profile-div-padding mb-2' style='width: 100%'>
                                        <th style='width: 40%'>Prepaid Service:</th>
                                         
                                            <td> <select onchange="set_service(this.value,'prepaid')">
                                            <option value="Yes">Yes</option>
                                             <option selected="selected" value="No">No</option>
                                        </select></td>
                                         
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding mb-2' style='width: 100%'>
                                        <th style='width: 40%'>Postpaid Service:</th>
                                         
                                            <td> <select onchange="set_service(this.value,'postpaid')">
                                            <option value="Yes">Yes</option>
                                             <option selected="selected" value="No">No</option>
                                        </select></td>
                                           
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding mb-2' style='width: 100%'>
                                         <th style='width: 40%'>Landline Service:</th>
                                          
                                           <td> <select onchange="set_service(this.value,'landline')">
                                            <option value="Yes">Yes</option>
                                             <option selected="selected" value="No">No</option>
                                        </select></td>
                                           
                                        
                                    </tr>
                                   
                              
                                   
                                    <tr class='d-flex align-items-center profile-div-padding mb-2' style='width: 100%'>
                                        <th style='width: 40%'>Dth Service:</th>
                                      
                                            <td> <select onchange="set_service(this.value,'dth')">
                                            <option value="Yes">Yes</option>
                                             <option selected="selected" value="No">No</option>
                                        </select>
                                    </td>
                                            
                                        
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding mb-2' style='width: 100%'>
                                     <th style='width: 40%'>Dmr Service:</th>
                                       
                                             <td> <select onchange="set_service(this.value,'dmr')">
                                            <option value="Yes">Yes</option>
                                             <option selected="selected" value="No">No</option>
                                        </select></td>
                                           
                                        
                                    </tr>
                                    <tr class='d-flex align-items-center profile-div-padding mb-2' style='width: 100%'>
                                       <th style="width: 40%">Electricty Service:</th>
                                        <td>
                                        <select onchange="set_service(this.value,'electricity')">
                                            <option value="Yes">Yes</option>
                                             <option selected="selected" value="No">No</option>
                                        </select>
                                          </td>
                                     </tr>
                                    
                                </thead>
                            </table>
                        </div>
                    </div>
    
    
</div>
  <?php  } ?>