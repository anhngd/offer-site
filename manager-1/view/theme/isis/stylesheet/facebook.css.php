@charset "utf-8";

a, a:hover {text-decoration: none !important;}
a:hover, a:hover * {}
img {display: block !important;}

html,
body,
.fan_box,
.full_widget,
.full_widget *
{
  margin: 0px !important;
  padding: 0 !important;
  background: none !important;
  border: none !important;
}
.profileimage,
.name_block,
.connect_widget_connected_text,
.connect_widget_not_connected_text,
.connect_widget_user_action
{
  display: none !important;
}
.full_widget {
  position: relative !important;
padding-top: 46px !important;
}
.connect_top,
.connect_action,
.connect_widget,
.connect_button_slider,
.connect_button_container,
.connect_widget_like_button
{
  overflow: visible !important;
  display: block !important;
  height: 24px !important;
}
.connect_widget_interactive_area,
.connect_widget_interactive_area td
{
  height: 30px !important;
}
.connect_top {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
}
.connect_widget_interactive_area {
  float: right !important;
  margin-top: -10px !important;
  border-collapse: collapse important;
  border-spacing: 0 !important;
}
.connect_widget_like_button {
   margin-top: 14px !important;
  position: relative !important;
  line-height: 24px !important;
}
.connect_widget_like_button .tombstone_cross {
  margin-top: -30px;
  float: left;
  display: block !important;
  width: 24px !important;
  height: 24px !important;
  background-image: url(<?php  echo 'http://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/';?>fb_like9.png) !important;
  background-repeat: no-repeat !important;
}
.like_button_no_like .tombstone_cross {
  background-position: 0 0 !important;
}
.like_button_like .tombstone_cross {
  background-position: 0 -24px !important;
}
.connect_widget_like_button .liketext {
  display: block !important;
  float: left;
  height: 24px !important;
  line-height: 24px !important;
  padding: 0 0 0 7px !important;
  color: #474747!important;
}
.like_button_no_like:hover .tombstone_cross {

}
.like_button_like .tombstone_cross:hover {

}


.total {
  display: block !important;
  margin-bottom: 13px !important;
  padding-top: 1px !important;
  color: #666666!important;
  font-size: 11px !important;
  font-family: "Lucida Sans Unicode", "Lucida Grande", Arial, Helvetica, sans-serif;
}
.fan_box .connections {
  margin-right: -20px !important;
}
.grid_item {
  width: 60px !important;
  margin: 0 20px 13px 0 !important;
}
.grid_item a {
  display: block !important;
  color: #FFFFFF!important;
}
.grid_item a:hover {
  color: #f12b63 !important;
}
.grid_item img {
  margin-bottom: 3px !important;
  padding: 5px !important;
  background: #D0D5D8 !important;
  border-bottom: 1px solid #e5e5e5 !important;
  -moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
}
.fan_box .connections_grid .grid_item .name {
  color: #808080;
}
.grid_item a:hover img {

}