<?php
global $base_path;
$theme_path = $base_path . drupal_get_path('theme', 'citi_custom_theme');
?>
<!-- Modal One -->
        <div id="modal-one" class="modal fade city-modal" role="dialog">
            <div class="modal-dialog modal-md Group-24">
                <!-- Modal content-->
                <div class="modal-content Rectangle-6-Copy" style="
                    width: 900px;
                    margin-left: -154px;border-radius:0;">
                    <div class="modal-header">
                        <div class="Activate">
                            <button type="button" class="close Circle-Fill" data-dismiss="modal"></button>
                            <h1 class="modal-title">Activate</h1>
                        </div>
                    </div>
                    <div class="modal-body">
                        <h2 class="heading clearfix"><img src="<?php print $theme_path;?>/images/userlock.png"  width="80px" height="80px"> <span>Welcome to the Citi Developer Hub </span></h2>
                        <div class="form-element clearfix">
                            <div class="row-1">
                                <div class="col-1"><input id="i23" class="form-control one" type="text" required placeholder="John"></div>
                                <div class="col-2"><input class="form-control one" type="text" required placeholder="Smith"></div>
                            </div>
                            <div class="row-1">
                                <div class="col-1"><input class="form-control one" type="text" placeholder="john.smith@citi.com"></div>
                                <div class="col-2"><input class="form-control one" type="text" placeholder="ACME Company"></div>
                            </div>
                        </div>
                        <h2 class="ttl-2 heading2 clearfix" style="clear:both;float:none;">Please create a User ID and Password</h2>
                        <div class="createuser cbolui-ddl clearfix" style="position:relative;">
                            <div class="row-1">
                                <div class="col-1">
                                    <input id="userid" name="userid" class="form-control one" type="text" placeholder="User ID">
                                </div>
                                <div class="col-2 error-box userid-error-box hide">
                                    <div class="ral-cont col-xs-12 col-sm-12">
                                        <div class="arrow"></div>
                                        <div>
                                            <span class="validation-message-danger"> 
                                                Your User ID doesn't seem to meet our requirements  
                                            </span>
                                            <p>User ID Guidelines</p>
                                        </div>
                                        <div class="ral">
                                            <ul> 
                                                <li class="x-mark">From 6 - 20 characters</li> 
                                                <li class="check-mark">No leading or trailing whitespaces or in middle</li>
                                                <li class="x-mark">Case sensitive</li>
                                                <li class="x-mark">No more than 3 consecutive digits</li>
                                                <li class="x-mark">Allowed special characters: _ * & , ! / +</li>
                                            </ul>
                                       </div> 
                                    </div> 
                                </div>                                
                            </div>
                            <div class="row-1">
                                <div class="col-1"><input id="password" name="password" class="form-control one" type="text" placeholder="Password"></div>
                                <div class="col-2 error-box password-error-box hide">
                                    <div class="arrow"></div>
                                    <div class="ral-cont col-xs-12 col-sm-12"> 
                                        <div>
                                            <span class="validation-message-danger"> 
                                               Your password doesn't seem to meet our requirements  
                                            </span>
                                            <p>Password Guidelines</p>
                                        </div>
                                        <div class="ral">
                                            <ul> 
                                                <li class="x-mark">From 8 - 50 characters</li> 
                                                <li class="check-mark">No leading or trailing whitespaces or in middle</li>
                                                <li class="x-mark">Case sensitive</li>
                                                <li class="x-mark">At least 1 letter (upper or lower)</li>
                                                <li class="x-mark">At least 1 number</li>
                                                <li class="x-mark">No more than 2 consecutive characters</li>
                                                <li class="x-mark">Allowed special characters: * & , ! / +</li>
                                                <li class="x-mark">Cannot contain username</li>
                                            </ul>
                                       </div> 
                                    </div> 
                                </div>                                
                            </div>
                            <div class="row-1">
                                <div class="col-1"><input class="form-control one" type="text" placeholder="Confirm Password"></div>
                            </div>                            
                        </div>
                        <h2 class="ttl-2 heading3">CAPTCHA</h2>
                        <div class="row-1 captcha-container">
                            <div class="col-1 font-12 This-question-is-for"><span class="captcha-message">This question is for testing weather you
are a human visitor and to prevent
automated spam submissions.</span></div>
                            <div class="col-2">
                                <img src="images/captcha.png" width="182" height="64" /> <br clear="all" />
                                <input class="form-control one" placeholder="What is the text on the image?" type="text">
                            </div>
                        </div>

                        <div class="row-1 terms-align">
                            <div class="check-align-1">
                                <input type="checkbox" id="check-1" required>
                                <span for="check-1"></span>
                            </div>
                            <div class="accept-link">I accept the <a href="#">Terms and Conditions</a></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <a class="btn btn-default cancel" href="#"><span class="butchnge">Cancel</span></a> 
                            <a class="btn btn-info continue"  href="#"><span class="butchnge">Continue</span></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal One Ends -->