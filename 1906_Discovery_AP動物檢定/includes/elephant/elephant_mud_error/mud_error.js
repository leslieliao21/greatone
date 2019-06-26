(function (cjs, an) {

var p; // shortcut to reference prototypes
var lib={};var ss={};var img={};
lib.ssMetadata = [];


// symbols:



(lib.body = function() {
	this.initialize(img.body);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,305,231);


(lib.eye = function() {
	this.initialize(img.eye);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,25,29);


(lib.eye_2 = function() {
	this.initialize(img.eye_2);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,25,29);


(lib.head = function() {
	this.initialize(img.head);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,216,205);


(lib.left_back_b = function() {
	this.initialize(img.left_back_b);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,110,139);


(lib.left_back_s = function() {
	this.initialize(img.left_back_s);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,93,176);


(lib.left_front_b = function() {
	this.initialize(img.left_front_b);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,70,112);


(lib.left_front_s = function() {
	this.initialize(img.left_front_s);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,62,125);


(lib.mud_error_1 = function() {
	this.initialize(img.mud_error_1);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,300,126);


(lib.nose = function() {
	this.initialize(img.nose);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,57,226);


(lib.shadow = function() {
	this.initialize(img.shadow);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,635,89);


(lib.tail = function() {
	this.initialize(img.tail);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,29,67);


(lib.tooth = function() {
	this.initialize(img.tooth);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,100,64);


(lib.tooth_s = function() {
	this.initialize(img.tooth_s);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,78,50);// helper functions:

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


(lib.補間動畫1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.left_front_b();
	this.instance.parent = this;
	this.instance.setTransform(-35,-56);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-35,-56,70,112);


(lib.tooth_s_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.tooth();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.tooth_s_1, new cjs.Rectangle(0,0,100,64), null);


(lib.tail_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.tail();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.tail_1, new cjs.Rectangle(0,0,29,67), null);


(lib.shadow_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.shadow();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.shadow_1, new cjs.Rectangle(0,0,635,89), null);


(lib.nose_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.nose();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.nose_1, new cjs.Rectangle(0,0,57,226), null);


(lib.mud_txt_before = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.mud_error_1();
	this.instance.parent = this;
	this.instance.setTransform(0,-1);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.mud_txt_before, new cjs.Rectangle(0,-1,300,126), null);


(lib.left_front_s_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.left_front_s();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.left_front_s_1, new cjs.Rectangle(0,0,62,125), null);


(lib.left_back_s_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.left_back_s();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.left_back_s_1, new cjs.Rectangle(0,0,93,176), null);


(lib.left_back_03 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.left_back_s();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.left_back_03, new cjs.Rectangle(0,0,93,176), null);


(lib.head_main = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.head();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.head_main, new cjs.Rectangle(0,0,216,205), null);


(lib.eye_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_2
	this.instance = new lib.eye_2();
	this.instance.parent = this;
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(7).to({_off:false},0).to({_off:true},3).wait(9));

	// 圖層_1
	this.instance_1 = new lib.eye();
	this.instance_1.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(19));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,0,25,29);


(lib.元件4 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.tooth_s();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件4, new cjs.Rectangle(0,0,78,50), null);


(lib.元件1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.left_front_s();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.元件1, new cjs.Rectangle(0,0,62,125), null);


(lib.body_m = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.body();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.body_m, new cjs.Rectangle(0,0,305,231), null);


(lib.back_b = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.left_back_b();
	this.instance.parent = this;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.back_b, new cjs.Rectangle(0,0,110,139), null);


(lib.right_back = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_81 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(81).call(this.frame_81).wait(1));

	// back_s
	this.instance = new lib.left_back_03();
	this.instance.parent = this;
	this.instance.setTransform(72.9,97.35,0.9993,0.9993,-30.5182,0,0,46.5,31.2);
	this.instance.filters = [new cjs.ColorFilter(0.84, 0.84, 0.84, 1, 0, 0, 0, 0)];
	this.instance.cache(-2,-2,97,180);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({regX:46.7,regY:31.3,scaleX:0.9999,scaleY:0.9999,rotation:20.7498,x:39.35,y:97.05},19,cjs.Ease.get(1)).to({regX:46.5,regY:31.2,scaleX:0.9993,scaleY:0.9993,rotation:-30.5182,x:72.9,y:97.35},22).wait(3).to({regX:46.7,regY:31.3,scaleX:0.9999,scaleY:0.9999,rotation:20.7498,x:39.35,y:97.05},21,cjs.Ease.get(0.5)).to({regX:46.5,regY:31.1,scaleX:1,scaleY:1,rotation:0,x:54.05,y:100.05},16,cjs.Ease.get(0.5)).wait(1));

	// back_b
	this.instance_1 = new lib.back_b();
	this.instance_1.parent = this;
	this.instance_1.setTransform(53.5,30.1,0.9994,0.9994,-17.5328,0,0,56,28.6);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).to({regX:56.1,regY:28.4,scaleX:1,scaleY:1,rotation:14.5532,x:59.15,y:28.25},19,cjs.Ease.get(1)).to({regX:56,regY:28.6,scaleX:0.9994,scaleY:0.9994,rotation:-17.5328,x:53.5,y:30.1},22).wait(3).to({regX:56.1,regY:28.4,scaleX:1,scaleY:1,rotation:14.5532,x:59.15,y:28.25},21,cjs.Ease.get(0.5)).to({regX:56,regY:28.5,rotation:0,x:56,y:28.5},16,cjs.Ease.get(0.5)).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-55.5,-13.4,241.9,263);


(lib.left_back = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_81 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(81).call(this.frame_81).wait(1));

	// back_s
	this.instance = new lib.left_back_s_1();
	this.instance.parent = this;
	this.instance.setTransform(30.3,94.5,1,1,21.9595,0,0,46.5,31.3);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({regX:46.6,scaleX:0.9997,scaleY:0.9997,rotation:-24.8988,x:64.4,y:96.25},19,cjs.Ease.get(1)).to({regX:46.5,scaleX:1,scaleY:1,rotation:21.9595,x:30.3,y:94.5},23).wait(2).to({regX:46.6,scaleX:0.9997,scaleY:0.9997,rotation:-24.8988,x:64.4,y:96.25},21,cjs.Ease.get(0.5)).to({regX:46.5,regY:31.1,scaleX:1,scaleY:1,rotation:0,x:54.05,y:100.05},16,cjs.Ease.get(0.5)).wait(1));

	// back_b
	this.instance_1 = new lib.back_b();
	this.instance_1.parent = this;
	this.instance_1.setTransform(58.9,28.75,1,1,21.9595,0,0,56,28.3);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).to({regX:56.1,regY:28.6,scaleX:0.9998,scaleY:0.9998,rotation:-7.1975,x:57.85,y:27.9},19,cjs.Ease.get(1)).to({regX:56,regY:28.3,scaleX:1,scaleY:1,rotation:21.9595,x:58.9,y:28.75},23).wait(2).to({regX:56.1,regY:28.6,scaleX:0.9998,scaleY:0.9998,rotation:-7.1975,x:57.85,y:27.9},21,cjs.Ease.get(0.5)).to({regX:56,regY:28.5,scaleX:1,scaleY:1,rotation:0,x:56,y:28.5},16,cjs.Ease.get(0.5)).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-66.9,-18.4,234.4,267.8);


(lib.head_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// tooth
	this.instance = new lib.tooth_s_1();
	this.instance.parent = this;
	this.instance.setTransform(49.25,180.25,1,1,0,0,0,85,16);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({rotation:6.2371,x:44.3,y:175.5},15).to({rotation:0,x:49.25,y:181.25},14).wait(1));

	// nose
	this.instance_1 = new lib.nose_1();
	this.instance_1.parent = this;
	this.instance_1.setTransform(23,143.25,1,1,0,0,0,34.5,18);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).to({regY:18.1,rotation:7.4745,x:18.9,y:143.85},15).to({regY:18,rotation:0,x:23,y:143.25},14).wait(1));

	// eye
	this.instance_2 = new lib.eye_1();
	this.instance_2.parent = this;
	this.instance_2.setTransform(54,106,1,1,0,0,0,12.5,14.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_2).to({regX:12.6,rotation:19.4035,x:54.9,y:103.8},15).to({regX:0,regY:0,rotation:0,x:41.5,y:91.5},14).wait(1));

	// head
	this.instance_3 = new lib.head_main();
	this.instance_3.parent = this;
	this.instance_3.setTransform(126.1,109.55,1,1,-1.0037,0,0,126,109.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_3).to({rotation:4.4431,x:126,y:109.5},15).to({rotation:-1.0037,x:126.1,y:109.55},14).wait(1));

	// tooth_s
	this.instance_4 = new lib.元件4();
	this.instance_4.parent = this;
	this.instance_4.setTransform(23,168,1,1,0,0,0,65,18);

	this.timeline.addTween(cjs.Tween.get(this.instance_4).to({regY:18.1,rotation:10.9761,y:168.1},15).to({regY:18,rotation:0,y:168},14).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-46.8,-9.4,271.1,362.29999999999995);


(lib.front_back_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.元件1();
	this.instance.parent = this;
	this.instance.setTransform(31,62.5,1,1,0,0,0,31,62.5);
	this.instance.filters = [new cjs.ColorFilter(0.85, 0.85, 0.85, 1, 0, 0, 0, 0)];
	this.instance.cache(-2,-2,66,129);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.front_back_1, new cjs.Rectangle(0,0,62,125), null);


(lib.front_b_2 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.補間動畫1("synched",0);
	this.instance.parent = this;
	this.instance.setTransform(39,24,1,1,0,0,0,4,-32);
	this.instance.filters = [new cjs.ColorFilter(0.85, 0.85, 0.85, 1, 0, 0, 0, 0)];
	this.instance.cache(-37,-58,74,116);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.front_b_2, new cjs.Rectangle(0,0,70,112), null);


(lib.front_b = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// 圖層_1
	this.instance = new lib.補間動畫1("synched",0);
	this.instance.parent = this;
	this.instance.setTransform(39,24,1,1,0,0,0,4,-32);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = getMCSymbolPrototype(lib.front_b, new cjs.Rectangle(0,0,70,112), null);


(lib.body_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// tail
	this.instance = new lib.tail_1();
	this.instance.parent = this;
	this.instance.setTransform(306.1,155.6,1,1,-2.1994,0,0,7.5,13.6);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({rotation:-17.8986,x:306.15,y:155.65},9).to({rotation:-2.1994,x:306.1,y:155.6},10).wait(1));

	// body
	this.instance_1 = new lib.body_m();
	this.instance_1.parent = this;
	this.instance_1.setTransform(152.5,115.5,1,1,0,0,0,152.5,115.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(20));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,0,343,231);


(lib.right_f = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_81 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(81).call(this.frame_81).wait(2));

	// front_s
	this.instance = new lib.front_back_1();
	this.instance.parent = this;
	this.instance.setTransform(2.65,87.25,1,1,22.2256,0,0,38,19.7);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({regX:38.1,regY:19.8,scaleX:0.9999,scaleY:0.9999,rotation:-44.5481,x:43.15,y:97.6},19,cjs.Ease.get(1)).to({regX:38,regY:19.7,scaleX:1,scaleY:1,rotation:22.2256,x:2.65,y:87.25},23).wait(2).to({regX:38.1,regY:19.8,scaleX:0.9999,scaleY:0.9999,rotation:-44.5481,x:43.15,y:97.6},21,cjs.Ease.get(0.5)).to({regX:37.8,scaleX:0.9997,scaleY:0.9997,rotation:0.4434,x:32.8,y:93.2},16,cjs.Ease.get(0.5)).wait(2));

	// front_b
	this.instance_1 = new lib.front_b_2();
	this.instance_1.parent = this;
	this.instance_1.setTransform(38.85,27.45,1,1,22.2256,0,0,38.1,23.9);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).to({regX:37.9,regY:24,scaleX:0.9999,scaleY:0.9999,rotation:-13.5441,x:37.5,y:27.85},19,cjs.Ease.get(1)).to({regX:38.1,regY:23.9,scaleX:1,scaleY:1,rotation:22.2256,x:38.85,y:27.45},23).wait(2).to({regX:37.9,regY:24,scaleX:0.9999,scaleY:0.9999,rotation:-13.5441,x:37.5,y:27.85},21,cjs.Ease.get(0.5)).to({regX:38.1,regY:23.9,scaleX:0.9995,scaleY:0.9995,rotation:-4.4057,x:38.2,y:27.5},16,cjs.Ease.get(0.5)).wait(2));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-72.4,-9.1,206.4,216.2);


(lib.left_front_b_1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_79 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(79).call(this.frame_79).wait(1));

	// front_s
	this.instance = new lib.left_front_s_1();
	this.instance.parent = this;
	this.instance.setTransform(52.3,92.8,0.9999,0.9999,-46.7356,0,0,38,19.9);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({regY:19.7,scaleX:1,scaleY:1,rotation:26.239,x:-0.9,y:80.7},20,cjs.Ease.get(1)).to({regY:19.9,scaleX:0.9999,scaleY:0.9999,rotation:-46.7356,x:52.3,y:92.8},22,cjs.Ease.get(0.5)).to({regY:19.7,scaleX:1,scaleY:1,rotation:26.239,x:-0.9,y:80.7},21,cjs.Ease.get(0.5)).to({regY:19.6,rotation:0,x:27.05,y:93.05},16,cjs.Ease.get(0.5)).wait(1));

	// front_b
	this.instance_1 = new lib.front_b();
	this.instance_1.parent = this;
	this.instance_1.setTransform(38.9,24.1,1,1,-20.0157,0,0,38,24.1);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).to({regX:38.1,regY:24,rotation:26.239,x:39.45,y:23.7},20,cjs.Ease.get(1)).to({regX:38,regY:24.1,rotation:-20.0157,x:38.9,y:24.1},22,cjs.Ease.get(0.5)).to({regX:38.1,regY:24,rotation:26.239,x:39.45,y:23.7},21,cjs.Ease.get(0.5)).to({regX:38,rotation:0,x:38,y:24},16,cjs.Ease.get(0.5)).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-81.5,-14.7,226.8,215.29999999999998);


// stage content:
(lib.mud_error = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_81 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(81).call(this.frame_81).wait(1));

	// mud_txt_error
	this.instance = new lib.mud_txt_before();
	this.instance.parent = this;
	this.instance.setTransform(567,95,1,1,0,0,0,150,63);
	this.instance.alpha = 0;
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(2).to({_off:false},0).to({x:579,alpha:1},4).to({x:367},75).wait(1));

	// head
	this.instance_1 = new lib.head_1();
	this.instance_1.parent = this;
	this.instance_1.setTransform(459,191.5,1,1,0,0,0,139,116.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(2).to({x:404.8,y:184.5},17,cjs.Ease.get(1)).to({x:347.75,y:193.75},20,cjs.Ease.get(0.5)).to({x:287.85,y:185.65},21,cjs.Ease.get(0.6)).to({x:228,y:191.5},21).wait(1));

	// left_front
	this.instance_2 = new lib.left_front_b_1();
	this.instance_2.parent = this;
	this.instance_2.setTransform(506,284,1,1,0,0,0,38,22);

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(2).to({x:451.8,y:277},17,cjs.Ease.get(1)).to({x:394.75,y:286.25},20,cjs.Ease.get(0.5)).to({x:334.85,y:278.15},21,cjs.Ease.get(0.6)).to({x:275,y:284},21).wait(1));

	// left_back
	this.instance_3 = new lib.left_back();
	this.instance_3.parent = this;
	this.instance_3.setTransform(690,247.5,1,1,0,0,0,52,29.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(2).to({x:635.8,y:240.5},17,cjs.Ease.get(1)).to({x:578.75,y:249.75},20,cjs.Ease.get(0.5)).to({x:518.85,y:241.65},21,cjs.Ease.get(0.6)).to({x:459,y:247.5},21).wait(1));

	// body
	this.instance_4 = new lib.body_1();
	this.instance_4.parent = this;
	this.instance_4.setTransform(599.5,228.5,1,1,0,0,0,152.5,115.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(2).to({x:545.3,y:221.5},17,cjs.Ease.get(1)).to({x:488.25,y:230.75},20,cjs.Ease.get(0.5)).to({x:428.35,y:222.65},21,cjs.Ease.get(0.6)).to({x:368.5,y:228.5},21).wait(1));

	// left_back
	this.instance_5 = new lib.right_back();
	this.instance_5.parent = this;
	this.instance_5.setTransform(643,233.5,1,1,0,0,0,52,29.5);

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(2).to({x:588.8,y:226.5},17,cjs.Ease.get(1)).to({x:531.75,y:235.75},20,cjs.Ease.get(0.5)).to({x:471.85,y:227.65},21,cjs.Ease.get(0.6)).to({x:412,y:233.5},21).wait(1));

	// left_front
	this.instance_6 = new lib.right_f();
	this.instance_6.parent = this;
	this.instance_6.setTransform(483,260,1,1,0,0,0,38,22);

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(2).to({x:428.8,y:253},17,cjs.Ease.get(1)).to({x:371.75,y:262.25},20,cjs.Ease.get(0.5)).to({x:311.85,y:254.15},21,cjs.Ease.get(0.6)).to({x:252,y:260},21).wait(1));

	// shadow
	this.instance_7 = new lib.shadow_1();
	this.instance_7.parent = this;
	this.instance_7.setTransform(526.65,440.6,0.7662,0.977,0,0,0,317.6,44.6);

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(2).to({scaleX:0.7978,x:327.6},79).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(437,281,340.4,203);
// library properties:
lib.properties = {
	id: '8A97745D913B89429F6521CE41494F9B',
	width: 780,
	height: 500,
	fps: 18,
	color: "#FFFFFF",
	opacity: 1.00,
	manifest: [
		{src:"images/body.png?1561369948660", id:"body"},
		{src:"images/eye.png?1561369948660", id:"eye"},
		{src:"images/eye_2.png?1561369948660", id:"eye_2"},
		{src:"images/head.png?1561369948660", id:"head"},
		{src:"images/left_back_b.png?1561369948660", id:"left_back_b"},
		{src:"images/left_back_s.png?1561369948660", id:"left_back_s"},
		{src:"images/left_front_b.png?1561369948660", id:"left_front_b"},
		{src:"images/left_front_s.png?1561369948660", id:"left_front_s"},
		{src:"images/mud_error_1.png?1561369948660", id:"mud_error_1"},
		{src:"images/nose.png?1561369948660", id:"nose"},
		{src:"images/shadow.png?1561369948660", id:"shadow"},
		{src:"images/tail.png?1561369948660", id:"tail"},
		{src:"images/tooth.png?1561369948660", id:"tooth"},
		{src:"images/tooth_s.png?1561369948660", id:"tooth_s"}
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
an.compositions['8A97745D913B89429F6521CE41494F9B'] = {
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