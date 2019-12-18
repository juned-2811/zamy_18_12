<div class="nDVxx">
   <div class="_1LkiC">
      <div>
         <div class="_3eNnq">
			<form method="post" action="<?php echo base_url('search'); ?>">
				<div class="_38pEg"><i class="icon-magnifier _1F77L"></i>
				<input type="text" name="search_keyword" class="_2BJMh" placeholder="Search for restaurants or dishes" autocomplete="off">
				<a class="_3TI86">clear</a>
				<span class="_2Tyn1"><i class="icon-close-thin _3pIVC"></i><span class="py3n3">ESC</span></span>
				</div>
				<input style="display:none;" type="submit" name="search">
			</form>
         </div>
         <div class="_23oa6">
            <div class="_2pQzW">
               <a class="_2wXvU _2i4KE">Restaurants</a><a class="_2wXvU">Dishes</a>
               <div class="_1XwWR">
                  <div class="_2438Q">
                     <a class="_13TKm">Relevance<i class="icon-downArrowSmall _3ycTq"></i></a>
                     <ul class="_23EJe undefined">
                        <li class="_364W3 _2JKM1">Relevance<i class="icon-tickSharp _2VnAV"></i></li>
                        <li class="_364W3">Delivery Time</li>
                        <li class="_364W3">Rating</li>
                        <li class="_364W3">Cost For Two</li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="EiD4d">
               <div>
                  <div class="_108BW">
                     <div class="_27-i_">Related to "<span class="_1qtJs">sandwich</span>"</div>
                     <div class="_2yTju">
                        <div class="card">
						  <div class="card-body">
							<div class="_1LV_f undefined" id="all_restaurants">
							<div class="_3LhmH _3pef6"></div>
							<div class="">
									<div>
									<div style="">
									   <div class="MZy1T">
										<?php 
										if(!empty($all_restaurants)){
										foreach($all_restaurants as $data){ 
										
										?>
											 <div class="_3XX_A">
											 <a href="<?php echo base_url('restaurants/'.$data['res_alias']);?>" class="_1j_Yo">
												<div class="_1HEuF">
												   <div class="_3FR5S">
													  <div class="efp8s"><img class="_2tuBw _12_oN" alt="Raj Ice Cream" width="254" height="160" src="<?php echo 'http://192.168.15.23/hopmeal_pos/uploads/kitchen/images/'.$data['images'];?>"></div>
													  <div class="_3Ztcd">
														 <div class="nA6kb"><?php echo $data['res_name']?></div>
														 <div class="_1gURR" title="<?php echo $data['service_type']?>"><?php echo $data['service_type']?></div>
													  </div>
													  <div class="_3Mn31">
														 <div><?php echo $data['approx_delivery_time']?></div>
														 <div>•</div>
														 <div class="nVWSi"><?php echo $data['approx_cost']?></div>
													  </div>
												   </div>
												</div>
											 </a>
										  </div>
										<?php }} ?>
										  
									   </div>
									   
									</div>
								 </div>
								 <div>
								 </div>
							  </div>
						   
						   <div class="J2YDs _1nFCY"></div>
						</div>
						  </div>
						</div>
                     </div>
                  </div>
					
					<div class="EiD4d">
						<div>
							<div class="_1cJ_d"><div class="_27-i_"><a class="_18KNl">Suggestions</a><span class="icon-rightArrow _3XWwd"></span><span class="_1qtJs"><?php echo $keyword;?></span></div></div>
						</div>
					</div>
					
					<?php
					$CI =& get_instance();
					$CI->load->model('common_model');
					
					if(!empty($all_dishes)){
					foreach($all_dishes as $key=>$res){ 
					
					$restaurant_id = $key;
					
					$restaurant_details = $this->common_model->restaurant_details($restaurant_id);
					
					
					$res_name 				= $restaurant_details['res_name'];
					$res_alias 				= $restaurant_details['res_alias'];
					$service_type 			= $restaurant_details['service_type'];
					$area 					= $restaurant_details['area'];
					$landmark 				= $restaurant_details['landmark'];
					$city_name 				= $restaurant_details['city_name'];
					$approx_delivery_time 	= $restaurant_details['approx_delivery_time'];
					$approx_cost 			= $restaurant_details['approx_cost'];
					
					?>
					
					<div class="c_Wl4">
						<div class="_1N1IJ">
							<div class="_19wpT">
								<div class="_2Zp7d">
									<h2 class="_2xYa7"><?php echo $res_name;?>
									<a class="_2H8LW" href="<?php echo base_url('restaurants/'.$res_alias);?>">See Menu</a></h2>
									<p class="fxt3y"><?php echo $service_type;?> (<?php echo $area.", ".$landmark;?>)</p>
									<p class="_1lKFw">
									<span class="_3FTfu"><?php echo $approx_delivery_time;?></span>
									<span class="_3FTfu"><?php echo $approx_cost;?></span>
									</p>
								</div>
								<div class="NwavL">
									<?php 
									if(!empty($res)){ 
									foreach($res as $menu){
									
									
									
									$menu_name 		= $menu['menu_name'];
									$description 	= $menu['long_description'];
									$price 			= $menu['price'];
									$reduced_price 	= $menu['reduced_price'];
									$tax_price 		= $menu['tax_price'];
									$food_type 		= $menu['food_type'];
									$veg_class = '';
									if($food_type==1){
										$veg_class = "_3x58u";
									}
									?>
									<div class="_2wg_t">
										<div><span class="icon-foodSymbol tKOaB _27EeV <?php echo $veg_class;?>"></span>
											<div class="GaqmA">
												<div>
													<?php if(!empty($menu['product_variation'])){?>
														<div class="_1G3G4 _3L1X9">
														   <div class="_1RPOp">ADD</div>
														   <div class="_3Hy2E">+</div>
														   <div class="_1ds9T _2WdfZ _4aKW6">+</div>
														   <div class="_29Y5Z _20vNm _4aKW6"></div>
														   <div class="_2zAXs _2quy- _4aKW6">0</div>
														   <div class="_1C1Fl">Customisable</div>
														</div>
													<?php }else{ ?>
													<div class="_1G3G4 _3L1X9">
														<div class="_1RPOp">ADD</div>
														<div class="_1ds9T _2WdfZ _4aKW6">+</div>
														<div class="_29Y5Z _20vNm _4aKW6"></div>
														<div class="_2zAXs _2quy- _4aKW6">0</div>
													</div>
													<?php } ?>
													<div class="_19GqV">
														<div class="_2Gojq">
															<div class="jTy8b" itemprop="name"><?php echo $menu_name;?></div>
														</div>
														<div class="_2aOqz _1xb2E"><?php echo $description;?></div>
														<div class="_12lpv MwITc"><span class="bQEAj"><?php echo $price;?></span></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php } }?>
								</div>
							</div>
						</div>
					</div>
					<?php } } ?>
					
                  <div class="W-nHp">
                     <div class="_2XOBp">
                        <h2 class="w8m6w">Currently unserviceable</h2>
                        <div class="_2YEgi">
                           <div class="MZy1T">
                              <div class="_3XX_A">
                                 <a role="button" aria-label="Open" href="/restaurants/josh-fun-point-nikol-bapunagar-ahmedabad-131426" class="_1cdVJ">
                                    <div class="SYmFL">
                                       <div class="tmKiP">
                                          <div class="_1zjMg">
                                             <div class="_1s9IR">Josh Fun Point</div>
                                             <div class="_1VerS">Fast Food</div>
                                          </div>
                                       </div>
                                       <div class="_2Y2X_"><img class="_2tuBw _12_oN" alt="Josh Fun Point" width="70" height="70" src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_140,h_140,c_fill/osrldpnq2gaeps3wfo8l"></div>
                                    </div>
                                 </a>
                              </div>
                              <div class="_3XX_A">
                                 <a role="button" aria-label="Open" href="/restaurants/joy-restaurant-bapunagar-ahmedabad-91486" class="_1cdVJ">
                                    <div class="SYmFL">
                                       <div class="tmKiP">
                                          <div class="_1zjMg">
                                             <div class="_1s9IR">Joy Restaurant</div>
                                             <div class="_1VerS">Chinese, North Indian</div>
                                          </div>
                                       </div>
                                       <div class="_2Y2X_"><img class="_2tuBw _12_oN" alt="Joy Restaurant" width="70" height="70" src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_140,h_140,c_fill/nkt3bzsiqqlrl6tmdr8t"></div>
                                    </div>
                                 </a>
                              </div>
                              <div>
                                 <a class="_3XX_A _3KFDE">
                                    <div class="_1j_Yo">
                                       <div class="_3iWTD">
                                          <div class="_3FR5S">
                                             <div class="_1MemN"></div>
                                             <div class="_79i_S"></div>
                                             <div class="_1X1Vy"></div>
                                          </div>
                                       </div>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			
         </div>
      </div>
   </div>
</div>