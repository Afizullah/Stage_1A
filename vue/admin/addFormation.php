<style media="screen">
/*!
* bootstrap-vertical-tabs - v1.1.0
* https://dbtek.github.io/bootstrap-vertical-tabs
* 2014-06-06
* Copyright (c) 2014 Ä°smail Demirbilek
* License: MIT
*/
.tabs-left, .tabs-right {
border-bottom: none;
padding-top: 2px;
}
.tabs-left {
border-right: 1px solid #ddd;
}
.tabs-right {
border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
float: none;
margin-bottom: 2px;
}
.tabs-left>li {
margin-right: -1px;
}
.tabs-right>li {
margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
border-bottom-color: #ddd;
border-right-color: transparent;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
border-bottom: 1px solid #ddd;
border-left-color: transparent;
}
.tabs-left>li>a {
border-radius: 4px 0 0 4px;
margin-right: 0;
display:block;
}
.tabs-right>li>a {
border-radius: 0 4px 4px 0;
margin-right: 0;
}
.vertical-text {
margin-top:50px;
border: none;
position: relative;
}
.vertical-text>li {
height: 20px;
width: 120px;
margin-bottom: 100px;
}
.vertical-text>li>a {
border-bottom: 1px solid #ddd;
border-right-color: transparent;
text-align: center;
border-radius: 4px 4px 0px 0px;
}
.vertical-text>li.active>a,
.vertical-text>li.active>a:hover,
.vertical-text>li.active>a:focus {
border-bottom-color: transparent;
border-right-color: #ddd;
border-left-color: #ddd;
}
.vertical-text.tabs-left {
left: -50px;
}
.vertical-text.tabs-right {
right: -50px;
}
.vertical-text.tabs-right>li {
-webkit-transform: rotate(90deg);
-moz-transform: rotate(90deg);
-ms-transform: rotate(90deg);
-o-transform: rotate(90deg);
transform: rotate(90deg);
}
.vertical-text.tabs-left>li {
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
-ms-transform: rotate(-90deg);
-o-transform: rotate(-90deg);
transform: rotate(-90deg);
}
</style>
<div class="row" >
    <div  class="col-sm-12">

        <div class="col-xs-3">
            <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-left">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#profile" data-toggle="tab">Profile</a></li>
                <li><a href="#messages" data-toggle="tab">Messages</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
        </div>
        <div class="col-xs-9">
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home">Home Tab.</div>
                <div class="tab-pane" id="profile">Profile Tab.</div>
                <div class="tab-pane" id="messages">Messages Tab.</div>
                <div class="tab-pane" id="settings">Settings Tab.</div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
