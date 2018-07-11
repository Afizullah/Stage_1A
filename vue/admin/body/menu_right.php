<!-- Right Sidebar Menu -->
<?php

require_once(PATH_MODEL."admin/showUsers.php");
 ?>
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 style="float:left" class="modal-title" id="">Créer un compte</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <?php getFormAddUsser("index.php?page=addUser"); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">FERMER</button>
      </div>
    </div>
  </div>
</div>
<div class="fixed-sidebar-right">
    <ul class="right-sidebar">
        <li>
            <div  class="tab-struct custom-tab-1">
                <ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
                    <li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="chat_tab_btn" href="#chat_tab">Utilisateurs</a></li>
                    <li role="presentation" class=""><a  data-toggle="tab" id="messages_tab_btn" role="tab" href="#messages_tab" aria-expanded="false">Groupes</a></li>
                    <li role="presentation" class=""><a  data-toggle="tab" id="todo_tab_btn" role="tab" href="#todo_tab" aria-expanded="false">todo</a></li>
                </ul>
                <div class="tab-content" id="right_sidebar_content">
                    <div  id="chat_tab" class="tab-pane fade active in" role="tabpanel">
                        <div class="chat-cmplt-wrap">
                            <div class="chat-box-wrap">
                                <div class="add-friend">
                                    <a href="javascript:void(0)" class="inline-block txt-grey">
                                        <i class="zmdi zmdi-more"></i>
                                    </a>
                                    <span class="inline-block txt-dark">Utilisateurs</span>
                                    <a href="#addUser" data-toggle="modal" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                                <form role="search" class="chat-search pl-15 pr-15 pb-15">
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn  btn-default"><i class="zmdi zmdi-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                                <div id="chat_list_scroll">
                                    <div class="nicescroll-bar">
                                        <ul class="chat-list-wrap">
                                            <li style="height:350px;overflow-y:auto" class="chat-list">
                                                <div class="chat-body">
                                                    <center>
                                                        <div style="width:200px;margin:auto" class="label label-danger">
                                                            Administrateur(s)
                                                        </div>
                                                    </center>
                                                    <?php
                                                    if($administrateurs = ShowUsers::getAdmin()){
                                                        for ($i=0; $i <count($administrateurs) ; $i++) {
                                                            $nom = $administrateurs[$i]["user_nom"];
                                                            $prenom = $administrateurs[$i]["user_prenom"];
                                                            $mail= $administrateurs[$i]["user_mail"];
                                                            ?>
                                                            <a href="javascript:void(0)">
                                                                <div class="chat-data">
                                                                    <div class="user-data">
                                                                        <span class="name block capitalize-font"><?php echo $prenom." ".$nom; ?></span>
                                                                        <span class="help-block  txt-grey"><?php echo $mail; ?></span>
                                                                    </div>

                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </a>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo center("Aucun administrateur");
                                                    }
                                                     ?>
                                                     <center>
                                                         <div style="width:200px;margin:auto" class="label label-success">
                                                             Enseignant(s)
                                                         </div>
                                                     </center>
                                                     <?php
                                                     if($administrateurs = ShowUsers::getEnseignant()){
                                                         for ($i=0; $i <count($administrateurs) ; $i++) {
                                                             $nom = $administrateurs[$i]["user_nom"];
                                                             $prenom = $administrateurs[$i]["user_prenom"];
                                                             $mail= $administrateurs[$i]["user_mail"];
                                                             ?>
                                                             <a href="javascript:void(0)">
                                                                 <div class="chat-data">
                                                                     <div class="user-data">
                                                                         <span class="name block capitalize-font"><?php echo $prenom." ".$nom; ?></span>
                                                                         <span class="help-block  txt-grey"><?php echo $mail; ?></span>
                                                                     </div>

                                                                     <div class="clearfix"></div>
                                                                 </div>
                                                             </a>
                                                             <?php
                                                         }
                                                     }else{
                                                         echo center("Aucun enseignant");
                                                     }
                                                      ?>
                                                     <center>
                                                         <div style="width:200px;margin:auto" class="label label-warning">
                                                             Responsable(s) pédagogique(s)
                                                         </div>
                                                     </center>
                                                     <?php
                                                     if($respPed = ShowUsers::getRespons()){
                                                         for ($i=0; $i <count($respPed) ; $i++) {
                                                             $nom = $respPed[$i]["user_nom"];
                                                             $prenom = $respPed[$i]["user_prenom"];
                                                             $mail= $respPed[$i]["user_mail"];
                                                             ?>
                                                             <a href="javascript:void(0)">
                                                                 <div class="chat-data">
                                                                     <div class="user-data">
                                                                         <span class="name block capitalize-font"><?php echo $prenom." ".$nom; ?></span>
                                                                         <span class="help-block  txt-grey"><?php echo $mail; ?></span>
                                                                     </div>
                                                                     <div class="clearfix"></div>
                                                                 </div>
                                                             </a>
                                                             <?php
                                                         }
                                                     }else{
                                                         echo center("Aucun responsable pédagogique");
                                                     }
                                                      ?>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-chat-box-wrap">
                                <div class="recent-chat-wrap">
                                    <div class="panel-heading ma-0">
                                        <div class="goto-back">
                                            <a  id="goto_back" href="javascript:void(0)" class="inline-block txt-grey">
                                                <i class="zmdi zmdi-chevron-left"></i>
                                            </a>
                                            <span class="inline-block txt-dark">ryan</span>
                                            <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="chat-content">
                                                <ul class="nicescroll-bar pt-20">
                                                    <li class="friend">
                                                        <div class="friend-msg-wrap">
                                                            <img class="user-img img-circle block pull-left"  src="https://hencework.com/theme/grandin-demo/img/user.png" alt="user"/>
                                                            <div class="msg pull-left">
                                                                <p>Hello Jason, how are you, it's been a long time since we last met?</p>
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-grey">2:30 PM</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </li>
                                                    <li class="self mb-10">
                                                        <div class="self-msg-wrap">
                                                            <div class="msg block pull-right"> Oh, hi Sarah I'm have got a new job now and is going great.
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-grey">2:31 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </li>
                                                    <li class="self">
                                                        <div class="self-msg-wrap">
                                                            <div class="msg block pull-right">  How about you?
                                                                <div class="msg-per-detail text-right">
                                                                    <span class="msg-time txt-grey">2:31 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </li>
                                                    <li class="friend">
                                                        <div class="friend-msg-wrap">
                                                            <img class="user-img img-circle block pull-left"  src="https://hencework.com/theme/grandin-demo/img/user.png" alt="user"/>
                                                            <div class="msg pull-left">
                                                                <p>Not too bad.</p>
                                                                <div class="msg-per-detail  text-right">
                                                                    <span class="msg-time txt-grey">2:35 pm</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" id="input_msg_send" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
                                                <div class="input-group-btn emojis">
                                                    <div class="dropup">
                                                        <button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown" ><i class="zmdi zmdi-mood"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="javascript:void(0)">Action</a></li>
                                                            <li><a href="javascript:void(0)">Another action</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="javascript:void(0)">Separated link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="input-group-btn attachment">
                                                    <div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
                                                        <input type="file" class="upload">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="messages_tab" class="tab-pane fade" role="tabpanel">
                        <div class="message-box-wrap">
                            <div class="msg-search">
                                <a href="javascript:void(0)" class="inline-block txt-grey">
                                    <i class="zmdi zmdi-more"></i>
                                </a>
                                <span class="inline-block txt-dark">Groupes</span>
                                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-search"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="set-height-wrap">
                                <div class="streamline message-box nicescroll-bar">
                                    <a href="javascript:void(0)">
                                        <div class="sl-item unread-message">

                                            <div class="sl-content">
                                                <span class="inline-block capitalize-font   pull-left message-per">Clay Masse</span>
                                                <span class="inline-block font-11  pull-right message-time">12:28 AM</span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  id="todo_tab" class="tab-pane fade" role="tabpanel">
                        <div class="todo-box-wrap">
                            <div class="add-todo">
                                <a href="javascript:void(0)" class="inline-block txt-grey">
                                    <i class="zmdi zmdi-more"></i>
                                </a>
                                <span class="inline-block txt-dark">todo list</span>
                                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="set-height-wrap">
                                <!-- Todo-List -->
                                <ul class="todo-list nicescroll-bar">
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-default">
                                            <input type="checkbox" id="checkbox01"/>
                                            <label for="checkbox01">Record The First Episode</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-pink">
                                            <input type="checkbox" id="checkbox02"/>
                                            <label for="checkbox02">Prepare The Conference Schedule</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-warning">
                                            <input type="checkbox" id="checkbox03" checked/>
                                            <label for="checkbox03">Decide The Live Discussion Time</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox04" checked/>
                                            <label for="checkbox04">Prepare For The Next Project</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-danger">
                                            <input type="checkbox" id="checkbox05" checked/>
                                            <label for="checkbox05">Finish Up AngularJs Tutorial</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                    <li class="todo-item">
                                        <div class="checkbox checkbox-purple">
                                            <input type="checkbox" id="checkbox06" checked/>
                                            <label for="checkbox06">Finish Infinity Project</label>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="light-grey-hr"/>
                                    </li>
                                </ul>
                                <!-- /Todo-List -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<!-- /Right Sidebar Menu -->
