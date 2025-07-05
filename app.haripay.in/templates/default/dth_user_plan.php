 <div class="container-fluid">
 <div class="row">
        <div class="col-md-12" id="dth_provider_info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs">
                        <ul class="nav nav-tabs" id="dth_plans_parent">
                            <li class="nav-item active" id="dth_plans_primary">
                                <a class="nav-link active" href="#dth_plans" data-toggle="tab" onclick="get_dth_plans()">Plans</a>
                            </li>
                            <!--li class="nav-item ">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_mobile_offers('prepaid')">R Offers</a>
                            </li-->
                        </ul>
                        <div class="tab-content top_margin_10">
                            <div id="dth_plans" class="tab-pane active">
                                <table class="table table-bordered table-striped" width="100%" padding="4" style="padding:10px;">
								<thead>
                                    <tr>
                                        <th width="75%">Description</th>
                                        <th width="15%">Validity</th>
                                        <th width="10%">Price</th>
                                    </tr>
									</thead>
									<?php if($months == 1){ ?>
 <tr >
                                        <td width="75%">Family Plus</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('399')">399</button></td>
                                    </tr>
									<tr>
                                        <td width="75%">New Mega - South</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('477')">477</button></td>
                                    </tr>

									<?php  } ?>
                                   <?php if($months == 2)  {?>
									<tr>
                                        <td width="75%">My Family HD - South</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('558')">558</button></td>
                                    </tr>
									<tr>
                                        <td width="75%">Value Prime Kids HD</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('485')">485</button></td>
                                    </tr>
									<tr>
                                        <td width="75%">Jackpot - South</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('550')">550</button></td>
                                    </tr>
							<?php } ?>
                                   <?php if($months == 3)  {?>
									<tr>
                                        <td width="75%">Jumbo Family pack for 3 Months</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('1320')">1320</button></td>
                                    </tr>
									<tr>
                                        <td width="75%">World Sport Pack (ROI) for 3 Months</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('1305')">1305</button></td>
                                    </tr>

						
								<?php } ?>
                                   <?php if($months == 4)  {?>
									<tr>
                                        <td width="75%">Jumbo Family pack</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('1425')">1425</button></td>
                                    </tr>
									<tr>
                                        <td width="75%">World Sport Pack (ROI)</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('1205')">1205</button></td>
                                    </tr>

							<?php } ?>
							<?php if($months == 6)  {?>
									<tr>
                                        <td width="75%">Dish 99 Pack (ROI)**OR**Joy Pack/Khushi Pack (South India) for 6 Months </td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('594')">594</button></td>
                                    </tr>
									
							<?php } ?>

                                   <?php if($months == 12)  {?>
									<tr>
                                        <td width="75%">Dish 99 Pack (ROI)**OR**Joy Pack/Khushi Pack (South India) </td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('1188')">1188</button></td>
                                    </tr>
									<tr>
                                        <td width="75%">World Sport Pack (ROI)</td>
                                        <td width="15%"><?=$months?></td>
                                        <td width="10%"><button type="button" class="btn btn-primary" onclick="get_amount('1205')">1205</button></td>
                                    </tr>
							<?php } ?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-12">
            </div>
        </div>
        
    </div>
	</div>