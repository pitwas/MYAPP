  <div class="nav navbar-nav navbar-right" style='width:23%;'>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
					
					<?php $sth = $conn->prepare("select f.uid,f.status,u.first_name,u.email,u.address,u.mobile,c.city_name,s.state_name from friends as f inner join users as u on f.uid=u.user_id inner join states as s on s.id=u.states inner join cities as c on c.id=u.cities where f.fid ='$_SESSION[user_id]' and f.status=1");
					$sth->execute();
					?>
					<select name='frndid' id='frndid' onchange="fetchchat();" class="form-control" style="width:50%">
					<option value="">Select Friend</option>
					<?php while($result = $sth->fetch(PDO::FETCH_ASSOC)){
					?>
				
					<option value="<?= $result['uid'] ?>"><?= $result['first_name'] ?></option><?php  }?>
					
					
					</select>
					
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                         <li><a href="#"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-time"></span>
                                Away</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><span class="glyphicon glyphicon-off"></span>
                                Sign Out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
				 <div id="demo"></div><br> 
				<!--
                    <ul>
					
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                       
                    </ul>-->
					
                </div>
                <div class="panel-footer">
                    <div class="input-group">
					
                        <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm glyphicon glyphicon-send" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
      <a class="navbar-brand " href="">Developed By Pitwas Patel</a>
  
