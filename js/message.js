var
// 获取元素
$ = function(element) {
return (typeof(element) == 'object' ? element : document.getElementById(element));
},
// 判断浏览器
brower = function() {
var ua = navigator.userAgent.toLowerCase();
var os = new Object();
os.isFirefox = ua.indexOf ('gecko') != -1;
os.isOpera = ua.indexOf ('opera') != -1;
os.isIE = !os.isOpera && ua.indexOf ('msie') != -1;
os.isIE7 = os.isIE && ua.indexOf ('7.0') != -1;
return os;
},
// 生成元素到refNode
appendElement = function(tagName, Attribute, strHtml, refNode) {
var cEle = document.createElement(tagName);
// 属性值
for (var i in Attribute){
cEle.setAttribute(i, Attribute[i]);
}
cEle.innerHTML = strHtml;
refNode.appendChild(cEle);
return cEle;
},
// 获取元素坐标
getCoords = function(node){
var x = node.offsetLeft;
var y = node.offsetTop;
var parent = node.offsetParent;
while (parent != null){
x += parent.offsetLeft;
y += parent.offsetTop;
parent = parent.offsetParent;
}
return {x: x, y: y};
},
// 事件操作(可保留原有事件)
eventListeners = [],
findEventListener = function(node, event, handler){
var i;
for (i in eventListeners){
if (eventListeners[i].node == node && eventListeners[i].event == event && eventListeners[i].handler == handler){
return i;
}
}
return null;
},
myAddEventListener = function(node, event, handler){
if (findEventListener(node, event, handler) != null){
return;
}
if (!node.addEventListener){
node.attachEvent('on' + event, handler);
}else{
node.addEventListener(event, handler, false);
}
eventListeners.push({node: node, event: event, handler: handler});
},
removeEventListenerIndex = function(index){
var eventListener = eventListeners[index];
delete eventListeners[index];
if (!eventListener.node.removeEventListener){
eventListener.node.detachEvent('on' + eventListener.event,
eventListener.handler);
}else{
eventListener.node.removeEventListener(eventListener.event,
eventListener.handler, false);
}
},
myRemoveEventListener = function(node, event, handler){
var index = findEventListener(node, event, handler);
if (index == null) return;
removeEventListenerIndex(index);
},
cleanupEventListeners = function(){
var i;
for (i = eventListeners.length; i > 0; i--){
if (eventListeners[i] != undefined){
removeEventListenerIndex(i);
}
}
}
function statInput(e, _max, _exp) {
e= $(e);
_max= parseInt(_max);
_max= isNaN(_max) ? 0 : _max;
_exp= _exp==undefined ? {} : _exp;
if(e==null || _max==0) {
alert('statInput初始化失败！');
return;
}
var
// 浏览器
_brower= brower();
// 输出对象
_objMax= _exp._max==undefined ?null : $(_exp._max),
_objTotal= _exp._total==undefined ?null : $(_exp._total),
_objLeft= _exp._left==undefined ?null : $(_exp._left),
// 弹出提示
_hint= _exp._hint==undefined ?null : _exp._hint;
// 初始统计
if(_objMax!=null)_objMax.innerHTML= _max;
if(_objTotal!=null)_objTotal.innerHTML= 0;
if(_objLeft!=null)_objLeft.innerHTML= 0;
// 设置监听事件
// 输入这个方法比较好.
// 但是Opera下中文输入跟粘贴不能正确统计...相当BT的东西...
// 如果不考虑Opera的话就用这个吧.否则就老老实实用计时器.
if(_brower.isIE) {
myAddEventListener(e, "propertychange", stat);
}else{
myAddEventListener(e, "input", stat);
}
/*
// 用计时器的话就什么浏览器都支持了.
var _intDo = null;
myAddEventListener(e, "focus", setListen);
myAddEventListener(e, "blur", remListen);
function setListen() {
_intDo = setInterval(stat, 10);
}
function remListen() {
clearInterval(_intDo);
}
*/
// 统计函数
var _len, _olen, _lastRN, _sTop;
_olen = _len = 0;
function stat() {
_len = e.value.length;
if(_len==_olen) return;// 防止用计时器监听时做无谓的牺牲...
if(_len>_max) {
_sTop = e.scrollTop;
// 避免IE最后俩字符为'\r\n'.导致崩溃...
_lastRN = (e.value.substr(_max-1, 2) == "\r\n");
e.value = e.value.substr(0, (_lastRN ? _max-1 : _max));
if(_hint==true) popHint(e, "你所写的内容超过限制了...明白了吗--网站开发剑云制作");
// 解决FF老是跑回顶部
if(_brower.isFirefox) e.scrollTop = e.scrollHeight;
}
_olen = _len = e.value.length;
// 显示已输入字数
if(_objTotal!=null) _objTotal.innerHTML = _len;
// 显示剩余可输入字数
if(_objLeft!=null) _objLeft.innerHTML = (_max-_len)<0 ? 0 : (_max-_len);
}
stat();
}
/*********************************************
- POPHint 弹出提示框
- By Mudoo 2008.5
**********************************************/
function popHint(obj, msg, initValues) {
var
_obj = $(obj),
_objHint = $("popHint"),
_msg = msg,
_init = initValues;
// 初始化失败...
if(_obj==undefined || _msg==undefined || _msg=="") return;
// 设置初始值
_init = _init==undefined ? {_type : "wrong", _event : "click"} : _init;
// obj如果不可见。设置弹出对象为obj父元素
if(_obj.style.display=='none' || _obj.style.visibility=='hidden' || _obj.getAttribute('type')=='hidden') _obj = _obj.parentNode;
var
_type = null,
_event = null,
_place = getCoords(_obj),
_marTop = null,
_objText = $("popHintText"),
// 初始化
init = function() {
var _hint = _obj.getAttribute("hint");
if(_hint=="false") return;
// 有的时候initValues不为空.但是只设置一个值...避免发生错误.再次设置初始值...
_type = _init._type==undefined ? "wrong" : _init._type;
_type = _type.toLowerCase();
_event = _init._event==undefined ? "click" : _init._event;
_event = _event.toLowerCase();

var _Html = "<div id=\"popHeader\">" +
"<div class=\"popLeft\"></div>" +
"<div id=\"popHintText\"></div>" +
"<div class=\"popRight\"></div>" +
"</div>"+
"<div class=\"popAngle\"><span></span></div>"
if(_objHint==null) {
_objHint = appendElement("div", {"id" : "popHint"}, _Html, document.body);
_objHint.style.display = "none";
_objText = $("popHintText");
}
show();
},
// 显示
show = function() {
_objHint.style.display = "";
_marTop = _objHint.offsetHeight;
_msg = "<span class=\"popIcon "+ _type +"\"></span>"+ _msg;
_objText.innerHTML = _msg;
_objHint.style.left = _place.x +"px";
_objHint.style.top = (_place.y-_marTop+8) +"px";
// 关闭触发事件
switch(_event) {
case "blur" :
myAddEventListener(_obj, 'blur', hide);
break;
//default :
case "click" :
myAddEventListener(document, 'mousedown', hide);
break;
//这里可以自己扩展很多事件...
}
},
// 关闭
hide = function() {
_objHint.style.display = "none";
_objText.innerHTML = "";
// 移除关闭触发事件
myRemoveEventListener(_obj, 'blur', hide);
myRemoveEventListener(document, 'mousedown', hide);
};
init();
}
myAddEventListener(window, "load", testStatInput);
function testStatInput(){
statInput('Test_1', 200, {_max : 'stat_max', _total : 'stat_total', _left : 'stat_left', _hint : true});
}