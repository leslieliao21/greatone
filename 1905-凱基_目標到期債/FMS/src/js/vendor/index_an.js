(function (cjs, an) {

var p; // shortcut to reference prototypes
var lib={};var ss={};var img={};
lib.ssMetadata = [];


// symbols:



(lib.ball = function() {
	this.initialize(img.ball);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,488,491);


(lib.leaf = function() {
	this.initialize(img.leaf);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,486,645);


(lib.light_2 = function() {
	this.initialize(img.light_2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,534,520);


(lib.light_an = function() {
	this.initialize(img.light_an);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,79,136);


(lib.light_an_2 = function() {
	this.initialize(img.light_an_2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,103,90);


(lib.light_an_3 = function() {
	this.initialize(img.light_an_3);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,44,92);


(lib.light_s = function() {
	this.initialize(img.light_s);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,38,430);// helper functions:

function mc_symbol_clone() {
	var clone = this._cloneProps(new this.constructor(this.mode, this.startPosition, this.loop));
	clone.gotoAndStop(this.currentFrame);
	clone.paused = this.paused;
	clone.framerate = this.framerate;
	return clone;
}

function getMCSymbolPrototype(symbol, nominalBounds, frameBounds) {
	var prototype = cjs.extend(symbol, cjs.MovieClip);
	prototype.clone = mc_symbol_clone;
	prototype.nominalBounds = nominalBounds;
	prototype.frameBounds = frameBounds;
	return prototype;
	}


(lib.元件11 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.light_2();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件11, new cjs.Rectangle(0,0,534,520), null);


(lib.元件10 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.light_an_2();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件10, new cjs.Rectangle(0,0,103,90), null);


(lib.元件9 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.light_an_3();
	this.instance.parent = this;
	this.instance.setTransform(0,8,1,1,-10.4449);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件9, new cjs.Rectangle(0,0,60,98.5), null);


(lib.元件6 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1___複製_2
	this.instance = new lib.light_an();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	// 圖層_1_複製
	this.instance_1 = new lib.light_an();
	this.instance_1.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(1));

	// 圖層_1
	this.instance_2 = new lib.light_an();
	this.instance_2.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件6, new cjs.Rectangle(0,0,79,136), null);


(lib.元件4 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.light_s();
	this.instance.parent = this;
	this.instance.setTransform(0,8.85,0.5789,0.5912,-23.7024);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件4, new cjs.Rectangle(0,0,122.4,241.7), null);


(lib.元件3 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.leaf();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件3, new cjs.Rectangle(0,0,486,645), null);


(lib.元件2 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.ball();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件2, new cjs.Rectangle(0,0,488,491), null);


(lib.元件8 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1___複製_2
	this.instance = new lib.元件9();
	this.instance.parent = this;
	this.instance.setTransform(29.9,49.3,1,1,0,0,0,29.9,49.3);
	this.instance.alpha = 0.5508;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	// 圖層_1_複製
	this.instance_1 = new lib.元件9();
	this.instance_1.parent = this;
	this.instance_1.setTransform(29.9,49.3,1,1,0,0,0,29.9,49.3);
	this.instance_1.alpha = 0.5508;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(1));

	// 圖層_1
	this.instance_2 = new lib.light_an_3();
	this.instance_2.parent = this;
	this.instance_2.setTransform(0,8,1,1,-10.4449);

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件8, new cjs.Rectangle(0,0,60,98.5), null);


(lib.元件7 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1_複製
	this.instance = new lib.元件10();
	this.instance.parent = this;
	this.instance.setTransform(51.5,45,1,1,0,0,0,51.5,45);
	this.instance.alpha = 0.8281;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

	// 圖層_1
	this.instance_1 = new lib.light_an_2();
	this.instance_1.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件7, new cjs.Rectangle(0,0,103,90), null);


// stage content:
(lib.index_an = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// light_source_3
	this.instance = new lib.元件8();
	this.instance.parent = this;
	this.instance.setTransform(379,449.8,1,1,-10.2307,0,0,30.1,49.3);
	this.instance.alpha = 0;
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(39).to({_off:false},0).wait(1).to({regX:30,regY:49.2,scaleX:0.9824,scaleY:0.9873,rotation:-6.8043,x:377.35,y:440.75,alpha:0.1039},0).wait(1).to({scaleX:0.9651,scaleY:0.9748,rotation:-3.4636,x:377,y:432.4,alpha:0.2052},0).wait(1).to({scaleX:0.9484,scaleY:0.9627,rotation:-0.2085,x:377.3,y:424.5,alpha:0.3039},0).wait(1).to({scaleX:0.932,scaleY:0.9508,rotation:2.961,x:378.25,y:416.85,alpha:0.4},0).wait(1).to({scaleX:0.9161,scaleY:0.9393,rotation:6.0447,x:379.65,y:409.6,alpha:0.4935},0).wait(1).to({scaleX:0.9007,scaleY:0.9282,rotation:9.0428,x:381.4,y:402.75,alpha:0.5844},0).wait(1).to({scaleX:0.8857,scaleY:0.9173,rotation:11.9553,x:383.5,y:396.1,alpha:0.6727},0).wait(1).to({scaleX:0.8711,scaleY:0.9067,rotation:14.7821,x:385.85,y:389.8,alpha:0.7584},0).wait(1).to({scaleX:0.857,scaleY:0.8965,rotation:17.5232,x:388.5,y:383.8,alpha:0.8416},0).wait(1).to({scaleX:0.8433,scaleY:0.8866,rotation:20.1787,x:391.4,y:378.15,alpha:0.9221},0).wait(1).to({regX:30.1,regY:49.3,scaleX:0.83,scaleY:0.877,rotation:22.7485,x:394.5,y:372.9,alpha:1},0).wait(1).to({regX:30,regY:49.2,scaleX:0.8174,scaleY:0.8679,rotation:24.5832,x:397.4,y:368,alpha:0.9157},0).wait(1).to({scaleX:0.8051,scaleY:0.8591,rotation:26.3547,x:400.75,y:363,alpha:0.8343},0).wait(1).to({scaleX:0.7933,scaleY:0.8506,rotation:28.063,x:404.15,y:358.35,alpha:0.7558},0).wait(1).to({scaleX:0.782,scaleY:0.8425,rotation:29.708,x:407.65,y:354,alpha:0.6802},0).wait(1).to({scaleX:0.771,scaleY:0.8346,rotation:31.2897,x:411,y:349.9,alpha:0.6076},0).wait(1).to({scaleX:0.7606,scaleY:0.827,rotation:32.8081,x:414.45,y:346.15,alpha:0.5378},0).wait(1).to({scaleX:0.7505,scaleY:0.8198,rotation:34.2633,x:417.7,y:342.7,alpha:0.4709},0).wait(1).to({scaleX:0.7409,scaleY:0.8129,rotation:35.6552,x:420.9,y:339.4,alpha:0.407},0).wait(1).to({scaleX:0.7317,scaleY:0.8063,rotation:36.9838,x:424.05,y:336.45,alpha:0.3459},0).wait(1).to({scaleX:0.723,scaleY:0.8,rotation:38.2492,x:427,y:333.65,alpha:0.2878},0).wait(1).to({scaleX:0.7147,scaleY:0.794,rotation:39.4513,x:429.85,y:331.05,alpha:0.2326},0).wait(1).to({scaleX:0.7068,scaleY:0.7883,rotation:40.5901,x:432.55,y:328.75,alpha:0.1802},0).wait(1).to({scaleX:0.6994,scaleY:0.783,rotation:41.6657,x:435.15,y:326.6,alpha:0.1308},0).wait(1).to({scaleX:0.6924,scaleY:0.778,rotation:42.678,x:437.6,y:324.6,alpha:0.0843},0).wait(1).to({scaleX:0.6858,scaleY:0.7732,rotation:43.627,x:439.9,y:322.75,alpha:0.0407},0).wait(1).to({regX:30.3,regY:49.1,scaleX:0.6797,scaleY:0.7688,rotation:44.5127,x:441.75,y:320.6,alpha:0},0).wait(17).to({regX:30.1,regY:49.3,scaleX:0.8512,scaleY:0.8512,rotation:41.9975,x:455.5,y:312.15},0).to({_off:true},1).wait(5));

	// light_source_2
	this.instance_1 = new lib.元件7();
	this.instance_1.parent = this;
	this.instance_1.setTransform(443.15,482.6,0.6638,0.6623,-7.8568,0,0,51.8,45.6);
	this.instance_1.alpha = 0;
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(20).to({_off:false},0).wait(1).to({regX:51.5,regY:45,scaleX:0.662,scaleY:0.6633,rotation:-7.4619,x:444.35,y:480.6,alpha:0.0775},0).wait(1).to({scaleX:0.66,scaleY:0.6643,rotation:-7.0415,x:446.2,y:478.6,alpha:0.16},0).wait(1).to({scaleX:0.658,scaleY:0.6654,rotation:-6.5956,x:448.2,y:476.5,alpha:0.2475},0).wait(1).to({scaleX:0.6558,scaleY:0.6666,rotation:-6.1242,x:450.35,y:474.4,alpha:0.34},0).wait(1).to({scaleX:0.6535,scaleY:0.6679,rotation:-5.6274,x:452.5,y:472.2,alpha:0.4375},0).wait(1).to({scaleX:0.651,scaleY:0.6692,rotation:-5.1051,x:454.75,y:470,alpha:0.54},0).wait(1).to({scaleX:0.6485,scaleY:0.6705,rotation:-4.5573,x:457.1,y:467.8,alpha:0.6475},0).wait(1).to({scaleX:0.6458,scaleY:0.672,rotation:-3.984,x:459.5,y:465.5,alpha:0.76},0).wait(1).to({scaleX:0.6431,scaleY:0.6735,rotation:-3.3853,x:461.95,y:463.15,alpha:0.8775},0).wait(1).to({regX:51.9,regY:45.7,scaleX:0.6402,scaleY:0.675,rotation:-2.7611,x:464.85,y:461.25,alpha:1},0).wait(1).to({regX:51.5,regY:45,scaleX:0.6372,scaleY:0.6767,rotation:-2.1197,x:467.4,y:458.2},0).wait(1).to({scaleX:0.6341,scaleY:0.6784,rotation:-1.4531,x:470.4,y:455.4},0).wait(1).to({scaleX:0.6308,scaleY:0.6801,rotation:-0.7614,x:473.55,y:452.7},0).wait(1).to({scaleX:0.6274,scaleY:0.6819,rotation:-0.0446,x:476.7,y:449.95},0).wait(1).to({scaleX:0.624,scaleY:0.6838,rotation:0.6974,x:480.15,y:447.1},0).wait(1).to({scaleX:0.6204,scaleY:0.6858,rotation:1.4645,x:483.6,y:444.2},0).wait(1).to({regX:51.9,regY:45.7,scaleX:0.6167,scaleY:0.6878,rotation:2.2568,x:487.5,y:441.75},0).wait(1).to({regX:51.5,regY:45,scaleX:0.6129,scaleY:0.6899,rotation:3.0797,x:491.2,y:438.05,alpha:0.9351},0).wait(1).to({scaleX:0.6089,scaleY:0.6921,rotation:3.928,x:495.25,y:434.9,alpha:0.8681},0).wait(1).to({scaleX:0.6049,scaleY:0.6943,rotation:4.8015,x:499.5,y:431.7,alpha:0.7992},0).wait(1).to({scaleX:0.6007,scaleY:0.6966,rotation:5.7004,x:503.9,y:428.4,alpha:0.7283},0).wait(1).to({scaleX:0.5965,scaleY:0.699,rotation:6.6245,x:508.4,y:425.15,alpha:0.6553},0).wait(1).to({scaleX:0.5921,scaleY:0.7014,rotation:7.574,x:513.15,y:421.75,alpha:0.5804},0).wait(1).to({scaleX:0.5876,scaleY:0.7039,rotation:8.5489,x:518.05,y:418.35,alpha:0.5035},0).wait(1).to({scaleX:0.5829,scaleY:0.7065,rotation:9.549,x:523.2,y:415,alpha:0.4246},0).wait(1).to({scaleX:0.5782,scaleY:0.7091,rotation:10.5745,x:528.45,y:411.55,alpha:0.3437},0).wait(1).to({scaleX:0.5733,scaleY:0.7118,rotation:11.6253,x:533.95,y:408.1,alpha:0.2607},0).wait(1).to({scaleX:0.5683,scaleY:0.7145,rotation:12.7014,x:539.65,y:404.7,alpha:0.1758},0).wait(1).to({scaleX:0.5632,scaleY:0.7173,rotation:13.8028,x:545.5,y:401.25,alpha:0.0889},0).wait(1).to({regX:51.7,regY:45.4,scaleX:0.558,scaleY:0.7202,rotation:14.9295,x:551.75,y:398.45,alpha:0},0).to({_off:true},1).wait(38));

	// light_source_1
	this.instance_2 = new lib.元件6();
	this.instance_2.parent = this;
	this.instance_2.setTransform(377.85,539.85,0.4732,0.6133,4.5337,0,0,39.6,68.2);
	this.instance_2.alpha = 0;
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(2).to({_off:false},0).to({regY:68.3,scaleX:0.8109,scaleY:0.819,rotation:-19.2715,guide:{path:[377.9,539.7,377.1,535.4,374.6,528.5,369.2,513.7,359.4,498.6,349.9,484,337.3,470.9]},alpha:1},16,cjs.Ease.get(-0.5)).wait(1).to({regX:39.5,regY:68,scaleX:0.8002,scaleY:0.8086,rotation:-20.752,x:333.25,y:466.75,alpha:0.936},0).wait(1).to({scaleX:0.7899,scaleY:0.7985,rotation:-22.1945,x:329.05,y:462.7,alpha:0.8736},0).wait(1).to({scaleX:0.7798,scaleY:0.7886,rotation:-23.5991,x:324.8,y:458.9,alpha:0.8128},0).wait(1).to({scaleX:0.77,scaleY:0.779,rotation:-24.9658,x:320.6,y:455.25,alpha:0.7537},0).wait(1).to({scaleX:0.7605,scaleY:0.7697,rotation:-26.2944,x:316.55,y:451.85,alpha:0.6962},0).wait(1).to({scaleX:0.7512,scaleY:0.7606,rotation:-27.5851,x:312.45,y:448.7,alpha:0.6404},0).wait(1).to({scaleX:0.7422,scaleY:0.7518,rotation:-28.8379,x:308.45,y:445.7,alpha:0.5862},0).wait(1).to({scaleX:0.7334,scaleY:0.7433,rotation:-30.0527,x:304.55,y:442.85,alpha:0.5337},0).wait(1).to({scaleX:0.725,scaleY:0.735,rotation:-31.2295,x:300.75,y:440.25,alpha:0.4828},0).wait(1).to({scaleX:0.7168,scaleY:0.727,rotation:-32.3683,x:297,y:437.75,alpha:0.4335},0).wait(1).to({scaleX:0.7089,scaleY:0.7193,rotation:-33.4692,x:293.4,y:435.4,alpha:0.3859},0).wait(1).to({scaleX:0.7013,scaleY:0.7118,rotation:-34.5322,x:289.9,y:433.25,alpha:0.3399},0).wait(1).to({scaleX:0.6939,scaleY:0.7046,rotation:-35.5571,x:286.5,y:431.15,alpha:0.2956},0).wait(1).to({scaleX:0.6868,scaleY:0.6977,rotation:-36.5442,x:283.25,y:429.2,alpha:0.2529},0).wait(1).to({scaleX:0.68,scaleY:0.691,rotation:-37.4932,x:280.1,y:427.45,alpha:0.2118},0).wait(1).to({scaleX:0.6735,scaleY:0.6846,rotation:-38.4043,x:277.05,y:425.8,alpha:0.1724},0).wait(1).to({scaleX:0.6672,scaleY:0.6785,rotation:-39.2774,x:274.15,y:424.15,alpha:0.1346},0).wait(1).to({scaleX:0.6612,scaleY:0.6726,rotation:-40.1126,x:271.3,y:422.7,alpha:0.0985},0).wait(1).to({scaleX:0.6555,scaleY:0.667,rotation:-40.9098,x:268.7,y:421.35,alpha:0.064},0).wait(1).to({scaleX:0.65,scaleY:0.6617,rotation:-41.669,x:266.15,y:420.05,alpha:0.0312},0).wait(1).to({regX:39.7,regY:68.8,scaleX:0.6449,scaleY:0.6566,rotation:-42.3903,x:263.35,y:419.2,alpha:0},0).wait(44).to({regX:39.6,regY:68.5,scaleX:0.8057,scaleY:0.8204,rotation:-38.0759,x:241.1,y:416.2},0).to({_off:true},1).wait(5));

	// lihgt_s_2
	this.instance_3 = new lib.元件4();
	this.instance_3.parent = this;
	this.instance_3.setTransform(540.15,247,1.2071,1.7361,-81.8859,0,0,61.1,121);
	this.instance_3.alpha = 0.3789;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).to({regY:121.1,scaleX:0.2845,scaleY:0.3871,rotation:-81.8868,x:540.3,alpha:0.1094},22,cjs.Ease.get(1)).to({regY:121,scaleX:1.2071,scaleY:1.7361,rotation:-81.8859,x:540.15,alpha:0.3789},22).to({regY:121.1,scaleX:0.2845,scaleY:0.3871,rotation:-81.8868,x:540.3,alpha:0.1094},22,cjs.Ease.get(1)).to({regY:121,scaleX:1.2071,scaleY:1.7361,rotation:-81.8859,x:540.15,alpha:0.3789},22).wait(1));

	// lihgt_s_1
	this.instance_4 = new lib.元件4();
	this.instance_4.parent = this;
	this.instance_4.setTransform(540.05,247.05,1.1283,1.1819,-5.6987,0,0,61.2,120.9);
	this.instance_4.alpha = 0.3789;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).to({regX:61.1,scaleX:0.6423,scaleY:0.6423,rotation:-5.698,x:536.9,alpha:0.1289},22,cjs.Ease.get(1)).to({regX:61.2,scaleX:1.1283,scaleY:1.1819,rotation:-5.6987,x:540.05,alpha:0.6016},22).to({regX:61.1,scaleX:0.6423,scaleY:0.6423,rotation:-5.698,x:536.9,alpha:0.1289},22,cjs.Ease.get(1)).to({regX:61.2,scaleX:1.1283,scaleY:1.1819,rotation:-5.6987,x:540.05,alpha:0.3789},22).wait(1));

	// lihgt_b
	this.instance_5 = new lib.元件11();
	this.instance_5.parent = this;
	this.instance_5.setTransform(536.15,245,1,1,0,0,0,267,260);

	this.timeline.addTween(cjs.Tween.get(this.instance_5).to({regY:260.1,scaleX:0.438,scaleY:0.438,y:245.1},22).to({regY:260,scaleX:1,scaleY:1,y:245},22).to({regY:260.1,scaleX:0.438,scaleY:0.438,y:245.1},22).to({regY:260,scaleX:1,scaleY:1,y:245},22).wait(1));

	// ball
	this.instance_6 = new lib.元件2();
	this.instance_6.parent = this;
	this.instance_6.setTransform(391,434.5,1,1,0,0,0,244,245.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(89));

	// leaf
	this.instance_7 = new lib.元件3();
	this.instance_7.parent = this;
	this.instance_7.setTransform(374,580.5,1,1,0,0,0,243,322.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(89));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(531,450,272.20000000000005,453);
// library properties:
lib.properties = {
	id: '0E460126AF50334DA6D054B85A1C8F6E',
	width: 800,
	height: 930,
	fps: 12,
	color: "#FFFFFF",
	opacity: 1.00,
	manifest: [
		{src:"images/animation/ball.png?1560754385148", id:"ball"},
		{src:"images/animation/leaf.png?1560754385148", id:"leaf"},
		{src:"images/animation/light_2.png?1560754385148", id:"light_2"},
		{src:"images/animation/light_an.png?1560754385148", id:"light_an"},
		{src:"images/animation/light_an_2.png?1560754385148", id:"light_an_2"},
		{src:"images/animation/light_an_3.png?1560754385148", id:"light_an_3"},
		{src:"images/animation/light_s.png?1560754385148", id:"light_s"}
	],
	preloads: []
};



// bootstrap callback support:

(lib.Stage = function(canvas) {
	createjs.Stage.call(this, canvas);
}).prototype = p = new createjs.Stage();

p.setAutoPlay = function(autoPlay) {
	this.tickEnabled = autoPlay;
}
p.play = function() { this.tickEnabled = true; this.getChildAt(0).gotoAndPlay(this.getTimelinePosition()) }
p.stop = function(ms) { if(ms) this.seek(ms); this.tickEnabled = false; }
p.seek = function(ms) { this.tickEnabled = true; this.getChildAt(0).gotoAndStop(lib.properties.fps * ms / 1000); }
p.getDuration = function() { return this.getChildAt(0).totalFrames / lib.properties.fps * 1000; }

p.getTimelinePosition = function() { return this.getChildAt(0).currentFrame / lib.properties.fps * 1000; }

an.bootcompsLoaded = an.bootcompsLoaded || [];
if(!an.bootstrapListeners) {
	an.bootstrapListeners=[];
}

an.bootstrapCallback=function(fnCallback) {
	an.bootstrapListeners.push(fnCallback);
	if(an.bootcompsLoaded.length > 0) {
		for(var i=0; i<an.bootcompsLoaded.length; ++i) {
			fnCallback(an.bootcompsLoaded[i]);
		}
	}
};

an.compositions = an.compositions || {};
an.compositions['0E460126AF50334DA6D054B85A1C8F6E'] = {
	getStage: function() { return exportRoot.getStage(); },
	getLibrary: function() { return lib; },
	getSpriteSheet: function() { return ss; },
	getImages: function() { return img; }
};

an.compositionLoaded = function(id) {
	an.bootcompsLoaded.push(id);
	for(var j=0; j<an.bootstrapListeners.length; j++) {
		an.bootstrapListeners[j](id);
	}
}

an.getComposition = function(id) {
	return an.compositions[id];
}


an.makeResponsive = function(isResp, respDim, isScale, scaleType, domContainers) {		
	var lastW, lastH, lastS=1;		
	window.addEventListener('resize', resizeCanvas);		
	resizeCanvas();		
	function resizeCanvas() {			
		var w = lib.properties.width, h = lib.properties.height;			
		var iw = window.innerWidth, ih=window.innerHeight;			
		var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
		if(isResp) {                
			if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
				sRatio = lastS;                
			}				
			else if(!isScale) {					
				if(iw<w || ih<h)						
					sRatio = Math.min(xRatio, yRatio);				
			}				
			else if(scaleType==1) {					
				sRatio = Math.min(xRatio, yRatio);				
			}				
			else if(scaleType==2) {					
				sRatio = Math.max(xRatio, yRatio);				
			}			
		}			
		domContainers[0].width = w * pRatio * sRatio;			
		domContainers[0].height = h * pRatio * sRatio;			
		domContainers.forEach(function(container) {				
			container.style.width = w * sRatio + 'px';				
			container.style.height = h * sRatio + 'px';			
		});			
		stage.scaleX = pRatio*sRatio;			
		stage.scaleY = pRatio*sRatio;			
		lastW = iw; lastH = ih; lastS = sRatio;            
		stage.tickOnUpdate = false;            
		stage.update();            
		stage.tickOnUpdate = true;		
	}
}


})(createjs = createjs||{}, AdobeAn = AdobeAn||{});
var createjs, AdobeAn;